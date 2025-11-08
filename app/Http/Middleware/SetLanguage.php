<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLanguage
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil parameter lang dari request, header, atau default ke 'en'
        $lang = $request->input('lang', $request->header('Accept-Language', 'en'));

        // Jika bahasa tersedia di folder lang/
        if (in_array($lang, ['en', 'id'])) {
            App::setLocale($lang);
        } else {
            App::setLocale('en');
        }

        return $next($request);
    }
}
