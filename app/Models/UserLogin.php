<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserLogin extends Authenticatable
{
    use Notifiable;

    // Specify the table name
    protected $table = 'user_login';

    // Specify the fillable fields
    protected $fillable = [
        'username',
        'password',
        'phone_number',
        'is_admin',
        "image",
    ];

    // Disable timestamps if not used
    public $timestamps = false;

    // Specify the hidden attributes (like password)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relationship to Payment
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }
}
