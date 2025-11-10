<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\Auth\LoginController;

Route::prefix('vendor')
    ->name('vendor.auth.login.')
    ->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])
            ->middleware('guest:vendor')
            ->name('form');

        Route::post('login', [LoginController::class, 'login'])
            ->middleware('guest:vendor')
            ->name('submit');

        Route::post('logout', [LoginController::class, 'logout'])
            ->middleware('auth:vendor')
            ->name('logout');
    });
