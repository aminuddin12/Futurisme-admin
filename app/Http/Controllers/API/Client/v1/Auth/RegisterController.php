<?php

namespace App\Http\Controllers\API\Client\v1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Client\UserIdentity;
use App\Models\Client\UserPasswd;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Helpers\LangHelper;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:user_identities,username',
            'email' => 'required|email|unique:user_identities,email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        DB::beginTransaction();
        try {
            $userIdentity = UserIdentity::create([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone ?? null,
                'status' => 'pending',
            ]);

            UserPasswd::create([
                'uIdentities' => $userIdentity->uIdentification,
                'password' => Hash::make($request->password),
                'status' => 'newPass',
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => LangHelper::msg('auth.registration_success'),
                'data' => [
                    'uIdentification' => $userIdentity->uIdentification,
                    'email' => $userIdentity->email,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => LangHelper::msg('auth.registration_failed'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
