<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\API\Auth\InsiderAuthController;


Route::post('register', [InsiderAuthController::class, 'register']);
Route::post('login', [InsiderAuthController::class, 'login']);
Route::post('forgot-password', [InsiderAuthController::class, 'forgotPassword']);
Route::post('reset-password', [InsiderAuthController::class, 'resetPassword']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [InsiderAuthController::class, 'logout']);
    Route::get('me', [InsiderAuthController::class, 'me']);
});

