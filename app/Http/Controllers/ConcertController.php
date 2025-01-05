<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Artist;

class ConcertController extends Controller
{
    /**
     * Display a listing of concerts.
     */
    public function index()
    {
        $concerts = Concert::with('artist')->get(); // Mengambil konser beserta artisnya
        return view('concerts.index', compact('concerts'));
    }

    /**
     * Show the details of a specific concert.
     */
    public function show($id)
    {
        $concert = Concert::with('artist')->findOrFail($id); // Mengambil konser beserta data artisnya
        return view('concerts.show', compact('concert'));
    }

    /**
     * Show all concerts of a specific artist.
     */
    public function byArtist($artistId)
    {
        $artist = Artist::findOrFail($artistId); // Cari artisnya
        $concerts = $artist->concerts; // Ambil konser yang dimiliki artis tersebut
        return view('concerts.by_artist', compact('artist', 'concerts'));
    }
}
