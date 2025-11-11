<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

class LangHelper
{
    public static function msg(string $key, array $replace = [], ?string $lang = null): string
    {
        $default = config('app.default_lang', env('APP_LOCALE', 'en'));
        $lang = $lang ?? request()->input('lang') ?? App::getLocale() ?? $default;
            request()->header('Accept-Language', App::getLocale()) ??
            App::getLocale();

        if (! in_array($lang, ['en', 'id'])) {
            $lang = 'en';
        }

        App::setLocale($lang);

        $message = __($key, $replace);

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
