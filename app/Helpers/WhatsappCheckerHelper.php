<?php

namespace App\Helpers;

class WhatsappCheckerHelper
{
    /**
     * Memvalidasi apakah format nomor telepon 'masuk akal' untuk WhatsApp.
     * CATATAN: Ini TIDAK mengecek apakah nomor tersebut terdaftar di WhatsApp.
     * Itu hanya bisa dilakukan melalui API eksternal (e.g., Twilio, Gupshup).
     *
     * @param string $phoneRegionale Kode negara (e.g., "+62")
     * @param string $phoneNumber Nomor (e.g., "8123456789")
     * @return bool True jika formatnya terlihat valid, false jika tidak.
     */
    public static function isPlausibleWhatsAppNumber(string $phoneRegionale, string $phoneNumber): bool
    {
        // 1. Bersihkan nomor dari karakter non-numerik (spasi, tanda hubung, dll.)
        $cleanedNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // 2. Cek kode regionale (harus dimulai dengan + dan diikuti angka)
        if (!preg_match('/^\+[1-9]\d{0,3}$/', $phoneRegionale)) {
            return false; // Format kode regionale tidak valid
        }

        // 3. Cek panjang nomor (nomor WhatsApp umumnya 7-12 digit setelah kode negara)
        $length = strlen($cleanedNumber);
        if ($length < 7 || $length > 12) { // Batasan ini bisa disesuaikan
            return false;
        }

        // Jika lolos semua cek format dasar
        return true;
    }

    /**
     * Menggabungkan kode regionale dan nomor menjadi format E.164.
     * * @param string $phoneRegionale e.g., "+62"
     * @param string $phoneNumber e.g., "812 345 6789" atau "0812..."
     * @return string|null Nomor E.164 (e.g., "+628123456789") atau null jika tidak valid.
     */
    public static function formatToE164(string $phoneRegionale, string $phoneNumber): ?string
    {
        // Bersihkan nomor
        $cleanedNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Jika nomor dimulai dengan '0', hilangkan '0' tersebut
        if (str_starts_with($cleanedNumber, '0')) {
            $cleanedNumber = substr($cleanedNumber, 1);
        }

        // Cek ulang format regionale
        if (!preg_match('/^\+[1-9]\d{0,3}$/', $phoneRegionale)) {
            return null; // Format kode regionale tidak valid
        }

        return $phoneRegionale . $cleanedNumber;
    }
}
