<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class DateTimeFormatHelper
{
    /**
     * Memformat tanggal/waktu ke format yang mudah dibaca (e.g., "07 November 2025, 15:30").
     * * @param string|\DateTimeInterface|null $dateTime
     * @param string $format (default: 'd F Y, H:i')
     * @return string|null
     */
    public static function formatReadable(string|\DateTimeInterface|null $dateTime, string $format = 'd F Y, H:i'): ?string
    {
        if (is_null($dateTime)) {
            return null;
        }

        try {
            return Carbon::parse($dateTime)->isoFormat($format); // Gunakan isoFormat untuk nama bulan lokal
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Memformat tanggal/waktu menjadi format "selisih waktu" (e.g., "2 hours ago").
     * * @param string|\DateTimeInterface|null $dateTime
     * @return string|null
     */
    public static function formatForHumans(string|\DateTimeInterface|null $dateTime): ?string
    {
        if (is_null($dateTime)) {
            return null;
        }

        try {
            return Carbon::parse($dateTime)->diffForHumans();
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Format selisih waktu dari sekarang menjadi tampilan sederhana.
     * Contoh hasil:
     * - "32 Hari"
     * - "1 Jam"
     * - "20 Menit"
     *
     * @param string|\DateTimeInterface $datetime
     * @return string
     */
    public static function diffSimple($datetime): string
    {
        $now = Carbon::now();
        $target = Carbon::parse($datetime);

        $diffInMinutes = $now->diffInMinutes($target);
        $diffInHours = $now->diffInHours($target);
        $diffInDays = $now->diffInDays($target);

        if ($diffInDays > 0) {
            return $diffInDays . ' Hari';
        }

        if ($diffInHours > 0) {
            return $diffInHours . ' Jam';
        }

        if ($diffInMinutes > 0) {
            return $diffInMinutes . ' Menit';
        }

        return 'Baru saja';
    }
}
