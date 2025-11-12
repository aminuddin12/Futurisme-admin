<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Path ke "home" route untuk aplikasi Anda.
     *
     * Ini digunakan oleh Laravel untuk pengalihan setelah autentikasi.
     * Kita atur ke dashboard insider.
     */
    public const HOME = '/dashboard';

    /**
     * Namespace untuk controller-controller Anda (jika masih menggunakan $namespace).
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Mendefinisikan binding model-rute, pola filter, dll.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            // Konfigurasi untuk rute API
            // Ini mengasumsikan Anda memiliki file routes/api.php utama
            // yang mungkin memuat file-file API v1 Anda.
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php')); // Sesuaikan jika nama file API utama Anda berbeda

            // Konfigurasi untuk rute Web
            Route::middleware('web')
                ->group(function () {

                    // 1. Rute Publik (Guest)
                    // Dimuat dari routes/Guest/web.php
                    // File ini menangani middleware 'check.maintenance' sendiri.
                    Route::group(base_path('routes/Guest/web.php'));

                    // 2. Rute Autentikasi Insider (Admin)
                    // Dimuat dari routes/Admin/auth.php
                    // Diberi prefix 'insider' dan nama 'insider.'
                    // Hasil: /insider/login, /insider/register
                    // Nama Rute: insider.login, insider.register

                    // Route::prefix('insider')->name('insider.')->group(base_path('routes/Admin/auth.php'));

                    // 3. Rute Internal Insider (Admin) yang Terlindungi
                    // Dimuat dari routes/Admin/web.php
                    // WAJIB dilindungi dengan middleware 'auth:insider'
                    // Hasil: /dashboard, /profile, /settings
                    // Route::middleware('auth:insider')->group(base_path('routes/Admin/web.php'));

                    // 4. Rute Vendor
                    // Dimuat dari routes/Vendor/web.php
                    // File ini sudah menangani prefix 'vendor' dan middleware 'auth:vendor' sendiri.
                    // Route::group(base_path('routes/Vendor/web.php'));

                    // 5. Catatan Penting:
                    // File 'routes/auth.php' (bawaan Breeze) sengaja tidak dimuat di sini.
                    // Alasan:
                    // 1. Guard default Anda adalah 'insider', yang akan menyebabkan konflik.
                    // 2. Kita telah menggantinya dengan 'routes/Admin/auth.php' yang lebih spesifik.
                    // 3. Jika Anda perlu autentikasi untuk 'client' (guard 'web'),
                    //    sebaiknya gunakan rute API (seperti di routes/API/v1/Client/api.php)
                    //    atau buat file auth kustom lain untuk mereka.
                });
        });
    }

    /**
     * Mengkonfigurasi rate limiter untuk aplikasi.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
