<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/Guest/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            \App\Http\Middleware\SetLanguage::class,
            // Middleware kustom atau tambahan lainnya bisa ditambahkan di sini
        ]);
        $middleware->api(prepend: [
            \App\Http\Middleware\SetLanguage::class,
        ]);
        $middleware->alias([
            'api.gate' => \App\Http\Middleware\ApiGateMiddleware::class,
            'check.maintenance' => \App\Http\Middleware\CheckMaintenance::class,
            //'role' => EnsureUserHasRole::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'lang' => \App\Http\Middleware\SetLanguage::class,

            'insider' => \App\Http\Middleware\EnsureInsiderAuthenticated::class,
            //'vendor' => \App\Http\Middleware\EnsureVendorAuthenticated::class,
        ]);

        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->routeIs('insider.*')) {
                return route('insider.login');
            }

            if ($request->routeIs('vendor.*')) {
                return route('vendor.login');
            }

            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
