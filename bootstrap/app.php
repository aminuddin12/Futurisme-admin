<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureUserHasRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/Guest/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',

        using: function (\Illuminate\Routing\Router $router) {

            $router->middleware('web')
                ->group(base_path('routes/Guest/web.php'));

            $router->middleware('web')
                ->group(base_path('routes/Admin/auth.php'));

            $router->middleware('web')
                ->prefix('insider/')
                ->group(base_path('routes/Admin/web.php'));

            $router->middleware(['api', 'api.gate'])
                ->prefix('api/v1/insider/')
                ->group(base_path('routes/API/v1/Insider/api.php'));

            $router->middleware('api')
                ->prefix('api/v1/client/')
                ->group(base_path('routes/API/v1/Client/api.php'));

            // WEB API (Pakai 'api.gate' kustom)
            $router->middleware(['api', 'api.gate'])
                ->prefix('api/v1/web/')
                ->group(base_path('routes/API/v1/web/api.php'));

            // MOBILE API (Pakai 'api.gate' kustom)
            $router->middleware(['api', 'api.gate'])
                ->prefix('api/v1/mobile/')
                ->group(base_path('routes/API/v1/Mobile/api.php'));

            // DEBUG API (Pakai 'api.gate' kustom)
            $router->middleware(['api', 'api.gate'])
                ->prefix('api/v1/debug/')
                ->group(base_path('routes/API/v1/Debug/api.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            // Middleware kustom atau tambahan lainnya bisa ditambahkan di sini
        ]);
        $middleware->api(prepend: [
            \App\Http\Middleware\SetLanguage::class,
        ]);
        $middleware->alias([
            'api.gate' => \App\Http\Middleware\ApiGateMiddleware::class,
            'check.maintenance' => \App\Http\Middleware\CheckMaintenance::class,
            'role' => EnsureUserHasRole::class,
            'lang' => \App\Http\Middleware\SetLanguage::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
