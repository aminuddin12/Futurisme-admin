<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
//use App\Http\Middleware\EnsureUserHasRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        // using: function ($router) {
        //     $base = __DIR__.'/../routes/';
        //     require $base.'web.php';
        //     require $base.'auth.php';

            // $router->middleware(['web', 'auth', 'role:Admin'])->prefix('admin')->group($base.'Admin.php');
            // $router->middleware(['web', 'auth', 'role:Insider'])->prefix('insider')->group($base.'Insider.php');
            // $router->middleware(['web', 'auth', 'role:Vendor Owner|Vendor Team'])->prefix('vendor')->group($base.'Vendor.php');
            // $router->middleware(['web', 'auth', 'role:Merchant Owner|Merchant Team'])->prefix('merchant')->group($base.'Merchant.php');
            // $router->middleware(['web', 'auth', 'role:Driver'])->prefix('driver')->group($base.'Driver.php');
            // $router->middleware(['web', 'auth', 'role:Customer'])->prefix('customer')->group($base.'Customer.php');
        //},
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);
        $middleware->alias([
            //'role' => EnsureUserHasRole::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
