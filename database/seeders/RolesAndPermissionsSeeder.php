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
        $guardClient = 'client'; // Anda juga bisa menggunakan 'web' jika itu guard untuk pelanggan

        // 3. Buat Permissions untuk setiap guard

        // === PERMISSIONS UNTUK INSIDER (Pegawai) ===
        Permission::create(['name' => 'manage settings', 'guard_name' => $guardInsider]);
        Permission::create(['name' => 'view dashboard', 'guard_name' => $guardInsider]);
        Permission::create(['name' => 'manage insiders', 'guard_name' => $guardInsider]);
        Permission::create(['name' => 'manage vendors', 'guard_name' => $guardInsider]);
        Permission::create(['name' => 'manage clients', 'guard_name' => $guardInsider]);

        // === PERMISSIONS UNTUK VENDOR (Penyedia) ===
        Permission::create(['name' => 'view vendor dashboard', 'guard_name' => $guardVendor]);
        Permission::create(['name' => 'manage products', 'guard_name' => $guardVendor]);
        Permission::create(['name' => 'manage orders', 'guard_name' => $guardVendor]);

        // === PERMISSIONS UNTUK CLIENT (Pelanggan) ===
        Permission::create(['name' => 'view client dashboard', 'guard_name' => $guardClient]);
        Permission::create(['name' => 'make purchases', 'guard_name' => $guardClient]);
        Permission::create(['name' => 'view own profile', 'guard_name' => $guardClient]);


        // 4. Buat Roles dan berikan permissions

        // === ROLE UNTUK INSIDER ===
        // Role Super Admin (memiliki semua izin insider)
        $superAdminRole = Role::create(['name' => 'Super Admin', 'guard_name' => $guardInsider]);
        $superAdminRole->givePermissionTo(Permission::where('guard_name', $guardInsider)->get());

        // Role Staff (hanya bisa melihat dashboard)
        $staffRole = Role::create(['name' => 'Staff', 'guard_name' => $guardInsider]);
        $staffRole->givePermissionTo('view dashboard');


        // === ROLE UNTUK VENDOR ===
        $vendorRole = Role::create(['name' => 'Vendor', 'guard_name' => $guardVendor]);
        $vendorRole->givePermissionTo([
            'view vendor dashboard',
            'manage products',
            'manage orders',
        ]);

        // === ROLE UNTUK CLIENT ===
        $clientRole = Role::create(['name' => 'Customer', 'guard_name' => $guardClient]);
        $clientRole->givePermissionTo([
            'view client dashboard',
            'make purchases',
            'view own profile',
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
