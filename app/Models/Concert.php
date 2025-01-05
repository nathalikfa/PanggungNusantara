<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $fillable = ['artist_id', 'name', 'date', 'location', 'min_price', 'max_price'];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }
}
