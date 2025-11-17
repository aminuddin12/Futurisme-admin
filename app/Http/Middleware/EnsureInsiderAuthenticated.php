<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class EnsureInsiderAuthenticated extends Middleware
{
    // public function handle(Request $request, Closure $next)
    // {
    //     $user = $request->user();

    //     if (! $user) {
    //         return response()->json(['message' => 'Unauthenticated.'], 401);
    //     }

    //     // Pastikan model adalah Insider (optional)
    //     if (! str_starts_with(get_class($user), 'App\\Models\\Insider')) {
    //         return response()->json(['message' => 'Unauthorized.'], 403);
    //     }

    //     return $next($request);
    // }
    protected function redirectTo(Request $request): ?string
    {
        // TAMBAHKAN FUNGSI INI
        // Ini akan mengganti perilaku default (yang mengarah ke 'login')
        // dan mengarahkannya ke 'insider.login'
        return $request->expectsJson() ? null : route('insider.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function guards(Request $request): array
    {
        return ['insider'];
    }
}
