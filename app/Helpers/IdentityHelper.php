<?php

namespace App\Helpers;

use App\Models\Client\UserIdentity;
use Illuminate\Support\Str;

class IdentityHelper
{
    /**
     * Menghasilkan uIdentification unik yang belum ada di tabel user_identities.
     * * @param int $length Panjang string acak yang diinginkan.
     * @return string Kode unik.
     */
    public static function generateUniqueUIdentification(int $length = 12): string
    {
        do {
            // Menghasilkan string acak (A-Z, a-z, 0-9)
            $uIdentification = Str::random($length);
        } while (self::checkUIdentificationExists($uIdentification));

        return $uIdentification;
    }

    /**
     * Mengecek apakah uIdentification sudah ada di database.
     * * @param string $uIdentification Kode yang akan dicek.
     * @return bool True jika ada, false jika tidak.
     */
    public static function checkUIdentificationExists(string $uIdentification): bool
    {
        return UserIdentity::where('uIdentification', $uIdentification)->exists();
    }

    /**
     * Mengecek apakah username sudah ada di database.
     * * @param string $username Username yang akan dicek.
     * @return bool True jika ada, false jika tidak.
     */
    public static function checkUsernameExists(string $username): bool
    {
        return UserIdentity::where('username', $username)->exists();
    }

    /**
     * Mengecek apakah email sudah ada di database.
     * * @param string $email Email yang akan dicek.
     * @return bool True jika ada, false jika tidak.
     */
    public static function checkEmailExists(string $email): bool
    {
        return UserIdentity::where('email', $email)->exists();
    }
}
