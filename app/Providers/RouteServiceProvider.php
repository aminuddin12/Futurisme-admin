<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Path ke "home" route Anda.
     */
    public const HOME = 'insider/dashboard';

    /**
     * Konfigurasi bindings, filters, dll.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            // 1. RUTE API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/Api/v1/api.php'));


            // --- MULAI PERBAIKAN ---
            // Kita tidak perlu satu grup 'web' besar.
            // Kita akan terapkan middleware 'web' ke setiap file rute web secara individual.

            // 2. RUTE TAMU (Guest)
            // Ini menerapkan middleware 'web' ke semua rute di dalam file 'Guest/web.php'.
            Route::middleware('web')
                ->group(base_path('routes/Guest/web.php'));


            // 3. RUTE OTENTIKASI INSIDER (Dinamis)
            $insiderPath = Cache::get('auth_path_insider');
            if (empty($insiderPath)) {
                $insiderPath = 'insider'; // Fallback default
            }

            Route::middleware(['web', 'guest:insider']) // Terapkan 'web' DAN 'guest:insider'
                ->prefix($insiderPath)
                ->name('insider.')
                ->group(base_path('routes/Admin/auth.php'));


            // 4. RUTE DASHBOARD INSIDER (Tetap)
            Route::middleware(['web', 'auth:insider']) // Terapkan 'web' DAN 'auth:insider'
                ->group(base_path('routes/Admin/web.php'));


            // 5. RUTE VENDOR (Dashboard)
            Route::middleware(['web', 'auth:vendor']) // Terapkan 'web' DAN 'auth:vendor'
                ->prefix('vendor')
                ->name('vendor.')
                ->group(base_path('routes/Vendor/web.php'));

            // --- AKHIR PERBAIKAN ---

        });
    }

    /**
     * Konfigurasi rate limiters.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
