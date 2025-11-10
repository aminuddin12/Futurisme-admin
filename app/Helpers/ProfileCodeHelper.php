<?php

namespace App\Helpers;

use App\Models\Insider\Profile;
use Illuminate\Support\Str;

class ProfileCodeHelper
{
    /**
     * Generate ID Code untuk Insider Profile.
     *
     * Format: DIV-POS-DDMMYY-UNIQ
     *
     * @param \App\Models\Insider\Profile $profile
     * @return string
     */
    public static function generateCode(Profile $profile)
    {
        // 1️⃣ Divisi Code (3 huruf)
        $division = strtoupper(substr($profile->division ?? '', 0, 3));

        // 2️⃣ Posisi Code (4 huruf)
        $position = strtoupper(substr($profile->position ?? '', 0, 4));

        // 3️⃣ Tanggal Lahir (DDMMYY)
        $birthDate = '';
        if (!empty($profile->birth_date)) {
            $date = date('dmy', strtotime($profile->birth_date));
            $birthDate = $date;
        }

        // 4️⃣ Unik ID (7–10 digit)
        do {
            $uniqueNumber = random_int(1000000, 9999999999);
            $exists = Profile::where('id_code', 'LIKE', "%{$uniqueNumber}%")->exists();
        } while ($exists);

        // 5️⃣ Gabungkan komponen
        $parts = array_filter([$division, $position, $birthDate, $uniqueNumber]);
        $code = implode('-', $parts);

        return $code;
    }

    /**
     * Generate code hanya jika profil sudah diverifikasi oleh admin.
     *
     * @param \App\Models\Insider\Profile $profile
     * @return string|null
     */
    public static function generateIfApproved(Profile $profile)
    {
        // Misal ada kolom 'is_approved' di tabel profiles
        if ($profile->is_approved && empty($profile->id_code)) {
            $profile->id_code = self::generateCode($profile);
            $profile->save();
            return $profile->id_code;
        }

        return null;
    }
}
