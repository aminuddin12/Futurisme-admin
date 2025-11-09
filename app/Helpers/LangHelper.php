<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

class LangHelper
{
    /**
     * Mengambil pesan sesuai bahasa pengguna dari lang/xx.json
     * Contoh: LangHelper::msg('auth.registration_success')
     */
    public static function msg(string $key, array $replace = [], ?string $lang = null): string
    {
        // Ambil bahasa aktif dari Request atau default 'en'
        $default = config('app.default_lang', env('APP_LOCALE', 'en'));
        $lang = $lang ?? request()->input('lang') ?? App::getLocale() ?? $default;
            request()->header('Accept-Language', App::getLocale()) ??
            App::getLocale();

        // Pastikan valid (fallback ke 'en' jika tidak terdaftar)
        if (! in_array($lang, ['en', 'id'])) {
            $lang = 'en';
        }

        // Set locale sementara untuk terjemahan
        App::setLocale($lang);

        // Ambil teks dari lang file
        $message = __($key, $replace);

        // Jika tidak ditemukan, tampilkan key-nya agar mudah debugging
        if ($message === $key) {
            $message = "[missing:$key]";
        }

        return $message;
    }

    /**
     * Shortcut untuk mendeteksi bahasa aktif dari request
     */
    public static function current(): string
    {
        return App::getLocale() ?? 'en';
    }
}
