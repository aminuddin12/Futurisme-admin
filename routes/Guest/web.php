<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\IndexController;
use Illuminate\Support\Facades\App;

Route::get('/maintenance', function () {
    return inertia('Maintenance');
})->name('maintenance');

// Grup rute untuk tamu.
Route::middleware(['check.maintenance'])->group(function () {

    Route::get('/', [IndexController::class, 'index'])->name('home');

});
