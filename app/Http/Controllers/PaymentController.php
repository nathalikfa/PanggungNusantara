<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Models\Concert;
use App\Models\Artist;
use App\Models\CancelRefund;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'quantity' => 'required|integer|min:1|max:10',
            'seat_type' => 'required|string',
            'price' => 'required|numeric',
            'payment_method' => 'required|string',
            'bank' => 'nullable|string',
            'concert_id' => 'required|integer|exists:concerts,id',
        ]);

        // Tambahkan user_id ke data yang disimpan
        $validatedData['user_id'] = Auth::id(); // Gunakan Auth::id() langsung
        $validatedData['ticket_code'] = $this->generateTicketCode();

        // Simpan data ke database
        Payment::create($validatedData);

        return redirect()->route('payment.success')->with('success', 'Payment has been successfully processed!');
    }

    private function generateTicketCode()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $ticketCode = '';
        for ($i = 0; $i < 8; $i++) {
            $ticketCode .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $ticketCode;
    }

    public function success()
    {
        // Ambil data pembayaran terakhir untuk user yang sedang login
        $payment = Payment::where('user_id', Auth::id())
            ->latest()
            ->first();

        if (!$payment) {
            return redirect()->route('home')->with('error', 'No payment found!');
        }

        // Ambil data konser terkait berdasarkan concert_id
        $concert = Concert::with('artist')->find($payment->concert_id);

        if (!$concert) {
            return redirect()->route('home')->with('error', 'Concert not found!');
        }

        // Kirim data ke tampilan
        return view('success', [
            'payment' => $payment,
            'concert' => $concert,
            'artist' => $concert->artist,
        ]);
    }

    public function processRefund(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'reason' => 'required|string|max:255',
            'custom_reason' => 'nullable|string|max:255',
            'payment_id' => 'required|exists:payments,id',
            'concert_id' => 'required|exists:concerts,id',
        ]);

        // Ambil data payment berdasarkan ID
        $payment = Payment::findOrFail($validated['payment_id']);

        // Validasi pemilik pembayaran
        if ($payment->user_id !== Auth::id()) {
            return redirect()->route('account')->with('error', 'Unauthorized action.');
        }

        // Validasi batas waktu refund (H-3)
        $eventDate = \Carbon\Carbon::parse($payment->concert->date);
        if (now()->diffInDays($eventDate, false) <= 3) {
            return redirect()->route('account')->with('error', 'Refund is no longer allowed.');
        }

        // Gabungkan alasan refund
        $reason = $validated['reason'];
        if ($reason === 'Other' && !empty($validated['custom_reason'])) {
            $reason = $validated['custom_reason'];
        }

        // Simpan data refund ke tabel cancel_refunds
        CancelRefund::create([
            'user_id' => Auth::id(), // Ambil user_id langsung dari Auth
            'concert_id' => $validated['concert_id'],
            'payment_id' => $validated['payment_id'],
            'reason' => $reason,
            'status' => 'waiting',
        ]);

        // Perbarui status pembayaran di tabel payments
        $payment->update(['status' => 'Refund Requested']);

        return redirect()->route('account')->with('success', 'Refund request submitted successfully.');
    }
}
