<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\Auth\ForgotPasswordController;
use App\Http\Controllers\Vendor\Auth\ResetPasswordController;

Route::prefix('vendor/password')
    ->name('vendor.auth.password.')
    ->group(function () {
        // Request link to email
        Route::get('reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
            ->middleware('guest:vendor')
            ->name('request');

        Route::post('email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
            ->middleware('guest:vendor')
            ->name('email');

        // Reset with token
        Route::get('reset/{token}', [ResetPasswordController::class, 'showResetForm'])
            ->middleware('guest:vendor')
            ->name('form');

        Route::post('reset', [ResetPasswordController::class, 'reset'])
            ->middleware('guest:vendor')
            ->name('submit');
    });
