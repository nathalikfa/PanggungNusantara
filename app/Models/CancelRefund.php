<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelRefund extends Model
{
    use HasFactory;

    protected $table = 'cancel_refunds';

    protected $fillable = [
        'user_id',
        'concert_id',
        'payment_id',
        'reason',
        'status',
    ];

    // Relasi ke tabel user_login
    public function user()
    {
        return $this->belongsTo(UserLogin::class, 'user_id');
    }

    // Relasi ke tabel concerts
    public function concert()
    {
        return $this->belongsTo(Concert::class, 'concert_id');
    }

    // Relasi ke tabel payments
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
