<?php

namespace App\Http\Controllers\Insider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Insider\Role;
use App\Models\Insider\Permission;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard Insider dengan data peran dan izin.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        // Mengambil data dan mengirimkannya ke view Inertia
        return Inertia::render('Insider/Dashboard', [
            'userRoles' => $user->getRoleNames(),
            'allRoles' => Role::latest()->paginate(50)->withQueryString(),
            'allPermissions' => Permission::latest()->paginate(50)->withQueryString(),
        ]);
    }

    public function adminDashboard()
    {
        return Inertia::render('Dashboard/AdminDashboard');
    }

    public function accountingDashboard()
    {
        return Inertia::render('Dashboard/AccountingDashboard');
    }

    public function developerDashboard()
    {
        return Inertia::render('Dashboard/DeveloperDashboard');
    }

    public function hrDashboard()
    {
        return Inertia::render('Dashboard/HrDashboard');
    }

    public function salesDashboard()
    {
        return Inertia::render('Dashboard/SalesDashboard');
    }

    public function vendorsAdminDashboard()
    {
        return Inertia::render('Dashboard/VendorsAdminDashboard');
    }

    public function csDashboard()
    {
        return Inertia::render('Dashboard/CsDashboard');
    }

    public function marketingDashboard()
    {
        return Inertia::render('Dashboard/MarketingDashboard');
    }
}
