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

        // 1. Grup Dashboard (Menu tunggal dengan sub-menu)
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


        // 2. Grup Search Management (Menu tunggal)
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
            // Sub-menu Insider
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
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-stores', 'label' => 'Stores', 'href' => '/insider/vendors/stores', 'route_name' => 'insider.vendors.stores', 'guard_name' => 'insider', 'permissions' => ['access all vendors stores'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-products', 'label' => 'Products', 'href' => '/insider/vendors/products', 'route_name' => 'insider.vendors.products', 'guard_name' => 'insider', 'permissions' => ['access all vendors products'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-orders', 'label' => 'Orders', 'href' => '/insider/vendors/orders', 'route_name' => 'insider.vendors.orders', 'guard_name' => 'insider', 'permissions' => ['access all vendors orders'], 'order' => 4]);
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-transactions', 'label' => 'Transactions', 'href' => '/insider/vendors/transactions', 'route_name' => 'insider.vendors.transactions', 'guard_name' => 'insider', 'permissions' => ['access all vendors transactions'], 'order' => 5]);
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-promos', 'label' => 'Promos', 'href' => '/insider/vendors/promos', 'route_name' => 'insider.vendors.promos', 'guard_name' => 'insider', 'permissions' => ['access all vendors promos'], 'order' => 6]);
            SidebarMenu::create(['parent_id' => $groupVendors->id, 'key' => 'sub-vendors-reports', 'label' => 'Reports', 'href' => '/insider/vendors/reports', 'route_name' => 'insider.vendors.reports', 'guard_name' => 'insider', 'permissions' => ['access all vendors reports'], 'order' => 7]);


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
            SidebarMenu::create(['parent_id' => $groupClient->id, 'key' => 'sub-client-list', 'label' => 'All Clients', 'href' => '/insider/clients/list', 'route_name' => 'insider.clients.list', 'guard_name' => 'insider', 'permissions' => ['create new client'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupClient->id, 'key' => 'sub-client-orders', 'label' => 'Orders', 'href' => '/insider/clients/orders', 'route_name' => 'insider.clients.orders', 'guard_name' => 'insider', 'permissions' => ['access all client orders'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupClient->id, 'key' => 'sub-client-reports', 'label' => 'Reports', 'href' => '/insider/clients/reports', 'route_name' => 'insider.clients.reports', 'guard_name' => 'insider', 'permissions' => ['access all client reports'], 'order' => 3]);


        // 7. Grup Content Management (Blogs & Pages)
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
            $subMenuPages = SidebarMenu::create(['parent_id' => $groupContent->id, 'key' => 'sub-pages', 'label' => 'Pages', 'href' => '/insider/content/pages', 'route_name' => 'insider.content.pages', 'guard_name' => 'insider', 'permissions' => ['access all page management'], 'order' => 1]);
                SidebarMenu::create(['parent_id' => $subMenuPages->id, 'key' => 'sub-pages-list', 'label' => 'All Pages', 'href' => '/insider/content/pages/list', 'route_name' => 'insider.content.pages.list', 'guard_name' => 'insider', 'permissions' => ['view all page'], 'order' => 1]);
            // Sub-menu Blogs
            $subMenuBlogs = SidebarMenu::create(['parent_id' => $groupContent->id, 'key' => 'sub-blogs', 'label' => 'Blogs', 'href' => '/insider/content/blogs', 'route_name' => 'insider.content.blogs', 'guard_name' => 'insider', 'permissions' => ['access all blog management'], 'order' => 2]);
                SidebarMenu::create(['parent_id' => $subMenuBlogs->id, 'key' => 'sub-blogs-list', 'label' => 'All Posts', 'href' => '/insider/content/blogs/list', 'route_name' => 'insider.content.blogs.list', 'guard_name' => 'insider', 'permissions' => ['view all blog'], 'order' => 1]);
                SidebarMenu::create(['parent_id' => $subMenuBlogs->id, 'key' => 'sub-blogs-categories', 'label' => 'Categories', 'href' => '/insider/content/blogs/categories', 'route_name' => 'insider.content.blogs.categories', 'guard_name' => 'insider', 'permissions' => ['access all categories'], 'order' => 2]);
                SidebarMenu::create(['parent_id' => $subMenuBlogs->id, 'key' => 'sub-blogs-tags', 'label' => 'Tags', 'href' => '/insider/content/blogs/tags', 'route_name' => 'insider.content.blogs.tags', 'guard_name' => 'insider', 'permissions' => ['access all tags'], 'order' => 3]);


        // 8. Grup Marketing Management
        $groupMarketing = SidebarMenu::create([
            'key' => 'group-marketing-management',
            'label' => 'Marketing Management',
            'title' => 'Marketing',
            'icon' => 'tabler:speakerphone',
            'icon_filled' => 'tabler:speakerphone-filled',
            'guard_name' => 'insider',
            'permissions' => ['access all marketing management'],
            'order' => 80,
        ]);
            // Sub-menu Marketing
            SidebarMenu::create(['parent_id' => $groupMarketing->id, 'key' => 'sub-marketing-campaigns', 'label' => 'Campaigns', 'href' => '/insider/marketing/campaigns', 'route_name' => 'insider.marketing.campaigns', 'guard_name' => 'insider', 'permissions' => ['view all marketing campaign'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupMarketing->id, 'key' => 'sub-marketing-subscriptions', 'label' => 'Subscriptions', 'href' => '/insider/marketing/subscriptions', 'route_name' => 'insider.marketing.subscriptions', 'guard_name' => 'insider', 'permissions' => ['view all subscription'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupMarketing->id, 'key' => 'sub-marketing-badges', 'label' => 'Badges', 'href' => '/insider/marketing/badges', 'route_name' => 'insider.marketing.badges', 'guard_name' => 'insider', 'permissions' => ['view all badge'], 'order' => 3]);


        // 9. Grup Roles & Permissions
        $groupRoles = SidebarMenu::create([
            'key' => 'group-roles-permissions',
            'label' => 'Roles & Permissions',
            'title' => 'Roles & Permissions',
            'icon' => 'tabler:lock-access',
            'icon_filled' => 'tabler:lock-access-filled',
            'href' => '/insider/roles',
            'route_name' => 'insider.roles',
            'guard_name' => 'insider',
            'permissions' => ['access all roles and Permission'],
            'order' => 90,
        ]);


        // 10. Grup Payments & Transactions
        $groupPayments = SidebarMenu::create([
            'key' => 'group-payments-transactions',
            'label' => 'Payments & Transactions',
            'title' => 'Payments & Transactions',
            'icon' => 'tabler:credit-card',
            'icon_filled' => 'tabler:credit-card-filled',
            'guard_name' => 'insider',
            'permissions' => ['access all payment and transaction'],
            'order' => 100,
        ]);
            // Sub-menu Payments
            SidebarMenu::create(['parent_id' => $groupPayments->id, 'key' => 'sub-payments-dashboard', 'label' => 'Dashboard', 'href' => '/insider/payments/dashboard', 'route_name' => 'insider.payments.dashboard', 'guard_name' => 'insider', 'permissions' => ['payment and transactions dashboard'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupPayments->id, 'key' => 'sub-payments-transactions', 'label' => 'Transactions', 'href' => '/insider/payments/transactions', 'route_name' => 'insider.payments.transactions', 'guard_name' => 'insider', 'permissions' => ['access all transactions'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupPayments->id, 'key' => 'sub-payments-payments', 'label' => 'Payments', 'href' => '/insider/payments/payments', 'route_name' => 'insider.payments.payments', 'guard_name' => 'insider', 'permissions' => ['access all payments'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $groupPayments->id, 'key' => 'sub-payments-invoices', 'label' => 'Invoices', 'href' => '/insider/payments/invoices', 'route_name' => 'insider.payments.invoices', 'guard_name' => 'insider', 'permissions' => ['access all invoices'], 'order' => 4]);
            SidebarMenu::create(['parent_id' => $groupPayments->id, 'key' => 'sub-payments-refunds', 'label' => 'Refunds', 'href' => '/insider/payments/refunds', 'route_name' => 'insider.payments.refunds', 'guard_name' => 'insider', 'permissions' => ['access all refunds'], 'order' => 5]);


        // 11. Grup Settings
        $groupSettings = SidebarMenu::create([
            'key' => 'group-settings',
            'label' => 'Settings',
            'title' => 'Settings',
            'icon' => 'tabler:settings',
            'icon_filled' => 'tabler:settings-filled',
            'guard_name' => 'insider',
            'order' => 110,
        ]);
            // Sub-menu General Settings
            $subMenuGeneralSettings = SidebarMenu::create(['parent_id' => $groupSettings->id, 'key' => 'sub-settings-general', 'label' => 'General Settings', 'href' => '/insider/settings/general', 'route_name' => 'insider.settings.general', 'guard_name' => 'insider', 'permissions' => ['access general settings'], 'order' => 1]);
            // Sub-menu Site Management
            $subMenuSiteManagement = SidebarMenu::create(['parent_id' => $groupSettings->id, 'key' => 'sub-settings-site', 'label' => 'Site Management', 'href' => '/insider/settings/site', 'route_name' => 'insider.settings.site', 'guard_name' => 'insider', 'permissions' => ['all site management'], 'order' => 2]);
                SidebarMenu::create(['parent_id' => $subMenuSiteManagement->id, 'key' => 'sub-settings-site-settings', 'label' => 'Site Settings', 'href' => '/insider/settings/site/settings', 'route_name' => 'insider.settings.site.settings', 'guard_name' => 'insider', 'permissions' => ['access site settings'], 'order' => 1]);
                SidebarMenu::create(['parent_id' => $subMenuSiteManagement->id, 'key' => 'sub-settings-site-api', 'label' => 'API Settings', 'href' => '/insider/settings/site/api', 'route_name' => 'insider.settings.site.api', 'guard_name' => 'insider', 'permissions' => ['access API settings'], 'order' => 2]);
                SidebarMenu::create(['parent_id' => $subMenuSiteManagement->id, 'key' => 'sub-settings-site-url', 'label' => 'URL Settings', 'href' => '/insider/settings/site/url', 'route_name' => 'insider.settings.site.url', 'guard_name' => 'insider', 'permissions' => ['access url settings'], 'order' => 3]);
                SidebarMenu::create(['parent_id' => $subMenuSiteManagement->id, 'key' => 'sub-settings-site-auth', 'label' => 'Auth Settings', 'href' => '/insider/settings/site/auth', 'route_name' => 'insider.settings.site.auth', 'guard_name' => 'insider', 'permissions' => ['access auth settings'], 'order' => 4]);
                SidebarMenu::create(['parent_id' => $subMenuSiteManagement->id, 'key' => 'sub-settings-site-payments', 'label' => 'Payments Settings', 'href' => '/insider/settings/site/payments', 'route_name' => 'insider.settings.site.payments', 'guard_name' => 'insider', 'permissions' => ['access payments settings'], 'order' => 5]);
                SidebarMenu::create(['parent_id' => $subMenuSiteManagement->id, 'key' => 'sub-settings-site-storage', 'label' => 'Storage Settings', 'href' => '/insider/settings/site/storage', 'route_name' => 'insider.settings.site.storage', 'guard_name' => 'insider', 'permissions' => ['access storage settings'], 'order' => 6]);
                SidebarMenu::create(['parent_id' => $subMenuSiteManagement->id, 'key' => 'sub-settings-site-custom', 'label' => 'Custom Settings', 'href' => '/insider/settings/site/custom', 'route_name' => 'insider.settings.site.custom', 'guard_name' => 'insider', 'permissions' => ['access custom settings'], 'order' => 7]);
            // Sub-menu SEO Management
            $subMenuSEO = SidebarMenu::create(['parent_id' => $groupSettings->id, 'key' => 'sub-settings-seo', 'label' => 'SEO Management', 'href' => '/insider/settings/seo', 'route_name' => 'insider.settings.seo', 'guard_name' => 'insider', 'permissions' => ['access seo management'], 'order' => 3]);
            // Sub-menu Notifications
            $subMenuNotifications = SidebarMenu::create(['parent_id' => $groupSettings->id, 'key' => 'sub-settings-notifications', 'label' => 'Notifications', 'href' => '/insider/settings/notifications', 'route_name' => 'insider.settings.notifications', 'guard_name' => 'insider', 'permissions' => ['access notification management'], 'order' => 4]);


        // 12. Grup Developer Tools
        $groupDeveloper = SidebarMenu::create([
            'key' => 'group-developer-tools',
            'label' => 'Developer Tools',
            'title' => 'Developer Tools',
            'icon' => 'tabler:code',
            'icon_filled' => 'tabler:code-dots',
            'guard_name' => 'insider',
            'permissions' => ['access all developer tools'],
            'order' => 120,
        ]);
            // Sub-menu Developer
            SidebarMenu::create(['parent_id' => $groupDeveloper->id, 'key' => 'sub-developer-audit', 'label' => 'Audit Log', 'href' => '/insider/developer/audit', 'route_name' => 'insider.developer.audit', 'guard_name' => 'insider', 'permissions' => ['access audit log'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupDeveloper->id, 'key' => 'sub-developer-maintenance', 'label' => 'Maintenance Mode', 'href' => '/insider/developer/maintenance', 'route_name' => 'insider.developer.maintenance', 'guard_name' => 'insider', 'permissions' => ['access maintenance mode'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupDeveloper->id, 'key' => 'sub-developer-backup', 'label' => 'System Backup', 'href' => '/insider/developer/backup', 'route_name' => 'insider.developer.backup', 'guard_name' => 'insider', 'permissions' => ['run system backup'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $groupDeveloper->id, 'key' => 'sub-developer-cache', 'label' => 'Clear Cache', 'href' => '/insider/developer/cache', 'route_name' => 'insider.developer.cache', 'guard_name' => 'insider', 'permissions' => ['clear application cache'], 'order' => 4]);
            SidebarMenu::create(['parent_id' => $groupDeveloper->id, 'key' => 'sub-developer-health', 'label' => 'System Health', 'href' => '/insider/developer/health', 'route_name' => 'insider.developer.health', 'guard_name' => 'insider', 'permissions' => ['access system health check'], 'order' => 5]);
            SidebarMenu::create(['parent_id' => $groupDeveloper->id, 'key' => 'sub-developer-docs', 'label' => 'Documentation', 'href' => '/insider/developer/docs', 'route_name' => 'insider.developer.docs', 'guard_name' => 'insider', 'permissions' => ['access all documentation management'], 'order' => 6]);


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
            SidebarMenu::create(['parent_id' => $groupSelfProfile->id, 'key' => 'sub-self-update', 'label' => 'Update Profile', 'href' => '/insider/profile/update', 'route_name' => 'insider.profile.update', 'guard_name' => 'insider', 'permissions' => ['update self profile'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $groupSelfProfile->id, 'key' => 'sub-self-attendance', 'label' => 'Attendance', 'href' => '/insider/profile/attendance', 'route_name' => 'insider.profile.attendance', 'guard_name' => 'insider', 'permissions' => ['access self attendance'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $groupSelfProfile->id, 'key' => 'sub-self-wage', 'label' => 'Wage', 'href' => '/insider/profile/wage', 'route_name' => 'insider.profile.wage', 'guard_name' => 'insider', 'permissions' => ['access self wage'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $groupSelfProfile->id, 'key' => 'sub-self-leave', 'label' => 'Leave', 'href' => '/insider/profile/leave', 'route_name' => 'insider.profile.leave', 'guard_name' => 'insider', 'permissions' => ['access self leave'], 'order' => 4]);
            SidebarMenu::create(['parent_id' => $groupSelfProfile->id, 'key' => 'sub-self-project', 'label' => 'Project', 'href' => '/insider/profile/project', 'route_name' => 'insider.profile.project', 'guard_name' => 'insider', 'permissions' => ['access self project'], 'order' => 5]);


        // ----------------------------------------
        // --- VENDOR MENU (GUARD: 'vendor') ---
        // ----------------------------------------

        // 1. Dashboard Vendor
        $vendorDashboard = SidebarMenu::create([
            'key' => 'vendor-dashboard',
            'label' => 'Dashboard',
            'title' => 'Dashboard',
            'icon' => 'tabler:dashboard',
            'icon_filled' => 'tabler:dashboard-filled',
            'href' => '/vendor/dashboard',
            'route_name' => 'vendor.dashboard',
            'guard_name' => 'vendor',
            'permissions' => ['access vendor dashboard'],
            'order' => 10,
        ]);

        // 2. Product Management
        $vendorProduct = SidebarMenu::create([
            'key' => 'vendor-product-management',
            'label' => 'Product Management',
            'title' => 'Products',
            'icon' => 'tabler:package',
            'icon_filled' => 'tabler:package-filled',
            'href' => '/vendor/products',
            'route_name' => 'vendor.products',
            'guard_name' => 'vendor',
            'permissions' => ['vendor product management'],
            'order' => 20,
        ]);
            SidebarMenu::create(['parent_id' => $vendorProduct->id, 'key' => 'sub-vendor-products-list', 'label' => 'All Products', 'href' => '/vendor/products/list', 'route_name' => 'vendor.products.list', 'guard_name' => 'vendor', 'permissions' => ['vendor view products'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $vendorProduct->id, 'key' => 'sub-vendor-products-categories', 'label' => 'Categories', 'href' => '/vendor/products/categories', 'route_name' => 'vendor.products.categories', 'guard_name' => 'vendor', 'permissions' => ['vendor manage product categories'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $vendorProduct->id, 'key' => 'sub-vendor-products-attributes', 'label' => 'Attributes', 'href' => '/vendor/products/attributes', 'route_name' => 'vendor.products.attributes', 'guard_name' => 'vendor', 'permissions' => ['vendor manage product attributes'], 'order' => 3]);

        // 3. Order Management
        $vendorOrder = SidebarMenu::create([
            'key' => 'vendor-order-management',
            'label' => 'Order Management',
            'title' => 'Orders',
            'icon' => 'tabler:shopping-cart',
            'icon_filled' => 'tabler:shopping-cart-filled',
            'href' => '/vendor/orders',
            'route_name' => 'vendor.orders',
            'guard_name' => 'vendor',
            'permissions' => ['vendor order management'],
            'order' => 30,
        ]);
            SidebarMenu::create(['parent_id' => $vendorOrder->id, 'key' => 'sub-vendor-orders-list', 'label' => 'All Orders', 'href' => '/vendor/orders/list', 'route_name' => 'vendor.orders.list', 'guard_name' => 'vendor', 'permissions' => ['vendor view orders'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $vendorOrder->id, 'key' => 'sub-vendor-orders-refunds', 'label' => 'Refunds', 'href' => '/vendor/orders/refunds', 'route_name' => 'vendor.orders.refunds', 'guard_name' => 'vendor', 'permissions' => ['vendor process refunds'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $vendorOrder->id, 'key' => 'sub-vendor-orders-shipping', 'label' => 'Shipping Labels', 'href' => '/vendor/orders/shipping', 'route_name' => 'vendor.orders.shipping', 'guard_name' => 'vendor', 'permissions' => ['vendor view shipping labels'], 'order' => 3]);

        // 4. Finance & Payouts
        $vendorFinance = SidebarMenu::create([
            'key' => 'vendor-finance-management',
            'label' => 'Finance & Payouts',
            'title' => 'Finance',
            'icon' => 'tabler:wallet',
            'icon_filled' => 'tabler:wallet-filled',
            'href' => '/vendor/finance',
            'route_name' => 'vendor.finance',
            'guard_name' => 'vendor',
            'permissions' => ['vendor finance management'],
            'order' => 40,
        ]);
            SidebarMenu::create(['parent_id' => $vendorFinance->id, 'key' => 'sub-vendor-finance-earnings', 'label' => 'Earnings', 'href' => '/vendor/finance/earnings', 'route_name' => 'vendor.finance.earnings', 'guard_name' => 'vendor', 'permissions' => ['vendor view earnings'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $vendorFinance->id, 'key' => 'sub-vendor-finance-payouts', 'label' => 'Payouts', 'href' => '/vendor/finance/payouts', 'route_name' => 'vendor.finance.payouts', 'guard_name' => 'vendor', 'permissions' => ['vendor request payout'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $vendorFinance->id, 'key' => 'sub-vendor-finance-transactions', 'label' => 'Transactions', 'href' => '/vendor/finance/transactions', 'route_name' => 'vendor.finance.transactions', 'guard_name' => 'vendor', 'permissions' => ['vendor view transaction history'], 'order' => 3]);

        // 5. Marketing & Promotions
        $vendorMarketing = SidebarMenu::create([
            'key' => 'vendor-marketing-management',
            'label' => 'Marketing & Promotions',
            'title' => 'Marketing',
            'icon' => 'tabler:discount-2',
            'icon_filled' => 'tabler:discount-2-filled',
            'href' => '/vendor/marketing',
            'route_name' => 'vendor.marketing',
            'guard_name' => 'vendor',
            'permissions' => ['vendor marketing management'],
            'order' => 50,
        ]);
            SidebarMenu::create(['parent_id' => $vendorMarketing->id, 'key' => 'sub-vendor-marketing-promos', 'label' => 'Promo Codes', 'href' => '/vendor/marketing/promos', 'route_name' => 'vendor.marketing.promos', 'guard_name' => 'vendor', 'permissions' => ['vendor create promo codes'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $vendorMarketing->id, 'key' => 'sub-vendor-marketing-ads', 'label' => 'Ads Management', 'href' => '/vendor/marketing/ads', 'route_name' => 'vendor.marketing.ads', 'guard_name' => 'vendor', 'permissions' => ['vendor manage ads'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $vendorMarketing->id, 'key' => 'sub-vendor-marketing-reports', 'label' => 'Reports', 'href' => '/vendor/marketing/reports', 'route_name' => 'vendor.marketing.reports', 'guard_name' => 'vendor', 'permissions' => ['vendor view marketing reports'], 'order' => 3]);

        // 6. Reviews & Support
        $vendorSupport = SidebarMenu::create([
            'key' => 'vendor-support-management',
            'label' => 'Reviews & Support',
            'title' => 'Support',
            'icon' => 'tabler:message-2',
            'icon_filled' => 'tabler:message-2-filled',
            'guard_name' => 'vendor',
            'permissions' => ['vendor support management'],
            'order' => 60,
        ]);
            SidebarMenu::create(['parent_id' => $vendorSupport->id, 'key' => 'sub-vendor-support-reviews', 'label' => 'Reviews', 'href' => '/vendor/support/reviews', 'route_name' => 'vendor.support.reviews', 'guard_name' => 'vendor', 'permissions' => ['vendor view reviews'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $vendorSupport->id, 'key' => 'sub-vendor-support-tickets', 'label' => 'Support Tickets', 'href' => '/vendor/support/tickets', 'route_name' => 'vendor.support.tickets', 'guard_name' => 'vendor', 'permissions' => ['vendor access support tickets'], 'order' => 2]);

        // 7. Team & Settings
        $vendorSettings = SidebarMenu::create([
            'key' => 'vendor-team-settings',
            'label' => 'Team & Settings',
            'title' => 'Settings',
            'icon' => 'tabler:settings',
            'icon_filled' => 'tabler:settings-filled',
            'guard_name' => 'vendor',
            'permissions' => ['vendor team and settings'],
            'order' => 70,
        ]);
            SidebarMenu::create(['parent_id' => $vendorSettings->id, 'key' => 'sub-vendor-settings-profile', 'label' => 'Store Profile', 'href' => '/vendor/settings/profile', 'route_name' => 'vendor.settings.profile', 'guard_name' => 'vendor', 'permissions' => ['vendor update store profile'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $vendorSettings->id, 'key' => 'sub-vendor-settings-team', 'label' => 'Team Members', 'href' => '/vendor/settings/team', 'route_name' => 'vendor.settings.team', 'guard_name' => 'vendor', 'permissions' => ['vendor manage team members'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $vendorSettings->id, 'key' => 'sub-vendor-settings-roles', 'label' => 'Roles & Permissions', 'href' => '/vendor/settings/roles', 'route_name' => 'vendor.settings.roles', 'guard_name' => 'vendor', 'permissions' => ['vendor manage roles and permissions'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $vendorSettings->id, 'key' => 'sub-vendor-settings-store', 'label' => 'Store Settings', 'href' => '/vendor/settings/store', 'route_name' => 'vendor.settings.store', 'guard_name' => 'vendor', 'permissions' => ['vendor manage store settings'], 'order' => 4]);
            SidebarMenu::create(['parent_id' => $vendorSettings->id, 'key' => 'sub-vendor-settings-subscription', 'label' => 'Subscription', 'href' => '/vendor/settings/subscription', 'route_name' => 'vendor.settings.subscription', 'guard_name' => 'vendor', 'permissions' => ['vendor change subscription'], 'order' => 5]);


        // ----------------------------------------
        // --- CLIENT MENU (GUARD: 'client') ---
        // ----------------------------------------

        // 1. Dashboard Client
        $clientDashboard = SidebarMenu::create([
            'key' => 'client-dashboard',
            'label' => 'Dashboard',
            'title' => 'Dashboard',
            'icon' => 'tabler:dashboard',
            'icon_filled' => 'tabler:dashboard-filled',
            'href' => '/client/dashboard',
            'route_name' => 'client.dashboard',
            'guard_name' => 'client',
            'permissions' => ['access client dashboard'],
            'order' => 10,
        ]);

        // 2. Order Management
        $clientOrder = SidebarMenu::create([
            'key' => 'client-order-management',
            'label' => 'My Orders',
            'title' => 'Orders',
            'icon' => 'tabler:shopping-bag',
            'icon_filled' => 'tabler:shopping-bag-filled',
            'href' => '/client/orders',
            'route_name' => 'client.orders',
            'guard_name' => 'client',
            'permissions' => ['client order management'],
            'order' => 20,
        ]);
            SidebarMenu::create(['parent_id' => $clientOrder->id, 'key' => 'sub-client-orders-list', 'label' => 'All Orders', 'href' => '/client/orders/list', 'route_name' => 'client.orders.list', 'guard_name' => 'client', 'permissions' => ['client view orders'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $clientOrder->id, 'key' => 'sub-client-orders-track', 'label' => 'Track Order', 'href' => '/client/orders/track', 'route_name' => 'client.orders.track', 'guard_name' => 'client', 'permissions' => ['client track orders'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $clientOrder->id, 'key' => 'sub-client-orders-refund', 'label' => 'Request Refund', 'href' => '/client/orders/refund', 'route_name' => 'client.orders.refund', 'guard_name' => 'client', 'permissions' => ['client request refund'], 'order' => 3]);

        // 3. Profile Management
        $clientProfile = SidebarMenu::create([
            'key' => 'client-profile-management',
            'label' => 'My Profile',
            'title' => 'Profile',
            'icon' => 'tabler:user-circle',
            'icon_filled' => 'tabler:user-circle-filled',
            'href' => '/client/profile',
            'route_name' => 'client.profile',
            'guard_name' => 'client',
            'permissions' => ['client profile management'],
            'order' => 30,
        ]);
            SidebarMenu::create(['parent_id' => $clientProfile->id, 'key' => 'sub-client-profile-update', 'label' => 'Update Profile', 'href' => '/client/profile/update', 'route_name' => 'client.profile.update', 'guard_name' => 'client', 'permissions' => ['client update profile'], 'order' => 1]);
            SidebarMenu::create(['parent_id' => $clientProfile->id, 'key' => 'sub-client-profile-addresses', 'label' => 'Addresses', 'href' => '/client/profile/addresses', 'route_name' => 'client.profile.addresses', 'guard_name' => 'client', 'permissions' => ['client manage addresses'], 'order' => 2]);
            SidebarMenu::create(['parent_id' => $clientProfile->id, 'key' => 'sub-client-profile-payments', 'label' => 'Payment Methods', 'href' => '/client/profile/payments', 'route_name' => 'client.profile.payments', 'guard_name' => 'client', 'permissions' => ['client manage payment methods'], 'order' => 3]);
            SidebarMenu::create(['parent_id' => $clientProfile->id, 'key' => 'sub-client-profile-wishlist', 'label' => 'Wishlist', 'href' => '/client/profile/wishlist', 'route_name' => 'client.profile.wishlist', 'guard_name' => 'client', 'permissions' => ['client view wishlists'], 'order' => 4]);

        // 4. Reviews
        $clientReview = SidebarMenu::create([
            'key' => 'client-review-management',
            'label' => 'My Reviews',
            'title' => 'Reviews',
            'icon' => 'tabler:star',
            'icon_filled' => 'tabler:star-filled',
            'href' => '/client/reviews',
            'route_name' => 'client.reviews',
            'guard_name' => 'client',
            'permissions' => ['client review management'],
            'order' => 40,
        ]);
            SidebarMenu::create(['parent_id' => $clientReview->id, 'key' => 'sub-client-reviews-list', 'label' => 'All Reviews', 'href' => '/client/reviews/list', 'route_name' => 'client.reviews.list', 'guard_name' => 'client', 'permissions' => ['client create review'], 'order' => 1]);

        // 5. Support
        $clientSupport = SidebarMenu::create([
            'key' => 'client-support-access',
            'label' => 'Support',
            'title' => 'Support',
            'icon' => 'tabler:lifebuoy',
            'icon_filled' => 'tabler:lifebuoy-filled',
            'href' => '/client/support',
            'route_name' => 'client.support',
            'guard_name' => 'client',
            'permissions' => ['client support access'],
            'order' => 50,
        ]);
            SidebarMenu::create(['parent_id' => $clientSupport->id, 'key' => 'sub-client-support-tickets', 'label' => 'My Tickets', 'href' => '/client/support/tickets', 'route_name' => 'client.support.tickets', 'guard_name' => 'client', 'permissions' => ['client view support tickets'], 'order' => 1]);

        // 6. Subscriptions
        $clientSubscription = SidebarMenu::create([
            'key' => 'client-subscription-management',
            'label' => 'Subscriptions',
            'title' => 'Subscriptions',
            'icon' => 'tabler:repeat',
            'icon_filled' => 'tabler:repeat-once',
            'href' => '/client/subscriptions',
            'route_name' => 'client.subscriptions',
            'guard_name' => 'client',
            'permissions' => ['client subscription management'],
            'order' => 60,
        ]);
            SidebarMenu::create(['parent_id' => $clientSubscription->id, 'key' => 'sub-client-subscriptions-list', 'label' => 'My Subscriptions', 'href' => '/client/subscriptions/list', 'route_name' => 'client.subscriptions.list', 'guard_name' => 'client', 'permissions' => ['client view subscriptions'], 'order' => 1]);
    }
}
