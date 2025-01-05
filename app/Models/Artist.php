<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'genre', 'bio', 'image', 'date_of_birth'];

    public function concerts()
    {
        return $this->hasMany(Concert::class);
    }
}
