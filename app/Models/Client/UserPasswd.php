<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPasswd extends Model
{
    use HasFactory;

    protected $table = 'user_passwds';

    protected $fillable = [
        'uIdentification',
        'password',
        'status',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // CATATAN PENTING 2:
    // Logika untuk mengubah status 'newPass' -> 'oldPass' dan membuat data baru
    // TIDAK diimplementasikan di sini.
    // Itu harus diimplementasikan di Controller Anda (misalnya: Auth\NewPasswordController.php
    // atau controller reset password kustom Anda).
    //
    // Contoh di Controller:
    // public function storeNewPassword(Request $request)
    // {
    //     // ... (validasi $request)
    //     $userIdentity = UserIdentity::where('email', $request->email)->firstOrFail();
    //     $uIdentification = $userIdentity->uIdentification;
    //
    //     // 1. Set password lama menjadi 'oldPass'
    //     UserPasswd::where('uIdentification', $uIdentification)
    //               ->where('status', 'newPass')
    //               ->update(['status' => 'oldPass', 'remember_token' => null]);
    //
    //     // 2. Buat password baru
    //     $newPassword = UserPasswd::create([
    //         'uIdentification' => $uIdentification,
    //         'password' => Hash::make($request->password),
    //         'status' => 'newPass',
    //         'remember_token' => Str::random(60),
    //     ]);
    //
    //     // ... (login user, hapus token reset, dll)
    // }
}
