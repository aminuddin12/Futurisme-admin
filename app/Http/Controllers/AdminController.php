<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function dashboard(): Response
    {
        // Pastikan Anda punya view ini
        return Inertia::render('Admin/Dashboard', [
             'pageTitle' => 'Admin Dashboard', // Kirim judul
        ]);
    }

    public function users(): Response
    {
        // Contoh
         return Inertia::render('Admin/Users', [
             'pageTitle' => 'Manage Users',
         ]);
    }
    // Tambahkan method lain...
}
