<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Response;

class IndexController extends Controller
{
    public function index(Request $request): Response
    {
        return $this->inertiaRender('LandingPage', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}


