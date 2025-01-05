<?php

namespace App\Http\Controllers;

use App\Models\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\CancelRefund;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    // Menampilkan form login
    public function showLogin()
    {
        return view('login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Attempt to authenticate using Auth
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Regenerate session
            $request->session()->regenerate();

            // Check if the user is an admin
            if (Auth::user()->is_admin) {
                // Redirect to admin dashboard
                return redirect('/admin/dashboard');
            }

            // Redirect to home for regular users
            return redirect('/home');
        }

        // Redirect back to login with error
        return back()->with('error', 'Invalid username or password');
    }

    // Menampilkan form register
    public function showRegister()
    {
        return view('register');
    }

    // Menangani proses register
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|unique:user_login',
            'password' => 'required|min:5',
            'phone_number' => 'required',
        ], [
            'username.unique' => 'The username is already taken. Please choose a different one.',
        ]);

        // Simpan data ke database
        UserLogin::create([
            'username' => $request->username,
            'password' => bcrypt($request->password), // Simpan password terenkripsi
            'phone_number' => $request->phone_number,
        ]);

        // Redirect ke login dengan pesan sukses
        return redirect('/login')->with('success', 'Account registered successfully');
    }


    public function showHome(Request $request)
    {
        $username = $request->session()->get('username');
        return view('home', compact('username'));
    }

    public function showAccount()
    {
        $payments = Payment::with(['concert', 'refund'])
            ->where('user_id', Auth::id())
            ->get()
            ->map(function ($payment) {
                $eventDate = \Carbon\Carbon::parse($payment->concert->date); // Tanggal konser
                $payment->canCancel = !$payment->refund && now()->diffInDays($eventDate, false) > 3; // Hanya refund jika lebih dari H-3 dan belum di-refund

                // Ambil status refund dari tabel cancel_refunds
                $cancelRefund = CancelRefund::where('payment_id', $payment->id)->first();
                if ($cancelRefund) {
                    $payment->refundStatus = $cancelRefund->status; // Status refund
                } else {
                    $payment->refundStatus = null; // Belum ada refund
                }

                return $payment;
            });

        return view('account', compact('payments'));
    }

    // Logout dan hapus session
    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect('/home'); // Redirect to the home page
    }

    public function update(Request $request)
    {
        $request->validate([
            'username' => 'nullable|string|max:255', // Username opsional
            'password' => 'nullable|min:8',          // Password opsional
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar opsional
        ]);

        $data = []; // Data untuk update

        // Perbarui username jika ada
        if ($request->filled('username')) {
            $data['username'] = $request->username;
        }

        // Perbarui password jika ada
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password); // Enkripsi password
        }

        // Periksa apakah ada file gambar yang diupload
        if ($request->hasFile('image')) {
            $user = DB::table('user_login')->where('id', Auth::id())->first();

            // Hapus gambar lama jika ada
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }

            // Simpan file gambar baru
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/uploads', $fileName);

            // Tambahkan path ke data yang akan diupdate
            $data['image'] = 'uploads/' . $fileName;
        }

        // Update database hanya jika ada perubahan
        if (!empty($data)) {
            DB::table('user_login')->where('id', Auth::id())->update($data);
        }

        return redirect('/account')->with('status', 'Profile updated successfully!');
    }


    public function destroy()
    {
        $userId = Auth::id();

        // Logout pengguna
        Auth::logout();

        // Hapus data pengguna
        DB::table('user_login')->where('id', $userId)->delete();

        return redirect('/')->with('status', 'Account deleted successfully!');
    }
}
