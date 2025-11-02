<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- Define Permissions ---
        $permissions = [
            // General Admin Permissions (contoh)
            'manage settings', 'view dashboard stats', 'manage users', 'manage roles', 'impersonate user',
            // Insider Permissions (contoh)
            'view internal reports', 'access beta features', 'provide feedback', 'moderate content', 'view analytics',
            // Vendor Permissions (contoh)
            'manage products', 'view orders', 'manage vendor profile', 'respond to inquiries', 'access vendor dashboard',
            // Merchant Permissions (contoh)
            'manage store', 'process payments', 'view sales data', 'manage inventory', 'access merchant dashboard',
            // Driver Permissions (contoh)
            'accept delivery', 'update delivery status', 'view route', 'manage driver profile', 'access driver dashboard',
            // Customer Permissions (contoh)
            'place order', 'view own orders', 'update profile', 'manage addresses', 'view products',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web'); // Guard 'web' adalah default
        }

        // --- Define Roles ---
        $adminRole = Role::findOrCreate('Admin', 'web');
        $insiderRole = Role::findOrCreate('Insider', 'web');
        $vendorOwnerRole = Role::findOrCreate('Vendor Owner', 'web');
        $vendorTeamRole = Role::findOrCreate('Vendor Team', 'web');
        $merchantOwnerRole = Role::findOrCreate('Merchant Owner', 'web');
        $merchantTeamRole = Role::findOrCreate('Merchant Team', 'web');
        $driverRole = Role::findOrCreate('Driver', 'web');
        $customerRole = Role::findOrCreate('Customer', 'web'); // Default Role

        // --- Assign Permissions to Roles ---
        // Admin gets all permissions (handled by Gate::before later)

        // Insider
        $insiderRole->givePermissionTo(['view internal reports', 'access beta features', 'provide feedback', 'moderate content', 'view analytics']);

        // Vendor Owner (lebih banyak izin)
        $vendorOwnerRole->givePermissionTo(['manage products', 'view orders', 'manage vendor profile', 'respond to inquiries', 'access vendor dashboard']);
        // Vendor Team (izin lebih sedikit)
        $vendorTeamRole->givePermissionTo(['view orders', 'respond to inquiries', 'access vendor dashboard']); // Contoh

        // Merchant Owner
        $merchantOwnerRole->givePermissionTo(['manage store', 'process payments', 'view sales data', 'manage inventory', 'access merchant dashboard']);
        // Merchant Team
        $merchantTeamRole->givePermissionTo(['view sales data', 'manage inventory', 'access merchant dashboard']); // Contoh

        // Driver
        $driverRole->givePermissionTo(['accept delivery', 'update delivery status', 'view route', 'manage driver profile', 'access driver dashboard']);

        // Customer (izin dasar)
        $customerRole->givePermissionTo(['place order', 'view own orders', 'update profile', 'manage addresses', 'view products']);


        // --- Create Dummy Users ---
        $password = Hash::make('password');

        // Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => $password, 'email_verified_at' => now()]
        );
        $admin->assignRole($adminRole);

        // Insider User (Multi Role)
        // $insider = User::firstOrCreate(
        //     ['email' => 'insider@example.com'],
        //     ['name' => 'Insider User', 'password' => $password, 'email_verified_at' => now()]
        // );
        // $insider->assignRole($insiderRole, $customerRole); // Punya role Insider DAN Customer

        // Vendor Users
        // $vendorOwner = User::firstOrCreate(
        //     ['email' => 'vendor.owner@example.com'],
        //     ['name' => 'Vendor Owner', 'password' => $password, 'email_verified_at' => now()]
        // );
        // $vendorOwner->assignRole($vendorOwnerRole);

        // $vendorTeam = User::firstOrCreate(
        //     ['email' => 'vendor.team@example.com'],
        //     ['name' => 'Vendor Team Member', 'password' => $password, 'email_verified_at' => now()]
        // );
        // $vendorTeam->assignRole($vendorTeamRole);

        // Merchant Users
        // $merchantOwner = User::firstOrCreate(
        //     ['email' => 'merchant.owner@example.com'],
        //     ['name' => 'Merchant Owner', 'password' => $password, 'email_verified_at' => now()]
        // );
        // $merchantOwner->assignRole($merchantOwnerRole);

        // $merchantTeam = User::firstOrCreate(
        //     ['email' => 'merchant.team@example.com'],
        //     ['name' => 'Merchant Team Member', 'password' => $password, 'email_verified_at' => now()]
        // );
        // $merchantTeam->assignRole($merchantTeamRole);

        // Driver User
        // $driver = User::firstOrCreate(
        //     ['email' => 'driver@example.com'],
        //     ['name' => 'Driver User', 'password' => $password, 'email_verified_at' => now()]
        // );
        // $driver->assignRole($driverRole);

        // Customer User
        // $customer = User::firstOrCreate(
        //     ['email' => 'customer@example.com'],
        //     ['name' => 'Customer User', 'password' => $password, 'email_verified_at' => now()]
        // );
        // $customer->assignRole($customerRole);
    }
}
