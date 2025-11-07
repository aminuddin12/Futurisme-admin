<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiGateMiddleware
{
    /**
     * Handle an incoming request.
     * saya ingin menambahkan config terlebih dahulu
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userKey = $request->header('X-API-KEY');
        $validKey = config('services.api_gate.key');

        if (!$userKey || $userKey !== $validKey) {
            return response()->json(['message' => 'Akses Ditolak. API Key tidak valid.'], 403);
        }

        return $next($request);
    }
}
