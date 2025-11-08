<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureUserHasRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',

        using: function (\Illuminate\Routing\Router $router) {
            $router->middleware('api')
                ->prefix('api/client/v1')
                ->group(base_path('routes/API/v1/Client/api.php'));

            // WEB API (Pakai 'api.gate' kustom)
            $router->middleware(['api', 'api.gate'])
                ->prefix('api/web/v1')
                ->group(base_path('routes/API/v1/web/api.php'));

            // MOBILE API (Pakai 'api.gate' kustom)
            $router->middleware(['api', 'api.gate'])
                ->prefix('api/mobile/v1')
                ->group(base_path('routes/API/v1/Mobile/api.php'));

            // DEBUG API (Pakai 'api.gate' kustom)
            $router->middleware(['api', 'api.gate'])
                ->prefix('api/debug/v1')
                ->group(base_path('routes/API/v1/Debug/api.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            // Middleware kustom atau tambahan lainnya bisa ditambahkan di sini
        ]);
        $middleware->alias([
            'api.gate' => \App\Http\Middleware\ApiGateMiddleware::class,
            'role' => EnsureUserHasRole::class,
            'lang' => \App\Http\Middleware\SetLanguage::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
