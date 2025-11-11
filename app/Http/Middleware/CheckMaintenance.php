<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika aplikasi dalam mode maintenance DAN request bukan ke halaman maintenance itu sendiri
        if (App::isDownForMaintenance() && !$request->routeIs('maintenance')) {
            // Alihkan ke halaman maintenance
            return redirect()->route('maintenance');
        }

        return $next($request);
    }
}
