<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Response;

class IndexController extends Controller
{
    /**
     * Menampilkan halaman depan (landing page) aplikasi.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        // Menggunakan metode inertiaRender dari base Controller (Controller.php)
        // untuk me-render komponen Vue dengan data bersama (shared props) secara otomatis.
        return $this->inertiaRender('LandingPage', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
