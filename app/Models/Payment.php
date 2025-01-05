<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    // Kolom yang dapat diisi
    protected $fillable = [
        'user_id',
        'email',
        'name',
        'phone',
        'quantity',
        'seat_type',
        'price',
        'payment_method',
        'bank',
        'ticket_code',
        'concert_id',
    ];

    // Relasi ke model UserLogin
    public function user()
    {
        return $this->belongsTo(UserLogin::class, 'user_id');
    }
    public function concert()
    {
        return $this->belongsTo(Concert::class, 'concert_id');
    }
    public function refund()
    {
        return $this->hasOne(CancelRefund::class, 'payment_id');
    }
}
