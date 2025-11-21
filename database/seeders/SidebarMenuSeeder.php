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

        // 1. Grup Dashboard
        $groupDashboard = SidebarMenu::create([
            'key' => 'group-insider-dash',
            'label' => 'Dashboard',
            'title' => 'Dashboard',
            'icon' => 'tabler:dashboard',
            'icon_filled' => 'tabler:dashboard-filled',
            'href' => '/insider/dashboard',
            'route_name' => 'insider.dashboard',
            'guard_name' => 'insider',
            'permissions' => ['access super admin dashboard'],
            'order' => 10,
        ]);
            // Sub-menu Dashboard (sesuai dengan child permissions)
            SidebarMenu::create(['parent_id' => $groupDashboard->id, 'key' => 'sub-admin-dash', 'label' => 'Admin Dashboard', 'href' => '/insider/admin-dashboard', 'route_name' => 'insider.admin.dashboard', 'guard_name' => 'insider', 'permissions' => ['access admin dashboard'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupDashboard->id, 'key' => 'sub-accounting-dash', 'label' => 'Accounting Dashboard', 'href' => '/insider/accounting-dashboard', 'route_name' => 'insider.accounting.dashboard', 'guard_name' => 'insider', 'permissions' => ['access accounting dashboard'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupDashboard->id, 'key' => 'sub-developer-dash', 'label' => 'Developer Dashboard', 'href' => '/insider/developer-dashboard', 'route_name' => 'insider.developer.dashboard', 'guard_name' => 'insider', 'permissions' => ['access developer dashboard'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $groupDashboard->id, 'key' => 'sub-hr-dash', 'label' => 'Human Resources Dashboard', 'href' => '/insider/hr-dashboard', 'route_name' => 'insider.hr.dashboard', 'guard_name' => 'insider', 'permissions' => ['access human resources dashboard'], 'order' => 4]);
            SidebarMenu::create(['parent_id' => $groupDashboard->id, 'key' => 'sub-sales-dash', 'label' => 'Sales Dashboard', 'href' => '/insider/sales-dashboard', 'route_name' => 'insider.sales.dashboard', 'guard_name' => 'insider', 'permissions' => ['access sales dashboard'], 'order' => 5]);
            SidebarMenu::create(['parent_id' => $groupDashboard->id, 'key' => 'sub-vendors-dash', 'label' => 'Vendors Admin Dashboard', 'href' => '/insider/vendors-admin-dashboard', 'route_name' => 'insider.vendors.admin.dashboard', 'guard_name' => 'insider', 'permissions' => ['access vendors admin dashboard'], 'order' => 6]);
            SidebarMenu::create(['parent_id' => $groupDashboard->id, 'key' => 'sub-cs-dash', 'label' => 'Customer Service Dashboard', 'href' => '/insider/cs-dashboard', 'route_name' => 'insider.cs.dashboard', 'guard_name' => 'insider', 'permissions' => ['access customer service dashboard'], 'order' => 7]);
            SidebarMenu::create(['parent_id' => $groupDashboard->id, 'key' => 'sub-marketing-dash', 'label' => 'Marketing Dashboard', 'href' => '/insider/marketing-dashboard', 'route_name' => 'insider.marketing.dashboard', 'guard_name' => 'insider', 'permissions' => ['access marketing dashboard'], 'order' => 8]);


        // 2. Grup Search Management
        $groupSearch = SidebarMenu::create([
            'key' => 'group-search',
            'label' => 'Search Management',
            'title' => 'Search Management',
            'icon' => 'tabler:search',
            'icon_filled' => 'tabler:search',
            'href' => '/insider/search',
            'route_name' => 'insider.search',
            'guard_name' => 'insider',
            'permissions' => ['access global search'],
            'order' => 20,
        ]);
            // Sub-menu Search (sesuai dengan child permissions)
            SidebarMenu::create(['parent_id' => $groupSearch->id, 'key' => 'sub-insiders-search', 'label' => 'Insiders Search', 'href' => '/insider/search/insiders', 'route_name' => 'insider.search.insiders', 'guard_name' => 'insider', 'permissions' => ['access insiders search'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupSearch->id, 'key' => 'sub-vendors-search', 'label' => 'Vendors Search', 'href' => '/insider/search/vendors', 'route_name' => 'insider.search.vendors', 'guard_name' => 'insider', 'permissions' => ['access vendors search'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupSearch->id, 'key' => 'sub-clients-search', 'label' => 'Clients Search', 'href' => '/insider/search/clients', 'route_name' => 'insider.search.clients', 'guard_name' => 'insider', 'permissions' => ['access clients search'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $groupSearch->id, 'key' => 'sub-products-search', 'label' => 'Products Search', 'href' => '/insider/search/products', 'route_name' => 'insider.search.products', 'guard_name' => 'insider', 'permissions' => ['access products search'], 'order' => 4]);
            SidebarMenu::create(['parent_id' => $groupSearch->id, 'key' => 'sub-orders-search', 'label' => 'Orders Search', 'href' => '/insider/search/orders', 'route_name' => 'insider.search.orders', 'guard_name' => 'insider', 'permissions' => ['access orders search'], 'order' => 5]);
            SidebarMenu::create(['parent_id' => $groupSearch->id, 'key' => 'sub-blog-search', 'label' => 'Blog Posts Search', 'href' => '/insider/search/blog', 'route_name' => 'insider.search.blog', 'guard_name' => 'insider', 'permissions' => ['access blog posts search'], 'order' => 6]);
            SidebarMenu::create(['parent_id' => $groupSearch->id, 'key' => 'sub-tickets-search', 'label' => 'Tickets Search', 'href' => '/insider/search/tickets', 'route_name' => 'insider.search.tickets', 'guard_name' => 'insider', 'permissions' => ['access tickets search'], 'order' => 7]);
            SidebarMenu::create(['parent_id' => $groupSearch->id, 'key' => 'sub-promos-search', 'label' => 'Promos Search', 'href' => '/insider/search/promos', 'route_name' => 'insider.search.promos', 'guard_name' => 'insider', 'permissions' => ['access promos search'], 'order' => 8]);


        // 3. Grup Communication (Menu tunggal)
        $groupCommunication = SidebarMenu::create([
            'key' => 'group-communication',
            'label' => 'Communication',
            'title' => 'Communication',
            'icon' => 'tabler:messages',
            'icon_filled' => 'tabler:messages-filled',
            'guard_name' => 'insider',
            'order' => 30,
        ]);
            SidebarMenu::create(['parent_id' => $groupCommunication->id, 'key' => 'menu-self-email', 'label' => 'Self Email', 'href' => '/insider/email/self', 'route_name' => 'insider.email.self', 'guard_name' => 'insider', 'permissions' => ['access self email'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupCommunication->id, 'key' => 'menu-all-emails', 'label' => 'All Emails', 'href' => '/insider/email/all', 'route_name' => 'insider.email.all', 'guard_name' => 'insider', 'permissions' => ['access all emails'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupCommunication->id, 'key' => 'menu-self-chat', 'label' => 'Self Chat', 'href' => '/insider/chat/self', 'route_name' => 'insider.chat.self', 'guard_name' => 'insider', 'permissions' => ['access self chat'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $groupCommunication->id, 'key' => 'menu-tickets', 'label' => 'Tickets', 'href' => '/insider/tickets', 'route_name' => 'insider.tickets', 'guard_name' => 'insider', 'permissions' => ['access tickets'], 'order' => 4]);


        // 4. Grup Insider Management
        $groupInsider = SidebarMenu::create([
            'key' => 'group-insider-management',
            'label' => 'Insider Management',
            'title' => 'Insider & Team',
            'icon' => 'tabler:users-group',
            'icon_filled' => 'tabler:users-group-filled',
            'href' => '/insider/team',
            'route_name' => 'insider.team',
            'guard_name' => 'insider',
            'permissions' => ['insider and team dashboard'],
            'order' => 40,
        ]);
            // Sub-menu Insider (hanya menampilkan menu utama, sub-menu CRUD tidak ditampilkan di sidebar)
            SidebarMenu::create(['parent_id' => $groupInsider->id, 'key' => 'sub-insider-list', 'label' => 'All Insiders', 'href' => '/insider/team/list', 'route_name' => 'insider.team.list', 'guard_name' => 'insider', 'permissions' => ['create new insider'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupInsider->id, 'key' => 'sub-insider-wages', 'label' => 'Wages', 'href' => '/insider/team/wages', 'route_name' => 'insider.team.wages', 'guard_name' => 'insider', 'permissions' => ['access all insider wages'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupInsider->id, 'key' => 'sub-insider-attendance', 'label' => 'Attendance', 'href' => '/insider/team/attendance', 'route_name' => 'insider.team.attendance', 'guard_name' => 'insider', 'permissions' => ['access all insider attendances'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $groupInsider->id, 'key' => 'sub-insider-divisions', 'label' => 'Divisions', 'href' => '/insider/team/divisions', 'route_name' => 'insider.team.divisions', 'guard_name' => 'insider', 'permissions' => ['access all insider divisions'], 'order' => 4]);
            SidebarMenu::create(['parent_id' => $groupInsider->id, 'key' => 'sub-insider-leaves', 'label' => 'Leaves', 'href' => '/insider/team/leaves', 'route_name' => 'insider.team.leaves', 'guard_name' => 'insider', 'permissions' => ['access all insider leaves'], 'order' => 5]);
            SidebarMenu::create(['parent_id' => $groupInsider->id, 'key' => 'sub-insider-positions', 'label' => 'Positions', 'href' => '/insider/team/positions', 'route_name' => 'insider.team.positions', 'guard_name' => 'insider', 'permissions' => ['access all insider positions'], 'order' => 6]);
            SidebarMenu::create(['parent_id' => $groupInsider->id, 'key' => 'sub-insider-projects', 'label' => 'Projects', 'href' => '/insider/team/projects', 'route_name' => 'insider.team.projects', 'guard_name' => 'insider', 'permissions' => ['access all insider projects'], 'order' => 7]);


        // 5. Grup Vendors Management
        $groupVendors = SidebarMenu::create([
            'key' => 'group-vendors-management',
            'label' => 'Vendors Management',
            'title' => 'Vendors & POS',
            'icon' => 'tabler:building-store',
            'icon_filled' => 'tabler:building-store-filled',
            'href' => '/insider/vendors',
            'route_name' => 'insider.vendors',
            'guard_name' => 'insider',
            'permissions' => ['vendors and pos dashboard'],
            'order' => 50,
        ]);
            // Sub-menu Vendors
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-list', 'label' => 'All Vendors', 'href' => '/insider/vendors/list', 'route_name' => 'insider.vendors.list', 'guard_name' => 'insider', 'permissions' => ['access all vendors'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-teams', 'label' => 'Vendor Teams', 'href' => '/insider/vendors/teams', 'route_name' => 'insider.vendors.teams', 'guard_name' => 'insider', 'permissions' => ['access all vendors teams'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-transactions', 'label' => 'Transactions', 'href' => '/insider/vendors/transactions', 'route_name' => 'insider.vendors.transactions', 'guard_name' => 'insider', 'permissions' => ['access all vendors transactions'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-stores', 'label' => 'Stores', 'href' => '/insider/vendors/stores', 'route_name' => 'insider.vendors.stores', 'guard_name' => 'insider', 'permissions' => ['access all vendors stores'], 'order' => 4]);
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-products', 'label' => 'Products', 'href' => '/insider/vendors/products', 'route_name' => 'insider.vendors.products', 'guard_name' => 'insider', 'permissions' => ['access all vendors products'], 'order' => 5]);
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-orders', 'label' => 'Orders', 'href' => '/insider/vendors/orders', 'route_name' => 'insider.vendors.orders', 'guard_name' => 'insider', 'permissions' => ['access all vendors orders'], 'order' => 6]);
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-promos', 'label' => 'Promos', 'href' => '/insider/vendors/promos', 'route_name' => 'insider.vendors.promos', 'guard_name' => 'insider', 'permissions' => ['access all vendors promos'], 'order' => 7]);
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-reports', 'label' => 'Reports', 'href' => '/insider/vendors/reports', 'route_name' => 'insider.vendors.reports', 'guard_name' => 'insider', 'permissions' => ['access all vendors reports'], 'order' => 8]);


        // 6. Grup Client Management
        $groupClient = SidebarMenu::create([
            'key' => 'group-client-management',
            'label' => 'Client Management',
            'title' => 'Client Management',
            'icon' => 'tabler:users',
            'icon_filled' => 'tabler:users-filled',
            'href' => '/insider/clients',
            'route_name' => 'insider.clients',
            'guard_name' => 'insider',
            'permissions' => ['access all client'],
            'order' => 60,
        ]);
            // Sub-menu Client
            SidebarMenu::create(['parent_id' => $groupClient->id, 'key' => 'sub-client-reports', 'label' => 'Client Reports', 'href' => '/insider/clients/reports', 'route_name' => 'insider.clients.reports', 'guard_name' => 'insider', 'permissions' => ['access all client reports'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupClient->id, 'key' => 'sub-client-orders', 'label' => 'Client Orders', 'href' => '/insider/clients/orders', 'route_name' => 'insider.clients.orders', 'guard_name' => 'insider', 'permissions' => ['access all client orders'], 'order' => 2]);


        // 7. Grup Content Management (Pages & Blogs)
        $groupContent = SidebarMenu::create([
            'key' => 'group-content-management',
            'label' => 'Content Management',
            'title' => 'Content Management',
            'icon' => 'tabler:file-text',
            'icon_filled' => 'tabler:file-text-filled',
            'guard_name' => 'insider',
            'order' => 70,
        ]);
            // Sub-menu Pages
            $menuPages = SidebarMenu::create(['parent_id' => $groupContent->id, 'key' => 'menu-pages', 'label' => 'Pages', 'icon' => 'tabler:file-description', 'icon_filled' => 'tabler:file-description-filled', 'href' => '/insider/content/pages', 'route_name' => 'insider.content.pages', 'guard_name' => 'insider', 'permissions' => ['access all page management'], 'order' => 1]);
                SidebarMenu::create(['parent_id' => $menuPages->id, 'key' => 'sub-view-pages', 'label' => 'View All Pages', 'href' => '/insider/content/pages/list', 'route_name' => 'insider.content.pages.list', 'guard_name' => 'insider', 'permissions' => ['view all page'], 'order' => 1]);
            // Sub-menu Blogs
            $menuBlogs = SidebarMenu::create(['parent_id' => $groupContent->id, 'key' => 'menu-blogs', 'label' => 'Blogs', 'icon' => 'tabler:pencil', 'icon_filled' => 'tabler:pencil-filled', 'href' => '/insider/content/blogs', 'route_name' => 'insider.content.blogs', 'guard_name' => 'insider', 'permissions' => ['access all blog management'], 'order' => 2]);
                SidebarMenu::create(['parent_id' => $menuBlogs->id, 'key' => 'sub-view-blogs', 'label' => 'View All Blogs', 'href' => '/insider/content/blogs/list', 'route_name' => 'insider.content.blogs.list', 'guard_name' => 'insider', 'permissions' => ['view all blog'], 'order' => 1]);
                SidebarMenu::create(['parent_id' => $menuBlogs->id, 'key' => 'sub-blog-categories', 'label' => 'Categories', 'href' => '/insider/content/blogs/categories', 'route_name' => 'insider.content.blogs.categories', 'guard_name' => 'insider', 'permissions' => ['access all categories'], 'order' => 2]);
                SidebarMenu::create(['parent_id' => $menuBlogs->id, 'key' => 'sub-blog-tags', 'label' => 'Tags', 'href' => '/insider/content/blogs/tags', 'route_name' => 'insider.content.blogs.tags', 'guard_name' => 'insider', 'permissions' => ['access all tags'], 'order' => 3]);


        // 8. Grup Marketing Management
        $groupMarketing = SidebarMenu::create([
            'key' => 'group-marketing-management',
            'label' => 'Marketing Management',
            'title' => 'Marketing',
            'icon' => 'tabler:speakerphone',
            'icon_filled' => 'tabler:speakerphone-filled',
            'href' => '/insider/marketing',
            'route_name' => 'insider.marketing',
            'guard_name' => 'insider',
            'permissions' => ['access all marketing management'],
            'order' => 80,
        ]);
            // Sub-menu Marketing
            SidebarMenu::create(['parent_id' => $groupMarketing->id, 'key' => 'sub-marketing-campaign', 'label' => 'Campaigns', 'href' => '/insider/marketing/campaigns', 'route_name' => 'insider.marketing.campaigns', 'guard_name' => 'insider', 'permissions' => ['view all marketing campaign'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupMarketing->id, 'key' => 'sub-marketing-subscription', 'label' => 'Subscriptions', 'href' => '/insider/marketing/subscriptions', 'route_name' => 'insider.marketing.subscriptions', 'guard_name' => 'insider', 'permissions' => ['view all subscription'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupMarketing->id, 'key' => 'sub-marketing-badge', 'label' => 'Badges', 'href' => '/insider/marketing/badges', 'route_name' => 'insider.marketing.badges', 'guard_name' => 'insider', 'permissions' => ['view all badge'], 'order' => 3]);


        // 9. Grup Payment and Transaction
        $groupPayment = SidebarMenu::create([
            'key' => 'group-payment-transaction',
            'label' => 'Payment & Transaction',
            'title' => 'Payment & Transaction',
            'icon' => 'tabler:credit-card',
            'icon_filled' => 'tabler:credit-card-filled',
            'href' => '/insider/payments',
            'route_name' => 'insider.payments',
            'guard_name' => 'insider',
            'permissions' => ['access all payment and transaction'],
            'order' => 90,
        ]);
            // Sub-menu Payment
            SidebarMenu::create(['parent_id' => $groupPayment->id, 'key' => 'sub-payment-dashboard', 'label' => 'Dashboard', 'href' => '/insider/payments/dashboard', 'route_name' => 'insider.payments.dashboard', 'guard_name' => 'insider', 'permissions' => ['payment and transactions dashboard'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupPayment->id, 'key' => 'sub-all-transactions', 'label' => 'All Transactions', 'href' => '/insider/payments/transactions', 'route_name' => 'insider.payments.transactions', 'guard_name' => 'insider', 'permissions' => ['access all transactions'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupPayment->id, 'key' => 'sub-all-payments', 'label' => 'All Payments', 'href' => '/insider/payments/payments', 'route_name' => 'insider.payments.payments', 'guard_name' => 'insider', 'permissions' => ['access all payments'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $groupPayment->id, 'key' => 'sub-all-invoices', 'label' => 'All Invoices', 'href' => '/insider/payments/invoices', 'route_name' => 'insider.payments.invoices', 'guard_name' => 'insider', 'permissions' => ['access all invoices'], 'order' => 4]);
            SidebarMenu::create(['parent_id' => $groupPayment->id, 'key' => 'sub-all-refunds', 'label' => 'All Refunds', 'href' => '/insider/payments/refunds', 'route_name' => 'insider.payments.refunds', 'guard_name' => 'insider', 'permissions' => ['access all refunds'], 'order' => 5]);


        // 10. Grup Settings
        $groupSettings = SidebarMenu::create([
            'key' => 'group-settings',
            'label' => 'Settings',
            'title' => 'Settings',
            'icon' => 'tabler:settings',
            'icon_filled' => 'tabler:settings-filled',
            'guard_name' => 'insider',
            'order' => 100,
        ]);
            // Sub-menu Roles and Permission
            $menuRoles = SidebarMenu::create(['parent_id' => $groupSettings->id, 'key' => 'menu-roles-permission', 'label' => 'Roles & Permissions', 'icon' => 'tabler:lock-access', 'icon_filled' => 'tabler:lock-access', 'href' => '/insider/settings/roles', 'route_name' => 'insider.settings.roles', 'guard_name' => 'insider', 'permissions' => ['access all roles and Permission'], 'order' => 1]);
            // Sub-menu Notifications
            $menuNotifications = SidebarMenu::create(['parent_id' => $groupSettings->id, 'key' => 'menu-notifications', 'label' => 'Notifications', 'icon' => 'tabler:bell', 'icon_filled' => 'tabler:bell-filled', 'href' => '/insider/settings/notifications', 'route_name' => 'insider.settings.notifications', 'guard_name' => 'insider', 'permissions' => ['access notification management'], 'order' => 2]);
            // Sub-menu General Settings
            $menuGeneralSettings = SidebarMenu::create(['parent_id' => $groupSettings->id, 'key' => 'menu-general-settings', 'label' => 'General Settings', 'icon' => 'tabler:adjustments', 'icon_filled' => 'tabler:adjustments-filled', 'href' => '/insider/settings/general', 'route_name' => 'insider.settings.general', 'guard_name' => 'insider', 'permissions' => ['access general settings'], 'order' => 3]);
            // Sub-menu SEO Management
            $menuSeo = SidebarMenu::create(['parent_id' => $groupSettings->id, 'key' => 'menu-seo', 'label' => 'SEO Management', 'icon' => 'tabler:world-search', 'icon_filled' => 'tabler:world-search', 'href' => '/insider/settings/seo', 'route_name' => 'insider.settings.seo', 'guard_name' => 'insider', 'permissions' => ['access seo management'], 'order' => 4]);
            // Sub-menu Site Management
            $menuSite = SidebarMenu::create(['parent_id' => $groupSettings->id, 'key' => 'menu-site-management', 'label' => 'Site Management', 'icon' => 'tabler:building-community', 'icon_filled' => 'tabler:building-community', 'href' => '/insider/settings/site', 'route_name' => 'insider.settings.site', 'guard_name' => 'insider', 'permissions' => ['all site management'], 'order' => 5]);


        // 11. Grup Developer Tools
        $groupDeveloper = SidebarMenu::create([
            'key' => 'group-developer-tools',
            'label' => 'Developer Tools',
            'title' => 'Developer Tools',
            'icon' => 'tabler:code',
            'icon_filled' => 'tabler:code-dots',
            'href' => '/insider/developer',
            'route_name' => 'insider.developer',
            'guard_name' => 'insider',
            'permissions' => ['access all developer tools'],
            'order' => 110,
        ]);
            // Sub-menu Developer
            SidebarMenu::create(['parent_id' => $groupDeveloper->id, 'key' => 'sub-audit-log', 'label' => 'Audit Log', 'href' => '/insider/developer/audit', 'route_name' => 'insider.developer.audit', 'guard_name' => 'insider', 'permissions' => ['access audit log'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupDeveloper->id, 'key' => 'sub-maintenance', 'label' => 'Maintenance Mode', 'href' => '/insider/developer/maintenance', 'route_name' => 'insider.developer.maintenance', 'guard_name' => 'insider', 'permissions' => ['access maintenance mode'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupDeveloper->id, 'key' => 'sub-backup', 'label' => 'System Backup', 'href' => '/insider/developer/backup', 'route_name' => 'insider.developer.backup', 'guard_name' => 'insider', 'permissions' => ['run system backup'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $groupDeveloper->id, 'key' => 'sub-cache', 'label' => 'Clear Cache', 'href' => '/insider/developer/cache', 'route_name' => 'insider.developer.cache', 'guard_name' => 'insider', 'permissions' => ['clear application cache'], 'order' => 4]);
            SidebarMenu::create(['parent_id' => $groupDeveloper->id, 'key' => 'sub-health', 'label' => 'System Health Check', 'href' => '/insider/developer/health', 'route_name' => 'insider.developer.health', 'guard_name' => 'insider', 'permissions' => ['access system health check'], 'order' => 5]);


        // 12. Grup Documentation Management
        $groupDocumentation = SidebarMenu::create([
            'key' => 'group-documentation',
            'label' => 'Documentation',
            'title' => 'Documentation Management',
            'icon' => 'tabler:book',
            'icon_filled' => 'tabler:book-filled',
            'href' => '/insider/documentation',
            'route_name' => 'insider.documentation',
            'guard_name' => 'insider',
            'permissions' => ['access all documentation management'],
            'order' => 120,
        ]);
            // Sub-menu Documentation
            SidebarMenu::create(['parent_id' => $groupDocumentation->id, 'key' => 'sub-view-docs', 'label' => 'View All Documentation', 'href' => '/insider/documentation/list', 'route_name' => 'insider.documentation.list', 'guard_name' => 'insider', 'permissions' => ['view all documentation'], 'order' => 1]);


        // 13. Grup Self Profile (Menu tunggal)
        $groupSelfProfile = SidebarMenu::create([
            'key' => 'group-self-profile',
            'label' => 'My Profile',
            'title' => 'My Profile',
            'icon' => 'tabler:user-circle',
            'icon_filled' => 'tabler:user-circle-filled',
            'href' => '/insider/profile',
            'route_name' => 'insider.profile',
            'guard_name' => 'insider',
            'permissions' => ['access self profile'],
            'order' => 130,
        ]);
            // Sub-menu Self Profile
            SidebarMenu::create(['parent_id' => $groupSelfProfile->id, 'key' => 'sub-self-attendance', 'label' => 'My Attendance', 'href' => '/insider/profile/attendance', 'route_name' => 'insider.profile.attendance', 'guard_name' => 'insider', 'permissions' => ['access self attendance'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupSelfProfile->id, 'key' => 'sub-self-wage', 'label' => 'My Wage', 'href' => '/insider/profile/wage', 'route_name' => 'insider.profile.wage', 'guard_name' => 'insider', 'permissions' => ['access self wage'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupSelfProfile->id, 'key' => 'sub-self-leave', 'label' => 'My Leave', 'href' => '/insider/profile/leave', 'route_name' => 'insider.profile.leave', 'guard_name' => 'insider', 'permissions' => ['access self leave'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $groupSelfProfile->id, 'key' => 'sub-self-project', 'label' => 'My Project', 'href' => '/insider/profile/project', 'route_name' => 'insider.profile.project', 'guard_name' => 'insider', 'permissions' => ['access self project'], 'order' => 4]);


        // ----------------------------------------
        // --- VENDOR MENU (GUARD: 'vendor') ---
        // ----------------------------------------

        // 1. Grup Dashboard
        $vendorDashboard = SidebarMenu::create([
            'key' => 'group-vendor-dash',
            'label' => 'Dashboard',
            'title' => 'Vendor Dashboard',
            'icon' => 'tabler:dashboard',
            'icon_filled' => 'tabler:dashboard-filled',
            'href' => '/vendor/dashboard',
            'route_name' => 'vendor.dashboard',
            'guard_name' => 'vendor',
            'permissions' => ['access super-vendor dashboard'],
            'order' => 10,
        ]);
            // Sub-menu Dashboard
            SidebarMenu::create(['parent_id' => $vendorDashboard->id, 'key' => 'sub-vendor-dash', 'label' => 'Vendor Dashboard', 'href' => '/vendor/vendor-dashboard', 'route_name' => 'vendor.vendor.dashboard', 'guard_name' => 'vendor', 'permissions' => ['access vendor dashboard'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $vendorDashboard->id, 'key' => 'sub-cashier-dash', 'label' => 'Cashier Dashboard', 'href' => '/vendor/cashier-dashboard', 'route_name' => 'vendor.cashier.dashboard', 'guard_name' => 'vendor', 'permissions' => ['access cashier dashboard'], 'order' => 2]);


        // 2. Grup Product Management
        $vendorProduct = SidebarMenu::create([
            'key' => 'group-vendor-product',
            'label' => 'Product Management',
            'title' => 'Product Management',
            'icon' => 'tabler:package',
            'icon_filled' => 'tabler:package-filled',
            'href' => '/vendor/products',
            'route_name' => 'vendor.products',
            'guard_name' => 'vendor',
            'permissions' => ['vendor product management'],
            'order' => 20,
        ]);
            // Sub-menu Product
            SidebarMenu::create(['parent_id' => $vendorProduct->id, 'key' => 'sub-vendor-view-products', 'label' => 'View Products', 'href' => '/vendor/products/list', 'route_name' => 'vendor.products.list', 'guard_name' => 'vendor', 'permissions' => ['vendor view products'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $vendorProduct->id, 'key' => 'sub-vendor-manage-categories', 'label' => 'Categories', 'href' => '/vendor/products/categories', 'route_name' => 'vendor.products.categories', 'guard_name' => 'vendor', 'permissions' => ['vendor manage product categories'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $vendorProduct->id, 'key' => 'sub-vendor-manage-attributes', 'label' => 'Attributes', 'href' => '/vendor/products/attributes', 'route_name' => 'vendor.products.attributes', 'guard_name' => 'vendor', 'permissions' => ['vendor manage product attributes'], 'order' => 3]);


        // 3. Grup Order Management
        $vendorOrder = SidebarMenu::create([
            'key' => 'group-vendor-order',
            'label' => 'Order Management',
            'title' => 'Order Management',
            'icon' => 'tabler:shopping-cart',
            'icon_filled' => 'tabler:shopping-cart-filled',
            'href' => '/vendor/orders',
            'route_name' => 'vendor.orders',
            'guard_name' => 'vendor',
            'permissions' => ['vendor order management'],
            'order' => 30,
        ]);
            // Sub-menu Order
            SidebarMenu::create(['parent_id' => $vendorOrder->id, 'key' => 'sub-vendor-view-orders', 'label' => 'View Orders', 'href' => '/vendor/orders/list', 'route_name' => 'vendor.orders.list', 'guard_name' => 'vendor', 'permissions' => ['vendor view orders'], 'order' => 1]);


        // 4. Grup Finance Management
        $vendorFinance = SidebarMenu::create([
            'key' => 'group-vendor-finance',
            'label' => 'Finance Management',
            'title' => 'Finance & Payouts',
            'icon' => 'tabler:wallet',
            'icon_filled' => 'tabler:wallet-filled',
            'href' => '/vendor/finance',
            'route_name' => 'vendor.finance',
            'guard_name' => 'vendor',
            'permissions' => ['vendor finance management'],
            'order' => 40,
        ]);
            // Sub-menu Finance
            SidebarMenu::create(['parent_id' => $vendorFinance->id, 'key' => 'sub-vendor-view-earnings', 'label' => 'View Earnings', 'href' => '/vendor/finance/earnings', 'route_name' => 'vendor.finance.earnings', 'guard_name' => 'vendor', 'permissions' => ['vendor view earnings'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $vendorFinance->id, 'key' => 'sub-vendor-transaction-history', 'label' => 'Transaction History', 'href' => '/vendor/finance/history', 'route_name' => 'vendor.finance.history', 'guard_name' => 'vendor', 'permissions' => ['vendor view transaction history'], 'order' => 2]);


        // 5. Grup Marketing Management
        $vendorMarketing = SidebarMenu::create([
            'key' => 'group-vendor-marketing',
            'label' => 'Marketing Management',
            'title' => 'Marketing & Promos',
            'icon' => 'tabler:discount-2',
            'icon_filled' => 'tabler:discount-2-filled',
            'href' => '/vendor/marketing',
            'route_name' => 'vendor.marketing',
            'guard_name' => 'vendor',
            'permissions' => ['vendor marketing management'],
            'order' => 50,
        ]);
            // Sub-menu Marketing
            SidebarMenu::create(['parent_id' => $vendorMarketing->id, 'key' => 'sub-vendor-promo-codes', 'label' => 'Promo Codes', 'href' => '/vendor/marketing/promos', 'route_name' => 'vendor.marketing.promos', 'guard_name' => 'vendor', 'permissions' => ['vendor create promo codes'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $vendorMarketing->id, 'key' => 'sub-vendor-manage-ads', 'label' => 'Manage Ads', 'href' => '/vendor/marketing/ads', 'route_name' => 'vendor.marketing.ads', 'guard_name' => 'vendor', 'permissions' => ['vendor manage ads'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $vendorMarketing->id, 'key' => 'sub-vendor-marketing-reports', 'label' => 'Marketing Reports', 'href' => '/vendor/marketing/reports', 'route_name' => 'vendor.marketing.reports', 'guard_name' => 'vendor', 'permissions' => ['vendor view marketing reports'], 'order' => 3]);


        // 6. Grup Support Management
        $vendorSupport = SidebarMenu::create([
            'key' => 'group-vendor-support',
            'label' => 'Support Management',
            'title' => 'Reviews & Support',
            'icon' => 'tabler:headset',
            'icon_filled' => 'tabler:headset-filled',
            'href' => '/vendor/support',
            'route_name' => 'vendor.support',
            'guard_name' => 'vendor',
            'permissions' => ['vendor support management'],
            'order' => 60,
        ]);
            // Sub-menu Support
            SidebarMenu::create(['parent_id' => $vendorSupport->id, 'key' => 'sub-vendor-view-reviews', 'label' => 'View Reviews', 'href' => '/vendor/support/reviews', 'route_name' => 'vendor.support.reviews', 'guard_name' => 'vendor', 'permissions' => ['vendor view reviews'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $vendorSupport->id, 'key' => 'sub-vendor-support-tickets', 'label' => 'Support Tickets', 'href' => '/vendor/support/tickets', 'route_name' => 'vendor.support.tickets', 'guard_name' => 'vendor', 'permissions' => ['vendor access support tickets'], 'order' => 2]);


        // 7. Grup Team and Settings
        $vendorSettings = SidebarMenu::create([
            'key' => 'group-vendor-settings',
            'label' => 'Team & Settings',
            'title' => 'Team & Settings',
            'icon' => 'tabler:adjustments-alt',
            'icon_filled' => 'tabler:adjustments-filled',
            'href' => '/vendor/settings',
            'route_name' => 'vendor.settings',
            'guard_name' => 'vendor',
            'permissions' => ['vendor team and settings'],
            'order' => 70,
        ]);
            // Sub-menu Settings
            SidebarMenu::create(['parent_id' => $vendorSettings->id, 'key' => 'sub-vendor-manage-team', 'label' => 'Manage Team', 'href' => '/vendor/settings/team', 'route_name' => 'vendor.settings.team', 'guard_name' => 'vendor', 'permissions' => ['vendor manage team members'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $vendorSettings->id, 'key' => 'sub-vendor-manage-roles', 'label' => 'Roles & Permissions', 'href' => '/vendor/settings/roles', 'route_name' => 'vendor.settings.roles', 'guard_name' => 'vendor', 'permissions' => ['vendor manage roles and permissions'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $vendorSettings->id, 'key' => 'sub-vendor-store-settings', 'label' => 'Store Settings', 'href' => '/vendor/settings/store', 'route_name' => 'vendor.settings.store', 'guard_name' => 'vendor', 'permissions' => ['vendor manage store settings'], 'order' => 3]);


        // ----------------------------------------
        // --- CLIENT MENU (GUARD: 'web') ---
        // ----------------------------------------

        // 1. Grup Dashboard
        $clientDashboard = SidebarMenu::create([
            'key' => 'group-client-dash',
            'label' => 'Dashboard',
            'title' => 'My Account',
            'icon' => 'tabler:user-circle',
            'icon_filled' => 'tabler:user-circle-filled',
            'href' => '/client/dashboard',
            'route_name' => 'client.dashboard',
            'guard_name' => 'web',
            'permissions' => ['access client dashboard'],
            'order' => 10,
        ]);


        // 2. Grup Order Management
        $clientOrder = SidebarMenu::create([
            'key' => 'group-client-order',
            'label' => 'Order Management',
            'title' => 'My Orders',
            'icon' => 'tabler:truck',
            'icon_filled' => 'tabler:truck-delivery',
            'href' => '/client/orders',
            'route_name' => 'client.orders',
            'guard_name' => 'web',
            'permissions' => ['client order management'],
            'order' => 20,
        ]);
            // Sub-menu Order
            SidebarMenu::create(['parent_id' => $clientOrder->id, 'key' => 'sub-client-view-orders', 'label' => 'View Orders', 'href' => '/client/orders/list', 'route_name' => 'client.orders.list', 'guard_name' => 'web', 'permissions' => ['client view orders'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $clientOrder->id, 'key' => 'sub-client-track-orders', 'label' => 'Track Orders', 'href' => '/client/orders/track', 'route_name' => 'client.orders.track', 'guard_name' => 'web', 'permissions' => ['client track orders'], 'order' => 2]);


        // 3. Grup Profile Management
        $clientProfile = SidebarMenu::create([
            'key' => 'group-client-profile',
            'label' => 'Profile Management',
            'title' => 'My Profile',
            'icon' => 'tabler:user',
            'icon_filled' => 'tabler:user-filled',
            'href' => '/client/profile',
            'route_name' => 'client.profile',
            'guard_name' => 'web',
            'permissions' => ['client profile management'],
            'order' => 30,
        ]);
            // Sub-menu Profile
            SidebarMenu::create(['parent_id' => $clientProfile->id, 'key' => 'sub-client-manage-addresses', 'label' => 'Manage Addresses', 'href' => '/client/profile/addresses', 'route_name' => 'client.profile.addresses', 'guard_name' => 'web', 'permissions' => ['client manage addresses'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $clientProfile->id, 'key' => 'sub-client-manage-payments', 'label' => 'Payment Methods', 'href' => '/client/profile/payments', 'route_name' => 'client.profile.payments', 'guard_name' => 'web', 'permissions' => ['client manage payment methods'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $clientProfile->id, 'key' => 'sub-client-view-wishlists', 'label' => 'Wishlists', 'href' => '/client/profile/wishlists', 'route_name' => 'client.profile.wishlists', 'guard_name' => 'web', 'permissions' => ['client view wishlists'], 'order' => 3]);


        // 4. Grup Review Management
        $clientReview = SidebarMenu::create([
            'key' => 'group-client-review',
            'label' => 'Review Management',
            'title' => 'My Reviews',
            'icon' => 'tabler:star',
            'icon_filled' => 'tabler:star-filled',
            'href' => '/client/reviews',
            'route_name' => 'client.reviews',
            'guard_name' => 'web',
            'permissions' => ['client review management'],
            'order' => 40,
        ]);
            // Sub-menu Review
            SidebarMenu::create(['parent_id' => $clientReview->id, 'key' => 'sub-client-create-review', 'label' => 'Create Review', 'href' => '/client/reviews/create', 'route_name' => 'client.reviews.create', 'guard_name' => 'web', 'permissions' => ['client create review'], 'order' => 1]);


        // 5. Grup Support Access
        $clientSupport = SidebarMenu::create([
            'key' => 'group-client-support',
            'label' => 'Support Access',
            'title' => 'Support',
            'icon' => 'tabler:lifebuoy',
            'icon_filled' => 'tabler:lifebuoy-filled',
            'href' => '/client/support',
            'route_name' => 'client.support',
            'guard_name' => 'web',
            'permissions' => ['client support access'],
            'order' => 50,
        ]);
            // Sub-menu Support
            SidebarMenu::create(['parent_id' => $clientSupport->id, 'key' => 'sub-client-create-ticket', 'label' => 'Create Ticket', 'href' => '/client/support/create', 'route_name' => 'client.support.create', 'guard_name' => 'web', 'permissions' => ['client create support ticket'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $clientSupport->id, 'key' => 'sub-client-view-tickets', 'label' => 'View Tickets', 'href' => '/client/support/tickets', 'route_name' => 'client.support.tickets', 'guard_name' => 'web', 'permissions' => ['client view support tickets'], 'order' => 2]);


        // 6. Grup Subscription Management
        $clientSubscription = SidebarMenu::create([
            'key' => 'group-client-subscription',
            'label' => 'Subscription Management',
            'title' => 'Subscriptions',
            'icon' => 'tabler:credit-card-pay',
            'icon_filled' => 'tabler:credit-card-pay-filled',
            'href' => '/client/subscriptions',
            'route_name' => 'client.subscriptions',
            'guard_name' => 'web',
            'permissions' => ['client subscription management'],
            'order' => 60,
        ]);
            // Sub-menu Subscription
            SidebarMenu::create(['parent_id' => $clientSubscription->id, 'key' => 'sub-client-view-subscriptions', 'label' => 'View Subscriptions', 'href' => '/client/subscriptions/list', 'route_name' => 'client.subscriptions.list', 'guard_name' => 'web', 'permissions' => ['client view subscriptions'], 'order' => 1]);
    }
}
