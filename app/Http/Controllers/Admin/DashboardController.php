<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Role;
use App\Models\Permission;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan data peran dan izin.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        // Mengambil data dan mengirimkannya ke view Inertia
        return Inertia::render('Admin/Dashboard', [
            'userRoles' => $user->getRoleNames(),
            'allRoles' => Role::latest()->paginate(50)->withQueryString(),
            'allPermissions' => Permission::latest()->paginate(50)->withQueryString(),
        ]);
    }
}
