<?php

namespace App\Helpers;

use App\Models\Client\UserPasswd;
use Illuminate\Support\Facades\Hash;

class PasswdHelper
{
    /**
     * Mengecek apakah password baru (plaintext) sudah pernah digunakan sebelumnya
     * oleh uIdentification ini.
     *
     * @param string $uIdentification
     * @param string $newPlaintextPassword Password baru yang belum di-hash
     * @return bool True jika password sudah pernah dipakai, false jika belum.
     */
    public static function checkPasswordHistory(string $uIdentification, string $newPlaintextPassword): bool
    {
        // Ambil semua hash password sebelumnya untuk user ini
        $pastPasswords = UserPasswd::where('uIdentification', $uIdentification)
                                   ->pluck('password'); // Ambil hanya kolom password

        foreach ($pastPasswords as $hashedPassword) {
            // Cek apakah password baru cocok dengan salah satu hash lama
            if (Hash::check($newPlaintextPassword, $hashedPassword)) {
                return true; // Password sudah pernah digunakan
            }
        }

        return false; // Password aman (belum pernah digunakan)
    }
}
