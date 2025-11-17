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
    public const HOME = 'insider/dashboard';
    public const iHOME = 'insider/dashboard';
    public const vHOME = 'vendor/dashboard';
    public const cOME = 'client/dashboard';

    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/Guest/web.php'));

            Route::middleware('web')
                ->prefix('insider')
                ->name('insider.')
                ->group(base_path('routes/Insider/web.php'));
            Route::middleware('web')
                ->prefix('insider')
                ->name('insider.')
                ->group(base_path('routes/Insider/auth.php'));

            Route::middleware('web')
                ->name('vendor.')
                ->group(base_path('routes/Vendor/web.php'));
            Route::middleware('web')
                ->name('vendor.')
                ->group(base_path('routes/Vendor/Auth/Login.php'));
            Route::middleware('web')
                ->name('vendor.')
                ->group(base_path('routes/Vendor/Auth/Register.php'));
            Route::middleware('web')
                ->name('vendor.')
                ->group(base_path('routes/Vendor/Auth/Password.php'));
            Route::middleware('web')
                ->name('vendor.')
                ->group(base_path('routes/Vendor/Auth/Verify.php'));

            // 4. API Routes
            Route::middleware('api')
                ->prefix('api/v1/client')
                ->name('api.v1.client')
                ->group(base_path('routes/API/v1/Client/api.php'));
            Route::middleware('api')
                ->prefix('api/v1/web')
                ->name('api.v1.web')
                ->group(base_path('routes/API/v1/Web/api.php'));
            Route::middleware('api')
                ->prefix('api/v1/app')
                ->name('api.v1.app')
                ->group(base_path('routes/API/v1/Mobile/api.php'));
            Route::middleware('api')
                ->prefix('api/v1/insider')
                ->name('api.v1.insider')
                ->group(base_path('routes/API/v1/Insider/api.php'));
            Route::middleware('api')
                ->prefix('api/v1/debug')
                ->name('api.v1.debug')
                ->group(base_path('routes/API/v1/Debug/api.php'));

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
