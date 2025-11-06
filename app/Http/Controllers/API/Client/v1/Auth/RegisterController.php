<?php

namespace App\Http\Controllers\API\Client\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Menangani permintaan registrasi user baru.
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Berikan role default jika ada (misal: 'client')
        // $user->assignRole('client');

        // Kirim email verifikasi (jika diaktifkan)
        // event(new \Illuminate\Auth\Events\Registered($user));

        $token = $user->createToken('client-auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi berhasil. Silakan verifikasi email Anda.',
            'user' => $user,
            'token' => $token
        ], 201);
    }
}
