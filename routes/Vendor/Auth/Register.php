<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\Auth\RegisterController;

Route::prefix('vendor')
    ->name('vendor.auth.register.')
    ->group(function () {
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])
            ->middleware('guest:vendor')
            ->name('form');

        Route::post('register', [RegisterController::class, 'register'])
            ->middleware('guest:vendor')
            ->name('submit');
    });
