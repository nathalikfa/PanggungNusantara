<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Concert;

class ConcertSeeder extends Seeder
{
    public function run()
    {
        Concert::create([
            'artist_id' => 1,
            'name' => 'Jakarta Live Fest',
            'date' => '2024-12-01',
            'location' => 'Jakarta Convention Center',
            'price' => 150.00,
        ]);
    }
}
