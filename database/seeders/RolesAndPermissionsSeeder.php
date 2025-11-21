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
        $SuperDashboard = Permission::firstOrCreate(['name' => 'access super admin dashboard', 'guard_name' => $guardInsider]); //page
                        Permission::firstOrCreate(['name' => 'access admin dashboard', 'guard_name' => $guardInsider, 'parent_id' => $SuperDashboard->id]); //page
                        Permission::firstOrCreate(['name' => 'access accounting dashboard', 'guard_name' => $guardInsider, 'parent_id' => $SuperDashboard->id]); //page
                        Permission::firstOrCreate(['name' => 'access developer dashboard', 'guard_name' => $guardInsider, 'parent_id' => $SuperDashboard->id]); //page
                        Permission::firstOrCreate(['name' => 'access human resources dashboard', 'guard_name' => $guardInsider, 'parent_id' => $SuperDashboard->id]); //page
                        Permission::firstOrCreate(['name' => 'access sales dashboard', 'guard_name' => $guardInsider, 'parent_id' => $SuperDashboard->id]); //page
                        Permission::firstOrCreate(['name' => 'access vendors admin dashboard', 'guard_name' => $guardInsider, 'parent_id' => $SuperDashboard->id]); //page jika pengelola vendor
                        Permission::firstOrCreate(['name' => 'access customer service dashboard', 'guard_name' => $guardInsider, 'parent_id' => $SuperDashboard->id]); //page
                        Permission::firstOrCreate(['name' => 'access marketing dashboard', 'guard_name' => $guardInsider, 'parent_id' => $SuperDashboard->id]); //page

        //Group Search management
        $globalSearch = Permission::firstOrCreate(['name' => 'access global search', 'guard_name' => $guardInsider]); //page and function
                        Permission::firstOrCreate(['name' => 'access insiders search', 'guard_name' => $guardInsider, 'parent_id' => $globalSearch->id]); //page and function
                        Permission::firstOrCreate(['name' => 'access vendors search', 'guard_name' => $guardInsider, 'parent_id' => $globalSearch->id]); //page and function
                        Permission::firstOrCreate(['name' => 'access clients search', 'guard_name' => $guardInsider, 'parent_id' => $globalSearch->id]); //page and function
                        Permission::firstOrCreate(['name' => 'access products search', 'guard_name' => $guardInsider, 'parent_id' => $globalSearch->id]); //page and function
                        Permission::firstOrCreate(['name' => 'access orders search', 'guard_name' => $guardInsider, 'parent_id' => $globalSearch->id]); //page and function
                        Permission::firstOrCreate(['name' => 'access blog posts search', 'guard_name' => $guardInsider, 'parent_id' => $globalSearch->id]); //page and function
                        Permission::firstOrCreate(['name' => 'access tickets search', 'guard_name' => $guardInsider, 'parent_id' => $globalSearch->id]); //page and function
                        Permission::firstOrCreate(['name' => 'access promos search', 'guard_name' => $guardInsider, 'parent_id' => $globalSearch->id]); //page and function

        // Group Communication
        Permission::firstOrCreate(['name' => 'access self email', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access all emails', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access self chat', 'guard_name' => $guardInsider]);
        Permission::firstOrCreate(['name' => 'access tickets', 'guard_name' => $guardInsider]);

        // Group Insider Management
        $insiderManagement = Permission::firstOrCreate(['name' => 'insider and team dashboard', 'guard_name' => $guardInsider]); //page
                        Permission::firstOrCreate(['name' => 'impersonate insider', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]);
                        Permission::firstOrCreate(['name' => 'create new insider', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'update status insider', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'access all insider wages', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'create insider wages', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'update insider wages', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'access all insider attendances', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'create insider attendance', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'update insider attendance', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'access all insider divisions', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'create insider division', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'update insider division', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'access all insider leaves', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'create insider leaves', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'update insider leaves', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'access all insider profiles', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'create insider profiles', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'update insider profiles', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'access all insider positions', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'create insider position', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'update insider position', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'access all insider projects', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'create insider project', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page
                        Permission::firstOrCreate(['name' => 'update insider project', 'guard_name' => $guardInsider, 'parent_id' => $insiderManagement->id]); //page

        // Group Vendors Management
        $vPOS = Permission::firstOrCreate(['name' => 'vendors and pos dashboard', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'impersonate vendor', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'notify all vendors', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'create new vendor', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'create new vendor stores', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'update vendor details', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'update vendor status', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'update vendor subscription', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'access all vendors', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'access all vendors teams', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'access all vendors transactions', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'access all vendors stores', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'access all vendors products', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'access all vendors orders', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'access all vendors promos', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'access all vendors reports', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);
                        Permission::firstOrCreate(['name' => 'view vendors', 'guard_name' => $guardInsider, 'parent_id' => $vPOS->id]);

        // Group Client
        $acAllClient= Permission::firstOrCreate(['name' => 'access all client', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'impersonate client', 'guard_name' => $guardInsider, 'parent_id' => $acAllClient->id]);
                        Permission::firstOrCreate(['name' => 'notify all client', 'guard_name' => $guardInsider, 'parent_id' => $acAllClient->id]);
                        Permission::firstOrCreate(['name' => 'create new client', 'guard_name' => $guardInsider, 'parent_id' => $acAllClient->id]);
                        Permission::firstOrCreate(['name' => 'edit client profile', 'guard_name' => $guardInsider, 'parent_id' => $acAllClient->id]);
                        Permission::firstOrCreate(['name' => 'update status client', 'guard_name' => $guardInsider, 'parent_id' => $acAllClient->id]);
                        Permission::firstOrCreate(['name' => 'access all client reports', 'guard_name' => $guardInsider, 'parent_id' => $acAllClient->id]);
                        Permission::firstOrCreate(['name' => 'update client reports', 'guard_name' => $guardInsider, 'parent_id' => $acAllClient->id]);
                        Permission::firstOrCreate(['name' => 'access all client orders', 'guard_name' => $guardInsider, 'parent_id' => $acAllClient->id]);
                        Permission::firstOrCreate(['name' => 'update client orders', 'guard_name' => $guardInsider, 'parent_id' => $acAllClient->id]);

        // Group Blogs
        $pageManagement = Permission::firstOrCreate(['name' => 'access all page management', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'view all page', 'guard_name' => $guardInsider, 'parent_id' => $pageManagement->id]);
                        Permission::firstOrCreate(['name' => 'can create page', 'guard_name' => $guardInsider, 'parent_id' => $pageManagement->id]);
                        Permission::firstOrCreate(['name' => 'can update page', 'guard_name' => $guardInsider, 'parent_id' => $pageManagement->id]);
                        Permission::firstOrCreate(['name' => 'can delete page', 'guard_name' => $guardInsider, 'parent_id' => $pageManagement->id]);
                        Permission::firstOrCreate(['name' => 'view page', 'guard_name' => $guardInsider, 'parent_id' => $pageManagement->id]);
        //blog
        $blogInsider = Permission::firstOrCreate(['name' => 'access all blog management', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'view all blog', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);
                        Permission::firstOrCreate(['name' => 'can create blog post', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);
                        Permission::firstOrCreate(['name' => 'can update blog post', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);
                        Permission::firstOrCreate(['name' => 'can delete blog post', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);
                        Permission::firstOrCreate(['name' => 'access all categories', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);
                        Permission::firstOrCreate(['name' => 'can create categories', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);
                        Permission::firstOrCreate(['name' => 'can update categories', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);
                        Permission::firstOrCreate(['name' => 'can delete categories', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);
                        Permission::firstOrCreate(['name' => 'access all tags', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);
                        Permission::firstOrCreate(['name' => 'can create tags', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);
                        Permission::firstOrCreate(['name' => 'can update tags', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);
                        Permission::firstOrCreate(['name' => 'can delete tags', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);
                        Permission::firstOrCreate(['name' => 'view blog', 'guard_name' => $guardInsider, 'parent_id' => $blogInsider->id]);

        // Group Marketing Management
        $iMarketingManagement = Permission::firstOrCreate(['name' => 'access all marketing management', 'guard_name' => $guardInsider]);
                        // Markeiting Campaign
                        Permission::firstOrCreate(['name' => 'can create marketing campaign', 'guard_name' => $guardInsider, 'parent_id' => $iMarketingManagement->id]);
                        Permission::firstOrCreate(['name' => 'can update marketing campaign', 'guard_name' => $guardInsider, 'parent_id' => $iMarketingManagement->id]);
                        Permission::firstOrCreate(['name' => 'can delete marketing campaign', 'guard_name' => $guardInsider, 'parent_id' => $iMarketingManagement->id]);
                        Permission::firstOrCreate(['name' => 'view all marketing campaign', 'guard_name' => $guardInsider, 'parent_id' => $iMarketingManagement->id]);
                        // Marketing subscription
                        Permission::firstOrCreate(['name' => 'can create subscription', 'guard_name' => $guardInsider, 'parent_id' => $iMarketingManagement->id]);
                        Permission::firstOrCreate(['name' => 'can update subscription', 'guard_name' => $guardInsider, 'parent_id' => $iMarketingManagement->id]);
                        Permission::firstOrCreate(['name' => 'can delete subscription', 'guard_name' => $guardInsider, 'parent_id' => $iMarketingManagement->id]);
                        Permission::firstOrCreate(['name' => 'view all subscription', 'guard_name' => $guardInsider, 'parent_id' => $iMarketingManagement->id]);
                        // Marketing Badge
                        Permission::firstOrCreate(['name' => 'can create badge', 'guard_name' => $guardInsider, 'parent_id' => $iMarketingManagement->id]);
                        Permission::firstOrCreate(['name' => 'can update badge', 'guard_name' => $guardInsider, 'parent_id' => $iMarketingManagement->id]);
                        Permission::firstOrCreate(['name' => 'can delete badge', 'guard_name' => $guardInsider, 'parent_id' => $iMarketingManagement->id]);
                        Permission::firstOrCreate(['name' => 'view all badge', 'guard_name' => $guardInsider, 'parent_id' => $iMarketingManagement->id]);

        //Group Role and Permission Management
        $RolesAndPermission = Permission::firstOrCreate(['name' => 'access all roles and Permission', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'access all insider roles', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);
                        Permission::firstOrCreate(['name' => 'can update insider roles', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);
                        Permission::firstOrCreate(['name' => 'can create insider roles', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);
                        Permission::firstOrCreate(['name' => 'access all insider permission', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);
                        Permission::firstOrCreate(['name' => 'can update insider permission', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);
                        Permission::firstOrCreate(['name' => 'access all vendor roles', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);
                        Permission::firstOrCreate(['name' => 'can update vendor roles', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);
                        Permission::firstOrCreate(['name' => 'access all vendor permission', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);
                        Permission::firstOrCreate(['name' => 'can update vendor permission', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);
                        Permission::firstOrCreate(['name' => 'access all client roles', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);
                        Permission::firstOrCreate(['name' => 'can update client roles', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);
                        Permission::firstOrCreate(['name' => 'access all client permission', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);
                        Permission::firstOrCreate(['name' => 'can update client permission', 'guard_name' => $guardInsider, 'parent_id' => $RolesAndPermission->id]);

        // Group Notifications
        $notificationGroup = Permission::firstOrCreate(['name' => 'access notification management', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'send broadcast notification', 'guard_name' => $guardInsider, 'parent_id' => $notificationGroup->id]);
                        Permission::firstOrCreate(['name' => 'manage notification templates', 'guard_name' => $guardInsider, 'parent_id' => $notificationGroup->id]);

        // Group Settings (General)
        $generalSettingsGroup = Permission::firstOrCreate(['name' => 'access general settings', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'update general settings', 'guard_name' => $guardInsider, 'parent_id' => $generalSettingsGroup->id]);
                        Permission::firstOrCreate(['name' => 'access localization settings', 'guard_name' => $guardInsider, 'parent_id' => $generalSettingsGroup->id]);
                        Permission::firstOrCreate(['name' => 'update localization settings', 'guard_name' => $guardInsider, 'parent_id' => $generalSettingsGroup->id]);

        // Group Payments and Transactions
        $PaymentAndTransaction = Permission::firstOrCreate(['name' => 'access all payment and transaction', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'payment and transactions dashboard', 'guard_name' => $guardInsider, 'parent_id' => $PaymentAndTransaction->id]);
                        Permission::firstOrCreate(['name' => 'access all transactions', 'guard_name' => $guardInsider, 'parent_id' => $PaymentAndTransaction->id]);
                        Permission::firstOrCreate(['name' => 'access all payments', 'guard_name' => $guardInsider, 'parent_id' => $PaymentAndTransaction->id]);
                        Permission::firstOrCreate(['name' => 'access all invoices', 'guard_name' => $guardInsider, 'parent_id' => $PaymentAndTransaction->id]);
                        Permission::firstOrCreate(['name' => 'access all refunds', 'guard_name' => $guardInsider, 'parent_id' => $PaymentAndTransaction->id]);
                        // Permission::firstOrCreate(['name' => 'access all subscriptions', 'guard_name' => $guardInsider, 'parent_id' => $PaymentAndTransaction->id]);

        // Group SEO Management
        $seoGroup = Permission::firstOrCreate(['name' => 'access seo management', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'update seo settings', 'guard_name' => $guardInsider, 'parent_id' => $seoGroup->id]);
                        Permission::firstOrCreate(['name' => 'manage sitemap', 'guard_name' => $guardInsider, 'parent_id' => $seoGroup->id]);

        //group Site Management
        $siteManagementGroup = Permission::firstOrCreate(['name' => 'all site management', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'access site settings', 'guard_name' => $guardInsider, 'parent_id' => $siteManagementGroup->id]);
                        Permission::firstOrCreate(['name' => 'access API settings', 'guard_name' => $guardInsider, 'parent_id' => $siteManagementGroup->id]);
                        Permission::firstOrCreate(['name' => 'access url settings', 'guard_name' => $guardInsider, 'parent_id' => $siteManagementGroup->id]);
                        Permission::firstOrCreate(['name' => 'access notification settings', 'guard_name' => $guardInsider, 'parent_id' => $siteManagementGroup->id]);
                        Permission::firstOrCreate(['name' => 'access auth settings', 'guard_name' => $guardInsider, 'parent_id' => $siteManagementGroup->id]);
                        Permission::firstOrCreate(['name' => 'access payments settings', 'guard_name' => $guardInsider, 'parent_id' => $siteManagementGroup->id]);
                        Permission::firstOrCreate(['name' => 'access chat settings', 'guard_name' => $guardInsider, 'parent_id' => $siteManagementGroup->id]);
                        Permission::firstOrCreate(['name' => 'access storage settings', 'guard_name' => $guardInsider, 'parent_id' => $siteManagementGroup->id]);
                        Permission::firstOrCreate(['name' => 'access custom settings', 'guard_name' => $guardInsider, 'parent_id' => $siteManagementGroup->id]);
                        Permission::firstOrCreate(['name' => 'access site logs', 'guard_name' => $guardInsider, 'parent_id' => $siteManagementGroup->id]);

        // Group Developer
        $developerGroup = Permission::firstOrCreate(['name' => 'access all developer tools', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'access audit log', 'guard_name' => $guardInsider, 'parent_id' => $developerGroup->id]);
                        Permission::firstOrCreate(['name' => 'access maintenance mode', 'guard_name' => $guardInsider, 'parent_id' => $developerGroup->id]);
                        Permission::firstOrCreate(['name' => 'run system backup', 'guard_name' => $guardInsider, 'parent_id' => $developerGroup->id]);
                        Permission::firstOrCreate(['name' => 'clear application cache', 'guard_name' => $guardInsider, 'parent_id' => $developerGroup->id]);
                        Permission::firstOrCreate(['name' => 'access system health check', 'guard_name' => $guardInsider, 'parent_id' => $developerGroup->id]);

        $docManagement = Permission::firstOrCreate(['name' => 'access all documentation management', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'can create documentation', 'guard_name' => $guardInsider, 'parent_id' => $docManagement->id]);
                        Permission::firstOrCreate(['name' => 'can update documentation', 'guard_name' => $guardInsider, 'parent_id' => $docManagement->id]);
                        Permission::firstOrCreate(['name' => 'can delete documentation', 'guard_name' => $guardInsider, 'parent_id' => $docManagement->id]);
                        Permission::firstOrCreate(['name' => 'view all documentation', 'guard_name' => $guardInsider, 'parent_id' => $docManagement->id]);

        //Group general access for insider
        $selfProfileGroup = Permission::firstOrCreate(['name' => 'access self profile', 'guard_name' => $guardInsider]);
                        Permission::firstOrCreate(['name' => 'update self profile', 'guard_name' => $guardInsider, 'parent_id' => $selfProfileGroup->id]);
                        Permission::firstOrCreate(['name' => 'access self attendance', 'guard_name' => $guardInsider, 'parent_id' => $selfProfileGroup->id]);
                        Permission::firstOrCreate(['name' => 'access self wage', 'guard_name' => $guardInsider, 'parent_id' => $selfProfileGroup->id]);
                        Permission::firstOrCreate(['name' => 'access self division', 'guard_name' => $guardInsider, 'parent_id' => $selfProfileGroup->id]);
                        Permission::firstOrCreate(['name' => 'access self leave', 'guard_name' => $guardInsider, 'parent_id' => $selfProfileGroup->id]);
                        Permission::firstOrCreate(['name' => 'access self position', 'guard_name' => $guardInsider, 'parent_id' => $selfProfileGroup->id]);
                        Permission::firstOrCreate(['name' => 'access self project', 'guard_name' => $guardInsider, 'parent_id' => $selfProfileGroup->id]);


        // FOR VENDOR PERMISSIONS
        // Vendor Owner Permissions
        Permission::firstOrCreate(['name' => 'vendor change subscription', 'guard_name' => $guardVendor]);
        Permission::firstOrCreate(['name' => 'vendor view subscription billing', 'guard_name' => $guardVendor]);

        Permission::firstOrCreate(['name' => 'access super-vendor dashboard', 'guard_name' => $guardVendor]);
        Permission::firstOrCreate(['name' => 'access vendor dashboard', 'guard_name' => $guardVendor]);
        Permission::firstOrCreate(['name' => 'access cashier dashboard', 'guard_name' => $guardVendor]);

        // Vendor Product Management
        $venProductManagement = Permission::firstOrCreate(['name' => 'vendor product management', 'guard_name' => $guardVendor]);
                        Permission::firstOrCreate(['name' => 'vendor view products', 'guard_name' => $guardVendor, 'parent_id' => $venProductManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor create product', 'guard_name' => $guardVendor, 'parent_id' => $venProductManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor update product', 'guard_name' => $guardVendor, 'parent_id' => $venProductManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor delete product', 'guard_name' => $guardVendor, 'parent_id' => $venProductManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor manage product categories', 'guard_name' => $guardVendor, 'parent_id' => $venProductManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor manage product attributes', 'guard_name' => $guardVendor, 'parent_id' => $venProductManagement->id]);

        // Vendor Order Management
        $venOrderManagement = Permission::firstOrCreate(['name' => 'vendor order management', 'guard_name' => $guardVendor]);
                        Permission::firstOrCreate(['name' => 'vendor view orders', 'guard_name' => $guardVendor, 'parent_id' => $venOrderManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor update order status', 'guard_name' => $guardVendor, 'parent_id' => $venOrderManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor process refunds', 'guard_name' => $guardVendor, 'parent_id' => $venOrderManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor view shipping labels', 'guard_name' => $guardVendor, 'parent_id' => $venOrderManagement->id]);

        // Vendor Finance & Payouts
        $venFinanceManagement = Permission::firstOrCreate(['name' => 'vendor finance management', 'guard_name' => $guardVendor]);
                        Permission::firstOrCreate(['name' => 'vendor view earnings', 'guard_name' => $guardVendor, 'parent_id' => $venFinanceManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor request payout', 'guard_name' => $guardVendor, 'parent_id' => $venFinanceManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor view transaction history', 'guard_name' => $guardVendor, 'parent_id' => $venFinanceManagement->id]);

        // Vendor Marketing & Promotions
        $venMarketingManagement = Permission::firstOrCreate(['name' => 'vendor marketing management', 'guard_name' => $guardVendor]);
                        Permission::firstOrCreate(['name' => 'vendor create promo codes', 'guard_name' => $guardVendor, 'parent_id' => $venMarketingManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor manage ads', 'guard_name' => $guardVendor, 'parent_id' => $venMarketingManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor view marketing reports', 'guard_name' => $guardVendor, 'parent_id' => $venMarketingManagement->id]);

        // Vendor Reviews & Support
        $venSupportManagement = Permission::firstOrCreate(['name' => 'vendor support management', 'guard_name' => $guardVendor]);
                        Permission::firstOrCreate(['name' => 'vendor view reviews', 'guard_name' => $guardVendor, 'parent_id' => $venSupportManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor reply to reviews', 'guard_name' => $guardVendor, 'parent_id' => $venSupportManagement->id]);
                        Permission::firstOrCreate(['name' => 'vendor access support tickets', 'guard_name' => $guardVendor, 'parent_id' => $venSupportManagement->id]);

        // Vendor Team & Settings
        $venTeamSettings = Permission::firstOrCreate(['name' => 'vendor team and settings', 'guard_name' => $guardVendor]);
                        Permission::firstOrCreate(['name' => 'vendor manage team members', 'guard_name' => $guardVendor, 'parent_id' => $venTeamSettings->id]);
                        Permission::firstOrCreate(['name' => 'vendor manage roles and permissions', 'guard_name' => $guardVendor, 'parent_id' => $venTeamSettings->id]);
                        Permission::firstOrCreate(['name' => 'vendor update store profile', 'guard_name' => $guardVendor, 'parent_id' => $venTeamSettings->id]);
                        Permission::firstOrCreate(['name' => 'vendor manage store settings', 'guard_name' => $guardVendor, 'parent_id' => $venTeamSettings->id]);

        // FOR CLIENT PERMISSIONS
        // Client (Client) Permissions
        $clientDashboard = Permission::firstOrCreate(['name' => 'access client dashboard', 'guard_name' => $guardClient]);
        $clientOrder = Permission::firstOrCreate(['name' => 'client order management', 'guard_name' => $guardClient]);
                        Permission::firstOrCreate(['name' => 'client view orders', 'guard_name' => $guardClient, 'parent_id' => $clientOrder->id]);
                        Permission::firstOrCreate(['name' => 'client track orders', 'guard_name' => $guardClient, 'parent_id' => $clientOrder->id]);
                        Permission::firstOrCreate(['name' => 'client request refund', 'guard_name' => $guardClient, 'parent_id' => $clientOrder->id]);
                        Permission::firstOrCreate(['name' => 'client cancel order', 'guard_name' => $guardClient, 'parent_id' => $clientOrder->id]);

        $clientProfile = Permission::firstOrCreate(['name' => 'client profile management', 'guard_name' => $guardClient]);
                        Permission::firstOrCreate(['name' => 'client update profile', 'guard_name' => $guardClient, 'parent_id' => $clientProfile->id]);
                        Permission::firstOrCreate(['name' => 'client manage addresses', 'guard_name' => $guardClient, 'parent_id' => $clientProfile->id]);
                        Permission::firstOrCreate(['name' => 'client manage payment methods', 'guard_name' => $guardClient, 'parent_id' => $clientProfile->id]);
                        Permission::firstOrCreate(['name' => 'client view wishlists', 'guard_name' => $guardClient, 'parent_id' => $clientProfile->id]);

        $clientReview = Permission::firstOrCreate(['name' => 'client review management', 'guard_name' => $guardClient]);
                        Permission::firstOrCreate(['name' => 'client create review', 'guard_name' => $guardClient, 'parent_id' => $clientReview->id]);
                        Permission::firstOrCreate(['name' => 'client edit review', 'guard_name' => $guardClient, 'parent_id' => $clientReview->id]);
                        Permission::firstOrCreate(['name' => 'client delete review', 'guard_name' => $guardClient, 'parent_id' => $clientReview->id]);

        $clientSupport = Permission::firstOrCreate(['name' => 'client support access', 'guard_name' => $guardClient]);
                        Permission::firstOrCreate(['name' => 'client create support ticket', 'guard_name' => $guardClient, 'parent_id' => $clientSupport->id]);
                        Permission::firstOrCreate(['name' => 'client view support tickets', 'guard_name' => $guardClient, 'parent_id' => $clientSupport->id]);

        $clientSubscription = Permission::firstOrCreate(['name' => 'client subscription management', 'guard_name' => $guardClient]);
                        Permission::firstOrCreate(['name' => 'client view subscriptions', 'guard_name' => $guardClient, 'parent_id' => $clientSubscription->id]);
                        Permission::firstOrCreate(['name' => 'client manage subscriptions', 'guard_name' => $guardClient, 'parent_id' => $clientSubscription->id]);


        // 4. Buat Roles dan berikan permissions

        // === ROLE UNTUK INSIDER ===
        // Role Super Admin (memiliki semua izin insider)
        $superAdminRole = Role::create(['name' => 'Super Admin', 'guard_name' => $guardInsider]);
        $superAdminRole->givePermissionTo([
            'access super admin dashboard',
            'access admin dashboard',
            'access accounting dashboard',
            'access developer dashboard',
            'access human resources dashboard',
            'access sales dashboard',
            'access vendors admin dashboard',
            'access customer service dashboard',
            'access marketing dashboard',
            'access global search',
            'access insiders search',
            'access vendors search',
            'access clients search',
            'access products search',
            'access orders search',
            'access blog posts search',
            'access tickets search',
            'access promos search',
            'access self email',
            'access all emails',
            'access self chat',
            'access tickets',
            'insider and team dashboard',
            'impersonate insider',
            'create new insider',
            'update status insider',
            'access all insider wages',
            'create insider wages',
            'update insider wages',
            'access all insider attendances',
            'create insider attendance',
            'update insider attendance',
            'access all insider divisions',
            'create insider division',
            'update insider division',
            'access all insider leaves',
            'create insider leaves',
            'update insider leaves',
            'access all insider profiles',
            'create insider profiles',
            'update insider profiles',
            'access all insider positions',
            'create insider position',
            'update insider position',
            'access all insider projects',
            'create insider project',
            'update insider project',
            'vendors and pos dashboard',
            'impersonate vendor',
            'notify all vendors',
            'create new vendor',
            'create new vendor stores',
            'update vendor details',
            'update vendor status',
            'update vendor subscription',
            'access all vendors',
            'access all vendors teams',
            'access all vendors transactions',
            'access all vendors stores',
            'access all vendors products',
            'access all vendors orders',
            'access all vendors promos',
            'access all vendors reports',
            'view vendors',
            'access all client',
            'impersonate client',
            'notify all client',
            'create new client',
            'edit client profile',
            'update status client',
            'access all client reports',
            'update client reports',
            'access all client orders',
            'update client orders',
            'access all page management',
            'view all page',
            'can create page',
            'can update page',
            'can delete page',
            'view page',
            'access all blog management',
            'view all blog',
            'can create blog post',
            'can update blog post',
            'can delete blog post',
            'access all categories',
            'can create categories',
            'can update categories',
            'can delete categories',
            'access all tags',
            'can create tags',
            'can update tags',
            'can delete tags',
            'view blog',
            'access all marketing management',
            'can create marketing campaign',
            'can update marketing campaign',
            'can delete marketing campaign',
            'view all marketing campaign',
            'can create subscription',
            'can update subscription',
            'can delete subscription',
            'view all subscription',
            'can create badge',
            'can update badge',
            'can delete badge',
            'view all badge',
            'access all roles and Permission',
            'access all insider roles',
            'can update insider roles',
            'can create insider roles',
            'access all insider permission',
            'can update insider permission',
            'access all vendor roles',
            'can update vendor roles',
            'access all vendor permission',
            'can update vendor permission',
            'access all client roles',
            'can update client roles',
            'access all client permission',
            'can update client permission',
            'access notification management',
            'send broadcast notification',
            'manage notification templates',
            'access general settings',
            'update general settings',
            'access localization settings',
            'update localization settings',
            'access all payment and transaction',
            'payment and transactions dashboard',
            'access all transactions',
            'access all payments',
            'access all invoices',
            'access all refunds',
            'access seo management',
            'update seo settings',
            'manage sitemap',
            'all site management',
            'access site settings',
            'access API settings',
            'access url settings',
            'access notification settings',
            'access auth settings',
            'access payments settings',
            'access chat settings',
            'access storage settings',
            'access custom settings',
            'access site logs',
            'access all developer tools',
            'access audit log',
            'access maintenance mode',
            'run system backup',
            'clear application cache',
            'access system health check',
            'access all documentation management',
            'can create documentation',
            'can update documentation',
            'can delete documentation',
            'view all documentation',
            'access self profile',
            'update self profile',
            'access self attendance',
            'access self wage',
            'access self division',
            'access self leave',
            'access self position',
            'access self project',
        ]);

        // Role Staff (hanya bisa melihat dashboard)
        $staffRole = Role::create(['name' => 'Staff', 'guard_name' => $guardInsider]);
        $staffRole->givePermissionTo('access admin dashboard');


        // === ROLE UNTUK VENDOR ===
        $vendorRole = Role::firstOrCreate(['name' => 'Vendor Owner', 'guard_name' => $guardVendor]);
        $vendorRole->syncPermissions([
            'vendor change subscription',
            'vendor view subscription billing',
            'access super-vendor dashboard',
            'access vendor dashboard',
            'access cashier dashboard',
            'vendor product management',
            'vendor view products',
            'vendor create product',
            'vendor update product',
            'vendor delete product',
            'vendor manage product categories',
            'vendor manage product attributes',
            'vendor order management',
            'vendor view orders',
            'vendor update order status',
            'vendor process refunds',
            'vendor view shipping labels',
            'vendor finance management',
            'vendor view earnings',
            'vendor request payout',
            'vendor view transaction history',
            'vendor marketing management',
            'vendor create promo codes',
            'vendor manage ads',
            'vendor view marketing reports',
            'vendor support management',
            'vendor view reviews',
            'vendor reply to reviews',
            'vendor access support tickets',
            'vendor team and settings',
            'vendor manage team members',
            'vendor manage roles and permissions',
            'vendor update store profile',
            'vendor manage store settings',
        ]);

        // === ROLE UNTUK CLIENT ===
        $clientRole = Role::firstOrCreate(['name' => 'Customer', 'guard_name' => $guardClient]);
        $clientRole->syncPermissions([
            'access client dashboard',
            'client order management',
            'client view orders',
            'client track orders',
            'client request refund',
            'client cancel order',
            'client profile management',
            'client update profile',
            'client manage addresses',
            'client manage payment methods',
            'client view wishlists',
            'client review management',
            'client create review',
            'client edit review',
            'client delete review',
            'client support access',
            'client create support ticket',
            'client view support tickets',
            'client subscription management',
            'client view subscriptions',
            'client manage subscriptions',
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
