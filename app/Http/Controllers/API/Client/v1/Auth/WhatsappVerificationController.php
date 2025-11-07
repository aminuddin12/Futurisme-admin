<?php

namespace App\Http\Controllers\API\Client\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WhatsappVerificationController extends Controller
{
    /**
     * Mengirim kode OTP ke nomor Whatsapp user.
     * tapi saya ingin nantinya verifikasi dengan whatsapp API juga agar sistem berjalan dengan baik
     */
    public function sendOtp(Request $request): JsonResponse
    {
        $request->validate(['phone_number' => 'required|string']);

        // Logika untuk mengirim OTP via Whatsapp (misal: Fonnte, Twilio)
        // $otp = rand(100000, 999999);
        // Simpan OTP ke cache atau database
        // Kirim OTP...

        return response()->json(['message' => 'OTP telah dikirim ke ' . $request->phone_number]);
    }

    /**
     * Memverifikasi kode OTP yang dimasukkan.
     */
    public function verifyOtp(Request $request): JsonResponse
    {
        $request->validate([
            'phone_number' => 'required|string',
            'otp' => 'required|string|min:6|max:6',
        ]);

        // Logika untuk memeriksa OTP
        // $isValid = ...

        // if ($isValid) {
        //     $user = $request->user(); // atau cari user berdasarkan phone_number
        //     $user->whatsapp_verified_at = now();
        //     $user->save();
        //     return response()->json(['message' => 'Verifikasi Whatsapp berhasil.']);
        // }

        return response()->json(['message' => 'Kode OTP salah atau kedaluwarsa.'], 422);
    }
}
