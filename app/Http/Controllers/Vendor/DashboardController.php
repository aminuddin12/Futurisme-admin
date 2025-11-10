<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function index()
    {
        $vendor = auth()->guard('vendor')->user();
        return Inertia::render('Vendor/Dashboard/Index', [
            'vendor' => $vendor->only(['vIdentification','company_name','email','status','verified']),
        ]);
    }
}
