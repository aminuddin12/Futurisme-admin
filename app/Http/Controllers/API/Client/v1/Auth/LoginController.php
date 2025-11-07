<?php

namespace App\Http\Controllers\API\Client\v1\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\DateTimeFormatHelper;
use App\Models\Client\UserIdentity as User;
use App\Models\Client\UserPasswd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'credential' => 'required|string',
            'password'   => 'required|string',
        ]);

        $credential = $data['credential'];
        $password   = $data['password'];

        if (filter_var($credential, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $credential)->first();
        } elseif (preg_match('/^[0-9]+$/', $credential)) {
            $user = User::where('phone', $credential)->first();
        } else {
            $user = User::where('username', $credential)->first();
        }

        if (! $user) {
            return response()->json([
                'message' => 'Data User yang anda maksudkan tidak terdaftar',
            ], 404);
        }

        $identity = User::where('uIdentities', $user->uIdentities)->first();

        if (! $identity) {
            return response()->json([
                'message' => 'Data identitas untuk pengguna ini tidak ditemukan',
            ], 404);
        }

        $userPassNew = UserPasswd::where('uIdentities', $identity->uIdentity ?? $identity->uIdentities)
            ->where('status', 'newPass')
            ->first();

        if ($userPassNew && Hash::check($password, $userPassNew->password)) {
            return response()->json([
                'message'     => 'Login berhasil',
                'kode'        => 200,
                'user_id'     => $user->id,
                'uIdentities' => $identity->uIdentity ?? $identity->uIdentities,
            ], 200);
        }

        $userPassOld = UserPasswd::where('uIdentities', $identity->uIdentity ?? $identity->uIdentities)
            ->where('status', 'oldPass')
            ->orderByDesc('updated_at')
            ->first();

        if ($userPassOld && Hash::check($password, $userPassOld->password)) {
            $lastUsed = DateTimeFormatHelper::diffSimple($userPassOld->updated_at);

            return response()->json([
                'message' => 'Anda menggunakan sandi lama anda yang dipakai terakhir kali ' . $lastUsed . ' yang lalu',
                'kode'    => 201,
                'user_id' => $user->id,
                'uIdentities' => $identity->uIdentity ?? $identity->uIdentities,
            ], 200);
        }

        return response()->json([
            'message' => 'Password anda salah',
        ], 401);
    }
}
