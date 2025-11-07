<?php

namespace App\Http\Controllers\API\Client\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Client\UserIdentity as User;

class LoginController extends Controller
{
    /**
     * Menangani permintaan login.
     */
    public function login(Request $request): JsonResponse
    {
        // saya ingin validasi di sini menentukan login otomatis berupa email dan username dan memndapatkan uIdentity
        // setelah mendapatkan uIdentity, lalu memanggil ke model UserPasswd, menyocokkan passwoord dengan status newPass
        $request->validate([
            'username' => 'required|string', // Bisa username atau email
            'password' => 'required|string',
        ]);

        // Coba login via email
        $credentials = [
            'email' => $request->uIdentity,
            'password' => $request->password
        ];

        // Jika gagal, coba login via username
        if (!Auth::attempt($credentials)) {
            $credentials = [
                'username' => $request->uIdentity,
                'password' => $request->password
            ];

            if (!Auth::attempt($credentials)) {
                throw ValidationException::withMessages([
                    'identity' => ['Kredensial yang diberikan tidak cocok dengan data kami.'],
                ]);
            }
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('client-auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Menangani permintaan logout.
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout berhasil']);
    }
}
