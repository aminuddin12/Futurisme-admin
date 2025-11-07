<?php

namespace App\Http\Controllers\API\Client\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
// use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    /**
     * Kirim ulang link verifikasi email jika user menambahkan email baru. atau membuat email cadangan di UserSecondIdentity
     */
    public function sendVerificationEmail(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email sudah terverifikasi.'], 400);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Link verifikasi telah dikirim!']);
    }

    /**
     * Tandai email user sebagai terverifikasi.
     * (Logika ini biasanya ditangani oleh URL bertanda tangan,
     * tapi ini adalah placeholder jika Anda ingin menangani via API)
     */
    public function verify(Request $request): JsonResponse // Seharusnya EmailVerificationRequest $request
    {
        // Logika untuk verifikasi.
        // Disarankan menggunakan rute 'verification.verify' bawaan Laravel.
        // Jika API:
        // $request->user()->markEmailAsVerified();
        // event(new \Illuminate\Auth\Events\Verified($request->user()));

        return response()->json(['message' => 'Metode verifikasi email belum diimplementasikan.']);
    }
}
