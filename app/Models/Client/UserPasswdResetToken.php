<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPasswdResetToken extends Model
{
    use HasFactory;

    protected $table = 'user_passwd_reset_tokens';
    protected $primaryKey = 'id'; // Walaupun default, ini menegaskan

    protected $fillable = [
        'username',
        'email',
        'phoneRegionale',
        'phoneNumber',
        'token',
        'created_at', // Izinkan mass assignment untuk created_at
    ];

    // Matikan updated_at
    public const UPDATED_AT = null;

    // created_at akan di-handle secara default, tapi jika Anda ingin set manual:
    // public $timestamps = false;
    // protected $casts = ['created_at' => 'datetime'];
}
