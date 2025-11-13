<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebSettingsController;
use App\Http\Controllers\Admin\ProfileSettingController;
use Inertia\Inertia;


// Halaman Utama Insider
Route::get('/dashboard', [DashboardController::class, 'index'])->name('insider.dashboard');
Route::get('/profile', fn () => Inertia::render('Profile/AccountProfile'))->name('insider.profile');

// Rute untuk halaman Web Settings Untuk Role Admin Atau permission
Route::get('/settings', [WebSettingsController::class, 'index'])->name('insider.settings');
Route::put('/settings', [WebSettingsController::class, 'update'])->name('insider.settings.update');

// Rute untuk halaman Profile Settings
Route::get('/profile/settings', [ProfileSettingController::class, 'index'])->name('insider.profile.settings');
Route::put('/profile/settings', [ProfileSettingController::class, 'update'])->name('insider.profile.settings.update');

// Route untuk halaman Chat
Route::get('/chat', fn () => Inertia::render('Chat/Chat'))->name('insider.chat');
