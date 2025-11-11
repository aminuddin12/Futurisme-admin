<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama aplikasi.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        // Me-render komponen Vue yang ada di 'resources/js/Pages/Welcome.vue'
        // Anda bisa mengganti 'Welcome' dengan nama komponen halaman utama Anda.
        return Inertia::render('Welcome');
    }
}
