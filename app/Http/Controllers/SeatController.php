<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Menampilkan kursi untuk konser tertentu.
     *
     * @param int $concertId
     * @return \Illuminate\Contracts\View\View
     */
    public function showSeats($concertId)
    {
        $concertId = (int) $concertId; // Konversi menjadi integer

        // Ambil data konser berdasarkan ID
        $concert = Concert::findOrFail($concertId);

        // Ambil data kursi terkait berdasarkan concert_id
        $seats = Seat::where('concert_id', $concertId)->get();

        // Kirim data ke view payment.blade.php
        return view('payment', [
            'concert' => $concert,
            'seats' => $seats,
        ]);
    }
}
