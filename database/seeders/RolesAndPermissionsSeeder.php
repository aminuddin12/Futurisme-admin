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

        // Vendor Point of Sales Permissions for team members
        $mainVenPosPermission = Permission::firstOrCreate(['name' => 'vendor pos main', 'guard_name' => $guardVendor]);
                        // Products
                        Permission::firstOrCreate(['name' => 'v-team view products', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        Permission::firstOrCreate(['name' => 'v-team can create product', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        Permission::firstOrCreate(['name' => 'v-team can update product', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        Permission::firstOrCreate(['name' => 'v-team view stocks', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        Permission::firstOrCreate(['name' => 'v-team can create stock', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        Permission::firstOrCreate(['name' => 'v-team can update stock', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        Permission::firstOrCreate(['name' => 'v-team can delete stock', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        // Orders
                        Permission::firstOrCreate(['name' => 'v-team view orders', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        Permission::firstOrCreate(['name' => 'v-team can create orders', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        Permission::firstOrCreate(['name' => 'v-team can update orders', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        // Reviews
                        Permission::firstOrCreate(['name' => 'v-team view reviews', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        Permission::firstOrCreate(['name' => 'v-team can reply review', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        // Transactions
                        Permission::firstOrCreate(['name' => 'v-team view transactions', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        Permission::firstOrCreate(['name' => 'v-team view customers', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
                        Permission::firstOrCreate(['name' => 'v-team pos settings', 'guard_name' => $guardVendor, 'parent_id' => $mainVenPosPermission->id]);
        // Vendor Store Management Permissions

        // Vendor Management Permissions
        Permission::firstOrCreate(['name' => 'manage vendor store', 'guard_name' => $guardVendor]);


        // FOR CLIENT PERMISSIONS
        // Client (Client) Permissions
        Permission::firstOrCreate(['name' => 'access client dashboard', 'guard_name' => $guardClient]);
        Permission::firstOrCreate(['name' => 'access client orders', 'guard_name' => $guardClient]);
        Permission::firstOrCreate(['name' => 'access client profile', 'guard_name' => $guardClient]);



        // 4. Buat Roles dan berikan permissions

        // === ROLE UNTUK INSIDER ===
        // Role Super Admin (memiliki semua izin insider)
        $superAdminRole = Role::create(['name' => 'Super Admin', 'guard_name' => $guardInsider]);
        $superAdminRole->givePermissionTo([
            'access super admin dashboard'
        ]);

        // Role Staff (hanya bisa melihat dashboard)
        $staffRole = Role::create(['name' => 'Staff', 'guard_name' => $guardInsider]);
        $staffRole->givePermissionTo('access admin dashboard');


        // === ROLE UNTUK VENDOR ===
        $vendorRole = Role::firstOrCreate(['name' => 'Vendor', 'guard_name' => $guardVendor]);
        $vendorRole->syncPermissions([
            'access vendor dashboard',
            'vendor product management',
            'vendor order management',
            'vendor finance management',
            'vendor marketing management',
            'vendor support management',
            'vendor team and settings',
            'vendor change subscription',
            'vendor view subscription billing',
        ]);

        // === ROLE UNTUK CLIENT ===
        $clientRole = Role::firstOrCreate(['name' => 'Customer', 'guard_name' => $guardClient]);
        $clientRole->syncPermissions([
            'access client dashboard',
            'client order management',
            'client profile management',
            'client review management',
            'client support access',
            'client subscription management',
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
