<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Core\SidebarMenu;

class SidebarMenuSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat
        SidebarMenu::query()->delete();

        // ----------------------------------------
        // --- INSIDER MENU (GUARD: 'insider') ---
        // ----------------------------------------

        // Grup Dashboard
        $insiderDashboard = SidebarMenu::create([
            'key' => 'group-insider-dash',
            'label' => 'Dashboard',
            'title' => 'Dashboard',
            'icon' => 'heroicons:home',
            'icon_filled' => 'heroicons:home-solid',
            'href' => '/insider/dashboard',
            'route_name' => 'insider.dashboard',
            'guard_name' => 'insider',
            'permissions' => ['view dashboard'],
            'order' => 1,
        ]);

        // Grup Apps
        $groupApps = SidebarMenu::create([
            'key' => 'group-apps',
            'label' => 'Apps',
            'title' => 'Apps', // Ini adalah judul grup
            'guard_name' => 'insider',
            'order' => 2,
        ]);

            // Item AI
            $menuAi = SidebarMenu::create([
                'parent_id' => $groupApps->id,
                'key' => 'menu-ai',
                'label' => 'AI Assistant',
                'icon' => 'heroicons:cpu-chip',
                'icon_filled' => 'heroicons:cpu-chip-solid',
                'badge' => json_encode(['type' => 'text', 'content' => 'New', 'color' => 'emerald']),
                'guard_name' => 'insider',
                'permissions' => ['view ai assistant'],
                'order' => 1,
            ]);
                SidebarMenu::create([
                    'parent_id' => $menuAi->id,
                    'key' => 'sub-chat',
                    'label' => 'Chat',
                    'href' => '/insider/chat', // Gunakan URL statis, route() akan di-handle di React
                    'route_name' => 'insider.chat',
                    'guard_name' => 'insider',
                    'permissions' => ['view ai chat'],
                    'order' => 1,
                ]);
                SidebarMenu::create([
                    'parent_id' => $menuAi->id,
                    'key' => 'sub-img',
                    'label' => 'Image Gen',
                    'href' => '#',
                    'route_name' => 'admin.ai.image',
                    'guard_name' => 'insider',
                    'permissions' => ['view ai image'],
                    'order' => 2,
                ]);

            // Item E-commerce
            $menuEcom = SidebarMenu::create([
                'parent_id' => $groupApps->id,
                'key' => 'menu-ecom',
                'label' => 'E-commerce',
                'icon' => 'heroicons:shopping-cart',
                'icon_filled' => 'heroicons:shopping-cart-solid',
                'badge' => json_encode(['type' => 'number', 'content' => 5, 'color' => 'red']),
                'guard_name' => 'insider',
                'permissions' => ['view e-commerce'],
                'order' => 2,
            ]);
                SidebarMenu::create([
                    'parent_id' => $menuEcom->id,
                    'key' => 'sub-prod',
                    'label' => 'Products',
                    'href' => '#',
                    'route_name' => 'admin.ecommerce.products',
                    'guard_name' => 'insider',
                    'permissions' => ['view products'],
                    'order' => 1,
                ]);
                SidebarMenu::create([
                    'parent_id' => $menuEcom->id,
                    'key' => 'sub-order',
                    'label' => 'Orders',
                    'href' => '#',
                    'route_name' => 'admin.ecommerce.orders',
                    'guard_name' => 'insider',
                    'permissions' => ['view orders'],
                    'order' => 2,
                ]);
                // ... (tambahkan Customers dan Reports jika perlu)

            // Item Blog
            $menuBlog = SidebarMenu::create([
                'parent_id' => $groupApps->id,
                'key' => 'menu-blog',
                'label' => 'Blog',
                'icon' => 'heroicons:pencil-square',
                'icon_filled' => 'heroicons:pencil-square-solid',
                'guard_name' => 'insider',
                'permissions' => ['view blog'],
                'order' => 3,
            ]);
                SidebarMenu::create([
                    'parent_id' => $menuBlog->id,
                    'key' => 'sub-posts',
                    'label' => 'Posts',
                    'href' => '#',
                    'route_name' => 'admin.blog.posts',
                    'guard_name' => 'insider',
                    'permissions' => ['view posts'],
                    'order' => 1,
                ]);
                // ... (tambahkan Categories dan Tags jika perlu)

            // Item Email
            SidebarMenu::create([
                'parent_id' => $groupApps->id,
                'key' => 'menu-email',
                'label' => 'Email',
                'icon' => 'heroicons:envelope',
                'icon_filled' => 'heroicons:envelope-solid',
                'href' => '#',
                'route_name' => 'admin.email',
                'guard_name' => 'insider',
                'permissions' => ['view email'],
                'order' => 4,
            ]);

            // Item Ticket
            SidebarMenu::create([
                'parent_id' => $groupApps->id,
                'key' => 'menu-ticket',
                'label' => 'Support Ticket',
                'icon' => 'heroicons:ticket',
                'icon_filled' => 'heroicons:ticket-solid',
                'badge' => json_encode(['type' => 'number', 'content' => 12, 'color' => 'gray']),
                'href' => '#',
                'route_name' => 'admin.tickets',
                'guard_name' => 'insider',
                'permissions' => ['view tickets'],
                'order' => 5,
            ]);

        // ----------------------------------------
        // --- VENDOR MENU (GUARD: 'vendor') ---
        // ----------------------------------------
        $vendorGroup = SidebarMenu::create([
            'key' => 'group-vendor-dash',
            'label' => 'Dashboard',
            'title' => 'My Store',
            'icon' => 'heroicons:building-storefront',
            'icon_filled' => 'heroicons:building-storefront-solid',
            'href' => '#',
            'route_name' => 'vendor.dashboard',
            'guard_name' => 'vendor',
            'permissions' => ['view vendor dashboard'],
            'order' => 1,
        ]);
            SidebarMenu::create([
                'parent_id' => $vendorGroup->id,
                'key' => 'vendor-products',
                'label' => 'My Products',
                'icon' => 'heroicons:archive-box',
                'icon_filled' => 'heroicons:archive-box-solid',
                'href' => '#',
                'route_name' => 'vendor.products',
                'guard_name' => 'vendor',
                'permissions' => ['manage vendor products'],
                'order' => 1,
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorGroup->id,
                'key' => 'vendor-orders',
                'label' => 'My Orders',
                'icon' => 'heroicons:shopping-bag',
                'icon_filled' => 'heroicons:shopping-bag-solid',
                'href' => '#',
                'route_name' => 'vendor.orders',
                'guard_name' => 'vendor',
                'permissions' => ['view vendor orders'],
                'order' => 2,
            ]);

        // ----------------------------------------
        // --- CLIENT/WEB MENU (GUARD: 'web') ---
        // ----------------------------------------
        $clientGroup = SidebarMenu::create([
            'key' => 'group-client-dash',
            'label' => 'Dashboard',
            'title' => 'My Account',
            'icon' => 'heroicons:user-circle',
            'icon_filled' => 'heroicons:user-circle-solid',
            'href' => '#',
            'route_name' => 'client.dashboard',
            'guard_name' => 'web',
            'permissions' => ['view client dashboard'],
            'order' => 1,
        ]);
            SidebarMenu::create([
                'parent_id' => $clientGroup->id,
                'key' => 'client-orders',
                'label' => 'My Orders',
                'icon' => 'heroicons:truck',
                'icon_filled' => 'heroicons:truck-solid',
                'href' => '#',
                'route_name' => 'client.orders',
                'guard_name' => 'web',
                'permissions' => ['view client orders'],
                'order' => 1,
            ]);
            SidebarMenu::create([
                'parent_id' => $clientGroup->id,
                'key' => 'client-profile',
                'label' => 'My Profile',
                'icon' => 'heroicons:user',
                'icon_filled' => 'heroicons:user-solid',
                'href' => '#',
                'route_name' => 'client.profile',
                'guard_name' => 'web',
                'permissions' => ['view client profile'],
                'order' => 2,
            ]);
    }
}
