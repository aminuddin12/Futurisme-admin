<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Insider\DashboardController;
use App\Http\Controllers\Insider\WebSettingsController;
use App\Http\Controllers\Insider\ProfileSettingController;
use Inertia\Inertia;


// Halaman Utama Insider

// Rute untuk halaman Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/profile', fn () => Inertia::render('Profile/AccountProfile'))->name('profile');

// Rute untuk halaman Web Settings Untuk Role Admin Atau permission
Route::get('/settings', [WebSettingsController::class, 'index'])->name('settings');
Route::put('/settings', [WebSettingsController::class, 'update'])->name('settings.update');

// Rute untuk halaman Profile Settings
Route::get('/profile/settings', [ProfileSettingController::class, 'index'])->name('profile.settings');
Route::put('/profile/settings', [ProfileSettingController::class, 'update'])->name('profile.settings.update');

// Route untuk halaman Chat
Route::get('/chat', fn () => Inertia::render('Chat/Chat'))->name('chat');
