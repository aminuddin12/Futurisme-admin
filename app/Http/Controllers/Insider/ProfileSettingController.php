<?php

namespace App\Http\Controllers\Insider;

use App\Http\Controllers\Controller;
use App\Models\Insider\Division;
use App\Models\Insider\Insider;
use App\Models\Insider\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfileSettingController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request)
    {
        $insider = Auth::guard('insider')->user();
        $profile = $insider->profile;
        $positions = Position::all();
        $divisions = Division::all();

        return Inertia::render('Profile/AccountProfile', [
            'insider' => $insider,
            'profile' => $profile,
            'positions' => $positions,
            'divisions' => $divisions,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $insider = Auth::guard('insider')->user();
        $profile = $insider->profile;

        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:insiders,email,' . $insider->id,
            'username' => 'nullable|string|max:255|unique:insiders,username,' . $insider->id,
            'position_id' => 'nullable|exists:positions,id',
            'division_id' => 'nullable|exists:divisions,id',
            // Add other profile fields validation here
        ]);

        $insider->update([
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
        ]);

        $profile->update($validatedData);

        return back()->with('success', 'Profile updated successfully.');
    }
}
