<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GeneralPolicy
{
    use HandlesAuthorization;

    /**
     * Menentukan apakah pengguna (termasuk tamu) dapat melihat halaman dashboard publik.
     *
     * @param  \App\Models\User|null  $user
     * @return bool
     */
    public function viewPublicDashboard(?User $user): bool
    {
        // Semua orang, termasuk tamu, boleh melihat ini.
        return true;
    }

    /**
     * Menentukan apakah pengguna dapat mengakses fitur analitik.
     * Fitur ini hanya untuk pengguna yang login dan memiliki izin 'view-analytics'.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAnalytics(User $user): bool
    {
        // Gate untuk 'view-analytics' sudah kita daftarkan secara dinamis
        // di AppServiceProvider. Jadi kita bisa langsung menggunakannya.
        return $user->can('view-analytics');
    }
}
