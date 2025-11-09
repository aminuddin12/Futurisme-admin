<?php

namespace App\Http\Controllers\Admin\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Insider\Auth\RegisterRequest;
use App\Http\Requests\Insider\Auth\LoginRequest;
use App\Http\Requests\Insider\Auth\ForgotPasswordRequest;
use App\Http\Requests\Insider\Auth\ResetPasswordRequest;
use App\Models\Insider\Insider;
use App\Models\Insider\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;

class InsiderAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $insider = Insider::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,
                //'status' => 'active',
                //'role' => 'insider',
                //'created_by' => $request->input('created_by') ?? null,
            ]);

            // Create profile if any profile fields provided
            $profileData = array_filter([
                //'id_code'=> $request->id_code,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'identity_number' => $request->identity_number,
                'identity_type' => $request->identity_type,
                'phone_region' => $request->phone_region,
                'phone_number' => $request->phone_number,
                // 'whatsapp_verified_status' => $request->whatsapp_verified_status ?? false,
            ], function ($v) {
                return $v !== null && $v !== '';
            });

            if (! empty($profileData)) {
                $profileData['uIdentification'] = $insider->uIdentification;
                $insider->profile()->create($profileData);
            }

            DB::commit();

            $token = $insider->createToken('insider-auth-token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Register successful',
                'data' => [
                    'user' => $insider->toPublicArray(),
                    'token' => $token,
                ]
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Register failed',
                'error' => $e->getMessage() . ' on line ' . $e->getLine(),
            ], 500);
        }
    }

    /**
     * Login by username or email
     */
    public function login(LoginRequest $request)
    {
        $credential = $request->credential;
        $password = $request->password;

        $insider = Insider::where('email', $credential)
            ->orWhere('username', $credential)
            ->first();

        if (! $insider || ! Hash::check($password, $insider->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $insider->load('profile');
        $token = $insider->createToken('insider-auth-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $insider->toPublicArray(),
                'token' => $token,
            ]
        ]);
    }

    /**
     * Logout (revoke current token)
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $token = $request->user()->currentAccessToken();
            if ($token) {
                $token->delete();
            } else {
                // delete all tokens as fallback
                $user->tokens()->delete();
            }
        }

        return response()->json(['success' => true, 'message' => 'Logged out']);
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $credential = $request->credential;
        $insider = Insider::where('email', $credential)
            ->orWhere('username', $credential)
            ->first();

        if (! $insider) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        // store token in password_resets table (Laravel default)
        $token = Str::random(64);
        DB::table('insider_password_resets')->insert([
            'email' => $insider->email,
            'token' => Hash::make($token), // hash token stored
            'created_at' => Carbon::now(),
        ]);

        // In production: send $token to user's email. For now return it (for testing)
        return response()->json([
            'success' => true,
            'message' => 'Reset token created',
            'data' => [
                'token' => $token
            ]
        ]);
    }

    /**
     * Reset password using token (token is unhashed plain token returned from forgotPassword)
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $credential = $request->credential;
        $token = $request->token;
        $newPassword = $request->password;

        $insider = Insider::where('email', $credential)
            ->orWhere('username', $credential)
            ->first();

        if (! $insider) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $record = DB::table('insider_password_resets')->where('email', $insider->email)->latest()->first();

        if (! $record || ! \Illuminate\Support\Str::startsWith($record->token, '$2y$') ) {
            // fallback: if token in DB is hashed, check
        }

        $valid = false;
        if ($record) {
            // match hashed token
            if (password_verify($token, $record->token) || Hash::check($token, $record->token)) {
                $valid = true;
            }
        }

        if (! $valid) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired token'], 400);
        }

        $insider->password = $newPassword;
        $insider->save();

        // remove reset record
        DB::table('insider_password_resets')->where('email', $insider->email)->delete();

        return response()->json(['success' => true, 'message' => 'Password has been reset']);
    }

    /**
     * Return currently authenticated insider
     */
    public function me(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->load('profile');
            return response()->json(['success' => true, 'data' => $user->toPublicArray()]);
        }
        return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
    }
}
