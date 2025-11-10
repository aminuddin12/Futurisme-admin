<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureVendorAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string|null $guard = 'vendor')
    {
        if (! Auth::guard($guard)->check()) {
            return redirect()->route('vendor.auth.login.form');
        }

        return $next($request);
    }
}
