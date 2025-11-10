<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function show()
    {
        return Inertia::render('Vendor/Auth/Verify');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('vendor.dashboard');
    }

    public function resend(Request $request)
    {
        if ($request->user('vendor')->hasVerifiedEmail()) {
            return redirect()->route('vendor.dashboard');
        }

        $request->user('vendor')->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    }
}
