<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Insider\Insider; // Model untuk Admin
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Reset cached roles and permissions
        // Ini penting agar Spatie mengenali guard baru
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Definisikan Nama Guard
        $guardInsider = 'insider';
        $guardVendor = 'vendor';
        $guardClient = 'client';

        // 3. Buat Permissions untuk setiap guard

        // FOR INSIDER PERMISSIONS
        // Group Dashboard
        Permission::firstOrCreate(['name' => 'access super admin dashboard', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access admin dashboard', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access accounting dashboard', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access developer dashboard', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access human resources dashboard', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access sales dashboard', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access vendors admin dashboard', 'guard_name' => $guardInsider]); //page jika pengelola vendor
        Permission::firstOrCreate(['name' => 'access customer service dashboard', 'guard_name' => $guardInsider]); //page

        //Group Search management
        Permission::firstOrCreate(['name' => 'access global search', 'guard_name' => $guardInsider]); //page and function
        Permission::firstOrCreate(['name' => 'access insiders search', 'guard_name' => $guardInsider]); //page and function
        Permission::firstOrCreate(['name' => 'access vendors search', 'guard_name' => $guardInsider]); //page and function
        Permission::firstOrCreate(['name' => 'access clients search', 'guard_name' => $guardInsider]); //page and function
        Permission::firstOrCreate(['name' => 'access products search', 'guard_name' => $guardInsider]); //page and function
        Permission::firstOrCreate(['name' => 'access orders search', 'guard_name' => $guardInsider]); //page and function
        Permission::firstOrCreate(['name' => 'access blog posts search', 'guard_name' => $guardInsider]); //page and function
        Permission::firstOrCreate(['name' => 'access tickets search', 'guard_name' => $guardInsider]); //page and function
        Permission::firstOrCreate(['name' => 'access promos search', 'guard_name' => $guardInsider]); //page and function

        // Group Insider Management
        Permission::firstOrCreate(['name' => 'insider and team dashboard', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'create new insider', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'update status insider', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access all insider wages', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'create insider wages', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'update insider wages', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access all insider attendances', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'create insider attendance', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'update insider attendance', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access all insider divisions', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'create insider division', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'update insider division', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access all insider leaves', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'create insider leaves', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'update insider leaves', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access all insider profiles', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'create insider profiles', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'update insider profiles', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access all insider positions', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'create insider position', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'update insider position', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'access all insider projects', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'create insider project', 'guard_name' => $guardInsider]); //page
        Permission::firstOrCreate(['name' => 'update insider project', 'guard_name' => $guardInsider]); //page

        // Group Vendors
        Permission::firstOrCreate(['name' => 'vendors and pos dashboard', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'create new vendor', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'create new vendor stores', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'update vendor details', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all vendors', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all vendors teams', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all vendors transactions', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all vendors stores', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all vendors products', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all vendors orders', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all vendors promos', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all vendors reports', 'guard_name' => $guardInsider]);

        // Group Client
        Permission::firstOrCreate(['name' => 'access all client', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'create new client', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'update status client', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all client reports', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all client orders', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all client reports', 'guard_name' => $guardInsider]);

        // Group Blogs
        Permission::firstOrCreate(['name' => 'access all blog', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'view all blog', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can create blog post', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can update blog post', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can delete blog post', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all categories', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can create categories', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can update categories', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can delete categories', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all tags', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can create tags', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can update tags', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can delete tags', 'guard_name' => $guardInsider]);

        // Group Communication and Documentation
        Permission::firstOrCreate(['name' => 'access all documents', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can create documents', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can update documents', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access email', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access chat', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access tickets', 'guard_name' => $guardInsider]);

        //Group Role and Permission Management
        Permission::firstOrCreate(['name' => 'access all insider roles', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can update insider roles', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can create insider roles', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all insider permission', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can update insider permission', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all vendor roles', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can update vendor roles', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all vendor permission', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can update vendor permission', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all client roles', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can update client roles', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all client permission', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'can update client permission', 'guard_name' => $guardInsider]);

        //Group Payments and Transactions
        Permission::firstOrCreate(['name' => 'payment and transactions dashboard', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all transactions', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all payments', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all invoices', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all refunds', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all subscriptions', 'guard_name' => $guardInsider]);

        //group Site Management
        Permission::firstOrCreate(['name' => 'access API settings', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access site settings', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access payments settings', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access chat settings', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access login settings', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access site logs', 'guard_name' => $guardInsider]);

        //Group general access for insider
        Permission::firstOrCreate(['name' => 'access self profile', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'update self profile', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access self attendance', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access self wage', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access self division', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access self leave', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access self position', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access self project', 'guard_name' => $guardInsider]);


        // FOR VENDOR PERMISSIONS
        // Vendor Owner Permissions
        Permission::firstOrCreate(['name' => 'access vendor dashboard', 'guard_name' => $guardVendor]);
        Permission::firstOrCreate(['name' => 'manage vendor store', 'guard_name' => $guardVendor]);
        Permission::firstOrCreate(['name' => 'manage vendor products', 'guard_name' => $guardVendor]);
        Permission::firstOrCreate(['name' => 'manage vendor orders', 'guard_name' => $guardVendor]);
        Permission::firstOrCreate(['name' => 'access vendor profile', 'guard_name' => $guardVendor]);


        //FOR CLIENT PERMISSIONS
        // Client (Client) Permissions
        Permission::firstOrCreate(['name' => 'access client dashboard', 'guard_name' => $guardClient]);
        Permission::firstOrCreate(['name' => 'access client orders', 'guard_name' => $guardClient]);
        Permission::firstOrCreate(['name' => 'access client profile', 'guard_name' => $guardClient]);



        // 4. Buat Roles dan berikan permissions

        // === ROLE UNTUK INSIDER ===
        // Role Super Admin (memiliki semua izin insider)
        $superAdminRole = Role::create(['name' => 'Super Admin', 'guard_name' => $guardInsider]);
        $superAdminRole->givePermissionTo([
            'access super admin dashboard',
            'access ai assistant',
            'access ai chat',
            'access e-commerce',
            'access products',
            'access orders',
            'access blog',
            'access posts',
            'access tickets',
        ]);

        // Role Staff (hanya bisa melihat dashboard)
        $staffRole = Role::create(['name' => 'Staff', 'guard_name' => $guardInsider]);
        $staffRole->givePermissionTo('access admin dashboard');


        // === ROLE UNTUK VENDOR ===
        $vendorRole = Role::create(['name' => 'Vendor', 'guard_name' => $guardVendor]);
        $vendorRole->givePermissionTo([
            'access vendor dashboard',
            'manage vendor products',
            'manage vendor orders',
        ]);

        // === ROLE UNTUK CLIENT ===
        $clientRole = Role::create(['name' => 'Customer', 'guard_name' => $guardClient]);
        $clientRole->givePermissionTo([
            'access client dashboard',
            'access client orders',
            'access client profile',
        ]);

        // 5. Buat User Super Admin (Insider)
        // Pastikan tidak ada data duplikat
        $adminUser = Insider::firstOrCreate(
            ['email' => 'admin@futurisme.com'], // Cari berdasarkan email
            [ // Data untuk dibuat jika tidak ada
                'username' => 'superadmin',
                'password' => Hash::make('password123') // GANTI DENGAN PASSWORD YANG AMAN
            ]
        );

        // 6. Tetapkan Role ke User
        $adminUser->assignRole($superAdminRole);
    }
}
