<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Insider\Profile;

class AdminController extends Controller
{
    public function approveProfile($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->is_approved = true;
        $profile->save();

        // generate id_code otomatis
        $profile->assignIdCodeIfApproved();

        return response()->json([
            'success' => true,
            'message' => 'Profile approved and ID code generated',
            'data' => [
                'id_code' => $profile->id_code
            ]
        ]);
    }

}
