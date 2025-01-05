<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function search(Request $request)
    {
        // Retrieve the search query
        $query = $request->get('query', '');

        // Find artists matching the query
        $artists = Artist::where('name', 'LIKE', '%' . $query . '%')->get();

        // Return JSON response for AJAX
        return response()->json($artists);
    }

    public function show($id)
    {
        // Retrieve artist details with related concerts
        $artist = Artist::with('concerts')->findOrFail($id);

        // Return artist view with data
        return view('artist', compact('artist'));
    }

    public function allArtists()
    {
        $artists = Artist::select('id', 'name', 'image')->get();
        return response()->json($artists);
    }
}
