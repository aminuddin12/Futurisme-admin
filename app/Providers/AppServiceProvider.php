<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Insider\Insider as User;
use App\Models\Insider\Permission; // Asumsi Anda punya model Permission
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\App; // <--- PERBAIKAN 1: Menambahkan facade App
use Illuminate\Support\Facades\URL; // <--- PERBAIKAN 2: Menambahkan facade URL

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

        if (App::environment('production')) {
            URL::forceScheme('https');
        }

        try {
            Gate::before(function ($user, string $ability) {
                if ($user && method_exists($user, 'hasRole')) {
                    return $user->hasRole('Admin') ? true : null;
                }
                return null;
            });
            foreach (Permission::all() as $permission) {
                Gate::define($permission->name, function (?User $user) use ($permission) {
                    return $user && $user->hasPermissionTo($permission);
                });
            }
        } catch (\Exception $e) {
            return ;
        }

        Blade::if('role', function (string $role) {
            /** @var \App\Models\Insider\Insider|null */
            $user = auth()->guard('insider')->user();

            return $user && $user->hasRole($role);
        });
    }
}
