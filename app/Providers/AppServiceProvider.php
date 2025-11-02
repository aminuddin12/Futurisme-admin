<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Permission; // Asumsi Anda punya model Permission
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        try {
            // 1. Memberikan semua akses kepada pengguna dengan peran 'Admin' (Super Admin).
            // Fungsi ini akan dieksekusi sebelum semua pengecekan otorisasi lainnya.
            Gate::before(function ($user, string $ability) {
                // Cek apakah user (bisa jadi model User atau Insider) memiliki peran 'Admin'
                if ($user && method_exists($user, 'hasRole')) {
                    return $user->hasRole('Admin') ? true : null;
                }
                return null;
            });

            // 2. Mendaftarkan semua permission dari database secara dinamis.
            // Ini memungkinkan Anda menambah permission di DB tanpa mengubah kode.
            foreach (Permission::all() as $permission) {
                // Gunakan ?User untuk mengizinkan user menjadi null (untuk guest)
                Gate::define($permission->name, function (?User $user) use ($permission) {
                    // Jika tidak ada user (guest), kembalikan false. Jika ada, cek permission.
                    return $user && $user->hasPermissionTo($permission);
                });
            }
        } catch (\Exception $e) {
            // Menangani error jika migrasi belum dijalankan atau tabel tidak ada.
            // Ini penting agar perintah `php artisan migrate` tidak gagal.
            return;
        }

        // 3. (Opsional) Membuat directive Blade kustom untuk kemudahan.
        // Contoh: @role('editor') ... @endrole
        Blade::if('role', function (string $role) {
            /** @var \App\Models\User|null */
            $user = auth()->user();
            return $user && $user->hasRole($role);
        });
    }
}
