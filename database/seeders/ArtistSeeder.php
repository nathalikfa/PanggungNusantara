<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artist;

class ArtistSeeder extends Seeder
{
    public function run()
    {
        Artist::create([
            'name' => 'Feast',
            'genre' => 'Rock',
            'bio' => 'Feast is one of the most influential and critically acclaimed rock bands to emerge from Indonesia.',
            'image' => '/img/feast_artist.jpg',
            'date_of_birth' => '2013-04-01',
        ]);
    }
}
