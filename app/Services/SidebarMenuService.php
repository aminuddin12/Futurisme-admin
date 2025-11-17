<?php

namespace App\Services;

use App\Models\Core\SidebarMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Auth\Authenticatable;

class SidebarMenuService
{
    /**
     * Mendapatkan user yang sedang terautentikasi dari guard manapun.
     */
    private function getAuthenticatedUser()
    {
        if (Auth::guard('insider')->check()) {
            return Auth::guard('insider')->user();
        }
        if (Auth::guard('vendor')->check()) {
            return Auth::guard('vendor')->user();
        }
        if (Auth::guard('client')->check()) {
            return Auth::guard('client')->user();
        }
        return null;
    }

    /**
     * Mendapatkan nama guard yang sedang aktif.
     */
    private function getAuthenticatedGuard(): ?string
    {
        if (Auth::guard('insider')->check()) {
            return 'insider';
        }
        if (Auth::guard('vendor')->check()) {
            return 'vendor';
        }
        if (Auth::guard('client')->check()) {
            return 'client';
        }
        return null;
    }

    /**
     * Membangun menu sidebar yang lengkap untuk pengguna yang sedang login.
     */
    public function buildMenu(): array
    {
        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return []; // Tidak ada menu jika tidak ada user
        }

        $guard = $this->getAuthenticatedGuard();

        $topLevelGroups = SidebarMenu::forGuard($guard)
            ->topLevel()
            ->orderBy('order')
            ->get();

        // Panggil buildMenuTree untuk grup level atas
        return $this->buildMenuTree($user, $topLevelGroups, true);
    }


    /**
     * Membangun pohon menu secara rekursif dan memfilter berdasarkan permission.
     *
     * @param mixed $user User yang login
     * @param Collection $items Item menu (bisa grup atau item)
     * @param bool $isGroupLevel Apakah ini level grup teratas (group-apps)
     * @return array
     */
    private function buildMenuTree(Authenticatable $user, Collection $items, bool $isGroupLevel = false): array
    {
        $menu = [];

        foreach ($items as $item) {
            /** @var \App\Models\Core\SidebarMenu $item */
            if (!$this->userCanView($user, $item)) {
                continue;
            }

            $menuItem = [
                'key' => $item->key,
                'label' => $item->label,
                'icon' => $item->icon,
                'iconFilled' => $item->icon_filled,
                'href' => $item->href ? url($item->href) : null,
                'routeName' => $item->route_name,
                'badge' => $item->badge,
            ];

            // Jika kita di level grup (e.g., group-apps)
            if ($isGroupLevel) {
                $menuItem['title'] = $item->title;
                $children = $item->children()->orderBy('order')->get();
                // Panggil rekursif untuk 'items' di dalam grup
                $menuItem['items'] = $this->buildMenuTree($user, $children, false);

                // Pruning: Jika grup tidak punya 'items' yang bisa dilihat, jangan tampilkan grup
                // Kecuali jika grup itu sendiri adalah link (seperti 'insiderDashboard')
                if (empty($menuItem['items']) && !$menuItem['href']) {
                    continue;
                }
            }
            // Jika kita di level item (e.g., menu-ai)
            else {
                $children = $item->children()->orderBy('order')->get();
                if ($children->isNotEmpty()) {
                    // Panggil rekursif untuk 'submenu' di dalam item
                    $submenu = $this->buildMenuTree($user, $children, false);
                    if (!empty($submenu)) {
                        $menuItem['submenu'] = $submenu;
                    }
                }

                // Pruning: Jika item tidak punya href DAN tidak punya submenu (setelah difilter), jangan tampilkan
                if (!$menuItem['href'] && empty($menuItem['submenu'])) {
                    continue;
                }
            }

            $menu[] = $menuItem;
        }

        return $menu;
    }

    /**
     * Memeriksa apakah user memiliki izin untuk melihat item menu.
     */
    private function userCanView($user, SidebarMenu $item): bool
    {
        // 1. Super Admin melihat segalanya (hanya jika user memiliki fungsi hasRole)
        if (method_exists($user, 'hasRole') && $user->hasRole('Super Admin')) {
            return true;
        }

        // 2. Jika tidak ada permission, anggap publik (untuk guard ini)
        if (empty($item->permissions)) {
            return true;
        }

        // 3. Periksa permission
        if (method_exists($user, 'hasAnyPermission')) {
            return $user->hasAnyPermission($item->permissions);
        }

        // Fallback jika user model tidak menggunakan Spatie/permission
        return false;
    }
}
