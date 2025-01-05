<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = ['concert_id', 'type', 'price'];

    /**
     * Relasi ke tabel Concert.
     */
    public function concert()
    {
        return $this->belongsTo(Concert::class);
    }
}
