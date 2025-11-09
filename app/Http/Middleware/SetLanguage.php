<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLanguage
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil parameter lang dari input (body / query / header)
        $lang = $request->input('lang') ??
                $request->header('Accept-Language', 'en');

        // Pastikan hanya bahasa yang tersedia yang digunakan
        $availableLangs = ['en', 'id'];
        if (! in_array($lang, $availableLangs)) {
            $lang = 'en';
        }

        App::setLocale($lang);

        // Simpan bahasa di request agar bisa digunakan di helper
        $request->attributes->set('lang', $lang);

        return $next($request);
    }
}
