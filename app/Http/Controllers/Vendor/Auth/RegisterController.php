<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\RegisterVendorRequest;
use App\Models\Vendor\VendorIdentity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return Inertia::render('Vendor/Auth/Register');
    }

    public function register(RegisterVendorRequest $request)
    {
        $data = $request->validated();
        $vendor = VendorIdentity::create([
            'company_name' => $data['company_name'],
            'email'        => $data['email'],
            'contact_person' => $data['contact_person'] ?? null,
            'phone_region'   => $data['phone_region'] ?? null,
            'phone_number'   => $data['phone_number'] ?? null,
            'website'        => $data['website'] ?? null,
            'address'        => $data['address'] ?? null,
            'status'         => 'inactive',
            'verified'       => false,
        ]);

        // buat password lewat model VendorPasswd atau mekanisme lain
        $vendor->passwd()->create([
            'vIdentification' => $vendor->vIdentification,
            'password'        => Hash::make($data['password']),
            'status'          => 'newPass',
        ]);

        Auth::guard('vendor')->login($vendor);

        return redirect()->route('vendor.dashboard');
    }
}
