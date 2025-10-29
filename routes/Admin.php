<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\AdminController; // Buat controller ini
use Inertia\Inertia;

// Prefix '/admin' dan middleware 'auth', 'role:Admin' sudah diterapkan di bootstrap/app.php

//Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard'); // Gunakan route name yang sama
//Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
// Tambahkan route admin lainnya...

// Contoh route langsung render view jika belum ada controller
// Route::get('/settings', fn() => Inertia::render('Admin/Settings'))->name('admin.settings');
