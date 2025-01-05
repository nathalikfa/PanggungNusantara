<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CancelRefund;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $refunds = CancelRefund::with('payment.concert', 'user')
            ->when($request->concert_name, function ($query, $concertName) {
                return $query->whereHas('payment.concert', function ($q) use ($concertName) {
                    $q->where('name', 'LIKE', "%$concertName%");
                });
            })
            ->when($request->request_date, function ($query, $requestDate) {
                return $query->whereDate('created_at', $requestDate);
            })
            ->get();

        return view('admin.dashboard', compact('refunds', 'request'));
    }

    public function acceptCancellation($id)
    {
        $refund = CancelRefund::findOrFail($id);
        $refund->update(['status' => 'accepted']);

        return redirect()->route('admin.dashboard')->with('success', 'Refund accepted.');
    }

    public function rejectCancellation($id)
    {
        $refund = CancelRefund::findOrFail($id);
        $refund->update(['status' => 'rejected']);

        return redirect()->route('admin.dashboard')->with('success', 'Refund rejected.');
    }
}
