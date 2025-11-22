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
            'icon' => 'material-symbols:dashboard-outline', // Outline untuk inactive
            'icon_filled' => 'material-symbols:dashboard',  // Base name = Filled untuk active
            'href' => '/insider/dashboard',
            'route_name' => 'insider.dashboard',
            'guard_name' => 'insider',
            'permissions' => ['access super admin dashboard'],
            'order' => 10,
        ]);
            SidebarMenu::create([
                'parent_id' => $groupDashboard->id,
                'key' => 'sub-admin-dash',
                'label' => 'Admin Dashboard',
                'icon' => 'material-symbols:admin-panel-settings-outline',
                'icon_filled' => 'material-symbols:admin-panel-settings',
                'href' => '/insider/admin-dashboard',
                'route_name' => 'insider.admin.dashboard',
                'guard_name' => 'insider',
                'permissions' => ['access admin dashboard'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $groupDashboard->id,
                'key' => 'sub-accounting-dash',
                'label' => 'Accounting Dashboard',
                'icon' => 'material-symbols:account-balance-outline',
                'icon_filled' => 'material-symbols:account-balance',
                'href' => '/insider/accounting-dashboard',
                'route_name' => 'insider.accounting.dashboard',
                'guard_name' => 'insider',
                'permissions' => ['access accounting dashboard'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $groupDashboard->id,
                'key' => 'sub-developer-dash',
                'label' => 'Developer Dashboard',
                'icon' => 'material-symbols:terminal', // Terminal biasanya tidak punya versi outline khusus yang berbeda jauh
                'icon_filled' => 'material-symbols:terminal',
                'href' => '/insider/developer-dashboard',
                'route_name' => 'insider.developer.dashboard',
                'guard_name' => 'insider',
                'permissions' => ['access developer dashboard'],
                'order' => 3
            ]);
            SidebarMenu::create([
                'parent_id' => $groupDashboard->id,
                'key' => 'sub-hr-dash',
                'label' => 'Human Resources Dashboard',
                'icon' => 'material-symbols:badge-outline',
                'icon_filled' => 'material-symbols:badge',
                'href' => '/insider/hr-dashboard',
                'route_name' => 'insider.hr.dashboard',
                'guard_name' => 'insider',
                'permissions' => ['access human resources dashboard'],
                'order' => 4
            ]);
            SidebarMenu::create([
                'parent_id' => $groupDashboard->id,
                'key' => 'sub-sales-dash',
                'label' => 'Sales Dashboard',
                'icon' => 'material-symbols:trending-up', // Trending up garisnya tipis, filled biasanya sama
                'icon_filled' => 'material-symbols:trending-up',
                'href' => '/insider/sales-dashboard',
                'route_name' => 'insider.sales.dashboard',
                'guard_name' => 'insider',
                'permissions' => ['access sales dashboard'],
                'order' => 5
            ]);
            SidebarMenu::create([
                'parent_id' => $groupDashboard->id,
                'key' => 'sub-vendors-dash',
                'label' => 'Vendors Admin Dashboard',
                'icon' => 'material-symbols:storefront-outline',
                'icon_filled' => 'material-symbols:storefront',
                'href' => '/insider/vendors-admin-dashboard',
                'route_name' => 'insider.vendors.admin.dashboard',
                'guard_name' => 'insider',
                'permissions' => ['access vendors admin dashboard'],
                'order' => 6
            ]);
            SidebarMenu::create([
                'parent_id' => $groupDashboard->id,
                'key' => 'sub-cs-dash',
                'label' => 'Customer Service Dashboard',
                'icon' => 'material-symbols:support-agent', // Icon ini unik, outline/filled perbedaannya minim di beberapa set
                'icon_filled' => 'material-symbols:support-agent',
                'href' => '/insider/cs-dashboard',
                'route_name' => 'insider.cs.dashboard',
                'guard_name' => 'insider',
                'permissions' => ['access customer service dashboard'],
                'order' => 7
            ]);
            SidebarMenu::create([
                'parent_id' => $groupDashboard->id,
                'key' => 'sub-marketing-dash',
                'label' => 'Marketing Dashboard',
                'icon' => 'material-symbols:campaign-outline',
                'icon_filled' => 'material-symbols:campaign',
                'href' => '/insider/marketing-dashboard',
                'route_name' => 'insider.marketing.dashboard',
                'guard_name' => 'insider',
                'permissions' => ['access marketing dashboard'],
                'order' => 8
            ]);


        // 2. Grup Search Management
        $groupSearch = SidebarMenu::create([
            'key' => 'group-search',
            'label' => 'Search Management',
            'title' => 'Search Management',
            'icon' => 'material-symbols:search',
            'icon_filled' => 'material-symbols:search',
            'href' => '/insider/search',
            'route_name' => 'insider.search',
            'guard_name' => 'insider',
            'permissions' => ['access global search'],
            'order' => 20,
        ]);
            SidebarMenu::create([
                'parent_id' => $groupSearch->id,
                'key' => 'sub-insiders-search',
                'label' => 'Insiders Search',
                'icon' => 'material-symbols:person-search-outline',
                'icon_filled' => 'material-symbols:person-search',
                'href' => '/insider/search/insiders',
                'route_name' => 'insider.search.insiders',
                'guard_name' => 'insider',
                'permissions' => ['access insiders search'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $groupSearch->id,
                'key' => 'sub-vendors-search',
                'label' => 'Vendors Search',
                'icon' => 'material-symbols:manage-search',
                'icon_filled' => 'material-symbols:manage-search',
                'href' => '/insider/search/vendors',
                'route_name' => 'insider.search.vendors',
                'guard_name' => 'insider',
                'permissions' => ['access vendors search'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $groupSearch->id,
                'key' => 'sub-clients-search',
                'label' => 'Clients Search',
                'icon' => 'material-symbols:supervised-user-circle-outline',
                'icon_filled' => 'material-symbols:supervised-user-circle',
                'href' => '/insider/search/clients',
                'route_name' => 'insider.search.clients',
                'guard_name' => 'insider',
                'permissions' => ['access clients search'],
                'order' => 3
            ]);
            SidebarMenu::create([
                'parent_id' => $groupSearch->id,
                'key' => 'sub-products-search',
                'label' => 'Products Search',
                'icon' => 'material-symbols:inventory-2-outline',
                'icon_filled' => 'material-symbols:inventory-2',
                'href' => '/insider/search/products',
                'route_name' => 'insider.search.products',
                'guard_name' => 'insider',
                'permissions' => ['access products search'],
                'order' => 4
            ]);
            SidebarMenu::create([
                'parent_id' => $groupSearch->id,
                'key' => 'sub-orders-search',
                'label' => 'Orders Search',
                'icon' => 'material-symbols:receipt-long-outline',
                'icon_filled' => 'material-symbols:receipt-long',
                'href' => '/insider/search/orders',
                'route_name' => 'insider.search.orders',
                'guard_name' => 'insider',
                'permissions' => ['access orders search'],
                'order' => 5
            ]);
            SidebarMenu::create([
                'parent_id' => $groupSearch->id,
                'key' => 'sub-blog-search',
                'label' => 'Blog Posts Search',
                'icon' => 'material-symbols:article-outline',
                'icon_filled' => 'material-symbols:article',
                'href' => '/insider/search/blog',
                'route_name' => 'insider.search.blog',
                'guard_name' => 'insider',
                'permissions' => ['access blog posts search'],
                'order' => 6
            ]);
            SidebarMenu::create([
                'parent_id' => $groupSearch->id,
                'key' => 'sub-tickets-search',
                'label' => 'Tickets Search',
                'icon' => 'material-symbols:confirmation-number-outline',
                'icon_filled' => 'material-symbols:confirmation-number',
                'href' => '/insider/search/tickets',
                'route_name' => 'insider.search.tickets',
                'guard_name' => 'insider',
                'permissions' => ['access tickets search'],
                'order' => 7
            ]);
            SidebarMenu::create([
                'parent_id' => $groupSearch->id,
                'key' => 'sub-promos-search',
                'label' => 'Promos Search',
                'icon' => 'material-symbols:local-activity-outline',
                'icon_filled' => 'material-symbols:local-activity',
                'href' => '/insider/search/promos',
                'route_name' => 'insider.search.promos',
                'guard_name' => 'insider',
                'permissions' => ['access promos search'],
                'order' => 8
            ]);


        // 3. Grup Communication
        $groupCommunication = SidebarMenu::create([
            'key' => 'group-communication',
            'label' => 'Communication',
            'title' => 'Communication',
            'icon' => 'material-symbols:chat-bubble-outline',
            'icon_filled' => 'material-symbols:chat-bubble',
            'guard_name' => 'insider',
            'order' => 30,
        ]);
            SidebarMenu::create([
                'parent_id' => $groupCommunication->id,
                'key' => 'menu-self-email',
                'label' => 'Self Email',
                'icon' => 'material-symbols:mail-outline',
                'icon_filled' => 'material-symbols:mail',
                'href' => '/insider/email/self',
                'route_name' => 'insider.email.self',
                'guard_name' => 'insider',
                'permissions' => ['access self email'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $groupCommunication->id,
                'key' => 'menu-all-emails',
                'label' => 'All Emails',
                'icon' => 'material-symbols:mark-email-unread-outline',
                'icon_filled' => 'material-symbols:mark-email-unread',
                'href' => '/insider/email/all',
                'route_name' => 'insider.email.all',
                'guard_name' => 'insider',
                'permissions' => ['access all emails'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $groupCommunication->id,
                'key' => 'menu-self-chat',
                'label' => 'Self Chat',
                'icon' => 'material-symbols:chat-outline',
                'icon_filled' => 'material-symbols:chat',
                'href' => '/insider/chat/self',
                'route_name' => 'insider.chat.self',
                'guard_name' => 'insider',
                'permissions' => ['access self chat'],
                'order' => 3
            ]);
            SidebarMenu::create([
                'parent_id' => $groupCommunication->id,
                'key' => 'menu-tickets',
                'label' => 'Tickets',
                'icon' => 'material-symbols:local-activity-outline',
                'icon_filled' => 'material-symbols:local-activity',
                'href' => '/insider/tickets',
                'route_name' => 'insider.tickets',
                'guard_name' => 'insider',
                'permissions' => ['access tickets'],
                'order' => 4
            ]);


        // 4. Grup Insider Management
        $groupInsider = SidebarMenu::create([
            'key' => 'group-insider-management',
            'label' => 'Insider Management',
            'title' => 'Insider & Team',
            'icon' => 'material-symbols:groups-outline',
            'icon_filled' => 'material-symbols:groups',
            'href' => '/insider/team',
            'route_name' => 'insider.team',
            'guard_name' => 'insider',
            'permissions' => ['insider and team dashboard'],
            'order' => 40,
        ]);
            SidebarMenu::create([
                'parent_id' => $groupInsider->id,
                'key' => 'sub-insider-list',
                'label' => 'All Insiders',
                'icon' => 'material-symbols:list-alt-outline',
                'icon_filled' => 'material-symbols:list-alt',
                'href' => '/insider/team/list',
                'route_name' => 'insider.team.list',
                'guard_name' => 'insider',
                'permissions' => ['create new insider'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $groupInsider->id,
                'key' => 'sub-insider-wages',
                'label' => 'Wages',
                'icon' => 'material-symbols:attach-money',
                'icon_filled' => 'material-symbols:attach-money',
                'href' => '/insider/team/wages',
                'route_name' => 'insider.team.wages',
                'guard_name' => 'insider',
                'permissions' => ['access all insider wages'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $groupInsider->id,
                'key' => 'sub-insider-attendance',
                'label' => 'Attendance',
                'icon' => 'material-symbols:calendar-month-outline',
                'icon_filled' => 'material-symbols:calendar-month',
                'href' => '/insider/team/attendance',
                'route_name' => 'insider.team.attendance',
                'guard_name' => 'insider',
                'permissions' => ['access all insider attendances'],
                'order' => 3
            ]);
            SidebarMenu::create([
                'parent_id' => $groupInsider->id,
                'key' => 'sub-insider-divisions',
                'label' => 'Divisions',
                'icon' => 'material-symbols:category-outline',
                'icon_filled' => 'material-symbols:category',
                'href' => '/insider/team/divisions',
                'route_name' => 'insider.team.divisions',
                'guard_name' => 'insider',
                'permissions' => ['access all insider divisions'],
                'order' => 4
            ]);
            SidebarMenu::create([
                'parent_id' => $groupInsider->id,
                'key' => 'sub-insider-leaves',
                'label' => 'Leaves',
                'icon' => 'material-symbols:event-busy-outline',
                'icon_filled' => 'material-symbols:event-busy',
                'href' => '/insider/team/leaves',
                'route_name' => 'insider.team.leaves',
                'guard_name' => 'insider',
                'permissions' => ['access all insider leaves'],
                'order' => 5
            ]);
            SidebarMenu::create([
                'parent_id' => $groupInsider->id,
                'key' => 'sub-insider-positions',
                'label' => 'Positions',
                'icon' => 'material-symbols:work-outline',
                'icon_filled' => 'material-symbols:work',
                'href' => '/insider/team/positions',
                'route_name' => 'insider.team.positions',
                'guard_name' => 'insider',
                'permissions' => ['access all insider positions'],
                'order' => 6
            ]);
            SidebarMenu::create([
                'parent_id' => $groupInsider->id,
                'key' => 'sub-insider-projects',
                'label' => 'Projects',
                'icon' => 'material-symbols:rocket-launch-outline',
                'icon_filled' => 'material-symbols:rocket-launch',
                'href' => '/insider/team/projects',
                'route_name' => 'insider.team.projects',
                'guard_name' => 'insider',
                'permissions' => ['access all insider projects'],
                'order' => 7
            ]);


        // 5. Grup Vendors Management
        $groupVendors = SidebarMenu::create([
            'key' => 'group-vendors-management',
            'label' => 'Vendors Management',
            'title' => 'Vendors & POS',
            'icon' => 'material-symbols:store-outline',
            'icon_filled' => 'material-symbols:store',
            'href' => '/insider/vendors',
            'route_name' => 'insider.vendors',
            'guard_name' => 'insider',
            'permissions' => ['vendors and pos dashboard'],
            'order' => 50,
        ]);
            SidebarMenu::create([
                'parent_id' => $groupVendors->id,
                'key' => 'sub-vendors-list',
                'label' => 'All Vendors',
                'icon' => 'material-symbols:list-alt-outline',
                'icon_filled' => 'material-symbols:list-alt',
                'href' => '/insider/vendors/list',
                'route_name' => 'insider.vendors.list',
                'guard_name' => 'insider',
                'permissions' => ['access all vendors'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $groupVendors->id,
                'key' => 'sub-vendors-stores',
                'label' => 'Stores',
                'icon' => 'material-symbols:storefront-outline',
                'icon_filled' => 'material-symbols:storefront',
                'href' => '/insider/vendors/stores',
                'route_name' => 'insider.vendors.stores',
                'guard_name' => 'insider',
                'permissions' => ['access all vendors stores'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $groupVendors->id,
                'key' => 'sub-vendors-products',
                'label' => 'Products',
                'icon' => 'material-symbols:inventory-2-outline',
                'icon_filled' => 'material-symbols:inventory-2',
                'href' => '/insider/vendors/products',
                'route_name' => 'insider.vendors.products',
                'guard_name' => 'insider',
                'permissions' => ['access all vendors products'],
                'order' => 3
            ]);
            SidebarMenu::create([
                'parent_id' => $groupVendors->id,
                'key' => 'sub-vendors-orders',
                'label' => 'Orders',
                'icon' => 'material-symbols:shopping-cart-outline',
                'icon_filled' => 'material-symbols:shopping-cart',
                'href' => '/insider/vendors/orders',
                'route_name' => 'insider.vendors.orders',
                'guard_name' => 'insider',
                'permissions' => ['access all vendors orders'],
                'order' => 4
            ]);
            SidebarMenu::create([
                'parent_id' => $groupVendors->id,
                'key' => 'sub-vendors-transactions',
                'label' => 'Transactions',
                'icon' => 'material-symbols:receipt-long-outline',
                'icon_filled' => 'material-symbols:receipt-long',
                'href' => '/insider/vendors/transactions',
                'route_name' => 'insider.vendors.transactions',
                'guard_name' => 'insider',
                'permissions' => ['access all vendors transactions'],
                'order' => 5
            ]);
            SidebarMenu::create([
                'parent_id' => $groupVendors->id,
                'key' => 'sub-vendors-promos',
                'label' => 'Promos',
                'icon' => 'material-symbols:percent',
                'icon_filled' => 'material-symbols:percent',
                'href' => '/insider/vendors/promos',
                'route_name' => 'insider.vendors.promos',
                'guard_name' => 'insider',
                'permissions' => ['access all vendors promos'],
                'order' => 6
            ]);
            SidebarMenu::create([
                'parent_id' => $groupVendors->id,
                'key' => 'sub-vendors-reports',
                'label' => 'Reports',
                'icon' => 'material-symbols:insert-chart-outline', // Use insert-chart-outline
                'icon_filled' => 'material-symbols:insert-chart',
                'href' => '/insider/vendors/reports',
                'route_name' => 'insider.vendors.reports',
                'guard_name' => 'insider',
                'permissions' => ['access all vendors reports'],
                'order' => 7
            ]);


        // 6. Grup Client Management
        $groupClient = SidebarMenu::create([
            'key' => 'group-client-management',
            'label' => 'Client Management',
            'title' => 'Client Management',
            'icon' => 'material-symbols:group-outline',
            'icon_filled' => 'material-symbols:group',
            'href' => '/insider/clients',
            'route_name' => 'insider.clients',
            'guard_name' => 'insider',
            'permissions' => ['access all client'],
            'order' => 60,
        ]);
            SidebarMenu::create([
                'parent_id' => $groupClient->id,
                'key' => 'sub-client-list',
                'label' => 'All Clients',
                'icon' => 'material-symbols:list-alt-outline',
                'icon_filled' => 'material-symbols:list-alt',
                'href' => '/insider/clients/list',
                'route_name' => 'insider.clients.list',
                'guard_name' => 'insider',
                'permissions' => ['create new client'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $groupClient->id,
                'key' => 'sub-client-orders',
                'label' => 'Orders',
                'icon' => 'material-symbols:shopping-bag-outline',
                'icon_filled' => 'material-symbols:shopping-bag',
                'href' => '/insider/clients/orders',
                'route_name' => 'insider.clients.orders',
                'guard_name' => 'insider',
                'permissions' => ['access all client orders'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $groupClient->id,
                'key' => 'sub-client-reports',
                'label' => 'Reports',
                'icon' => 'material-symbols:analytics-outline',
                'icon_filled' => 'material-symbols:analytics',
                'href' => '/insider/clients/reports',
                'route_name' => 'insider.clients.reports',
                'guard_name' => 'insider',
                'permissions' => ['access all client reports'],
                'order' => 3
            ]);


        // 7. Grup Content Management
        $groupContent = SidebarMenu::create([
            'key' => 'group-content-management',
            'label' => 'Content Management',
            'title' => 'Content Management',
            'icon' => 'material-symbols:description-outline',
            'icon_filled' => 'material-symbols:description',
            'guard_name' => 'insider',
            'order' => 70,
        ]);
            // Sub-menu Pages
            $subMenuPages = SidebarMenu::create([
                'parent_id' => $groupContent->id,
                'key' => 'sub-pages',
                'label' => 'Pages',
                'icon' => 'material-symbols:pages', // Pages usually unique
                'icon_filled' => 'material-symbols:pages',
                'href' => '/insider/content/pages',
                'route_name' => 'insider.content.pages',
                'guard_name' => 'insider',
                'permissions' => ['access all page management'],
                'order' => 1
            ]);
                SidebarMenu::create([
                    'parent_id' => $subMenuPages->id,
                    'key' => 'sub-pages-list',
                    'label' => 'All Pages',
                    'icon' => 'material-symbols:list-alt-outline',
                    'icon_filled' => 'material-symbols:list-alt',
                    'href' => '/insider/content/pages/list',
                    'route_name' => 'insider.content.pages.list',
                    'guard_name' => 'insider',
                    'permissions' => ['view all page'],
                    'order' => 1
                ]);
            // Sub-menu Blogs
            $subMenuBlogs = SidebarMenu::create([
                'parent_id' => $groupContent->id,
                'key' => 'sub-blogs',
                'label' => 'Blogs',
                'icon' => 'material-symbols:rss-feed',
                'icon_filled' => 'material-symbols:rss-feed',
                'href' => '/insider/content/blogs',
                'route_name' => 'insider.content.blogs',
                'guard_name' => 'insider',
                'permissions' => ['access all blog management'],
                'order' => 2
            ]);
                SidebarMenu::create([
                    'parent_id' => $subMenuBlogs->id,
                    'key' => 'sub-blogs-list',
                    'label' => 'All Posts',
                    'icon' => 'material-symbols:article-outline',
                    'icon_filled' => 'material-symbols:article',
                    'href' => '/insider/content/blogs/list',
                    'route_name' => 'insider.content.blogs.list',
                    'guard_name' => 'insider',
                    'permissions' => ['view all blog'],
                    'order' => 1
                ]);
                SidebarMenu::create([
                    'parent_id' => $subMenuBlogs->id,
                    'key' => 'sub-blogs-categories',
                    'label' => 'Categories',
                    'icon' => 'material-symbols:category-outline',
                    'icon_filled' => 'material-symbols:category',
                    'href' => '/insider/content/blogs/categories',
                    'route_name' => 'insider.content.blogs.categories',
                    'guard_name' => 'insider',
                    'permissions' => ['access all categories'],
                    'order' => 2
                ]);
                SidebarMenu::create([
                    'parent_id' => $subMenuBlogs->id,
                    'key' => 'sub-blogs-tags',
                    'label' => 'Tags',
                    'icon' => 'material-symbols:label-outline',
                    'icon_filled' => 'material-symbols:label',
                    'href' => '/insider/content/blogs/tags',
                    'route_name' => 'insider.content.blogs.tags',
                    'guard_name' => 'insider',
                    'permissions' => ['access all tags'],
                    'order' => 3
                ]);


        // 8. Grup Marketing Management
        $groupMarketing = SidebarMenu::create([
            'key' => 'group-marketing-management',
            'label' => 'Marketing Management',
            'title' => 'Marketing',
            'icon' => 'material-symbols:campaign-outline',
            'icon_filled' => 'material-symbols:campaign',
            'guard_name' => 'insider',
            'permissions' => ['access all marketing management'],
            'order' => 80,
        ]);
            SidebarMenu::create([
                'parent_id' => $groupMarketing->id,
                'key' => 'sub-marketing-campaigns',
                'label' => 'Campaigns',
                'icon' => 'material-symbols:campaign-outline',
                'icon_filled' => 'material-symbols:campaign',
                'href' => '/insider/marketing/campaigns',
                'route_name' => 'insider.marketing.campaigns',
                'guard_name' => 'insider',
                'permissions' => ['view all marketing campaign'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $groupMarketing->id,
                'key' => 'sub-marketing-subscriptions',
                'label' => 'Subscriptions',
                'icon' => 'material-symbols:loyalty-outline',
                'icon_filled' => 'material-symbols:loyalty',
                'href' => '/insider/marketing/subscriptions',
                'route_name' => 'insider.marketing.subscriptions',
                'guard_name' => 'insider',
                'permissions' => ['view all subscription'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $groupMarketing->id,
                'key' => 'sub-marketing-badges',
                'label' => 'Badges',
                'icon' => 'material-symbols:military-tech-outline',
                'icon_filled' => 'material-symbols:military-tech',
                'href' => '/insider/marketing/badges',
                'route_name' => 'insider.marketing.badges',
                'guard_name' => 'insider',
                'permissions' => ['view all badge'],
                'order' => 3
            ]);


        // 9. Grup Roles & Permissions
        $groupRoles = SidebarMenu::create([
            'key' => 'group-roles-permissions',
            'label' => 'Roles & Permissions',
            'title' => 'Roles & Permissions',
            'icon' => 'material-symbols:lock-person-outline',
            'icon_filled' => 'material-symbols:lock-person',
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
            'icon' => 'material-symbols:credit-card-outline',
            'icon_filled' => 'material-symbols:credit-card',
            'guard_name' => 'insider',
            'permissions' => ['access all payment and transaction'],
            'order' => 100,
        ]);
            SidebarMenu::create([
                'parent_id' => $groupPayments->id,
                'key' => 'sub-payments-dashboard',
                'label' => 'Dashboard',
                'icon' => 'material-symbols:dashboard-outline',
                'icon_filled' => 'material-symbols:dashboard',
                'href' => '/insider/payments/dashboard',
                'route_name' => 'insider.payments.dashboard',
                'guard_name' => 'insider',
                'permissions' => ['payment and transactions dashboard'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $groupPayments->id,
                'key' => 'sub-payments-transactions',
                'label' => 'Transactions',
                'icon' => 'material-symbols:receipt-long-outline',
                'icon_filled' => 'material-symbols:receipt-long',
                'href' => '/insider/payments/transactions',
                'route_name' => 'insider.payments.transactions',
                'guard_name' => 'insider',
                'permissions' => ['access all transactions'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $groupPayments->id,
                'key' => 'sub-payments-payments',
                'label' => 'Payments',
                'icon' => 'material-symbols:payments-outline',
                'icon_filled' => 'material-symbols:payments',
                'href' => '/insider/payments/payments',
                'route_name' => 'insider.payments.payments',
                'guard_name' => 'insider',
                'permissions' => ['access all payments'],
                'order' => 3
            ]);
            SidebarMenu::create([
                'parent_id' => $groupPayments->id,
                'key' => 'sub-payments-invoices',
                'label' => 'Invoices',
                'icon' => 'material-symbols:description-outline',
                'icon_filled' => 'material-symbols:description',
                'href' => '/insider/payments/invoices',
                'route_name' => 'insider.payments.invoices',
                'guard_name' => 'insider',
                'permissions' => ['access all invoices'],
                'order' => 4
            ]);
            SidebarMenu::create([
                'parent_id' => $groupPayments->id,
                'key' => 'sub-payments-refunds',
                'label' => 'Refunds',
                'icon' => 'material-symbols:currency-exchange', // Often shared
                'icon_filled' => 'material-symbols:currency-exchange',
                'href' => '/insider/payments/refunds',
                'route_name' => 'insider.payments.refunds',
                'guard_name' => 'insider',
                'permissions' => ['access all refunds'],
                'order' => 5
            ]);


        // 11. Grup Settings
        $groupSettings = SidebarMenu::create([
            'key' => 'group-settings',
            'label' => 'Settings',
            'title' => 'Settings',
            'icon' => 'material-symbols:settings-outline',
            'icon_filled' => 'material-symbols:settings',
            'guard_name' => 'insider',
            'order' => 110,
        ]);
            SidebarMenu::create([
                'parent_id' => $groupSettings->id,
                'key' => 'sub-settings-general',
                'label' => 'General Settings',
                'icon' => 'material-symbols:tune',
                'icon_filled' => 'material-symbols:tune',
                'href' => '/insider/settings/general',
                'route_name' => 'insider.settings.general',
                'guard_name' => 'insider',
                'permissions' => ['access general settings'],
                'order' => 1
            ]);
            // Sub-menu Site Management
            $subMenuSiteManagement = SidebarMenu::create([
                'parent_id' => $groupSettings->id,
                'key' => 'sub-settings-site',
                'label' => 'Site Management',
                'icon' => 'material-symbols:web', // Web often shared
                'icon_filled' => 'material-symbols:web',
                'href' => '/insider/settings/site',
                'route_name' => 'insider.settings.site',
                'guard_name' => 'insider',
                'permissions' => ['all site management'],
                'order' => 2
            ]);
                SidebarMenu::create([
                    'parent_id' => $subMenuSiteManagement->id,
                    'key' => 'sub-settings-site-settings',
                    'label' => 'Site Settings',
                    'icon' => 'material-symbols:settings-applications-outline',
                    'icon_filled' => 'material-symbols:settings-applications',
                    'href' => '/insider/settings/site/settings',
                    'route_name' => 'insider.settings.site.settings',
                    'guard_name' => 'insider',
                    'permissions' => ['access site settings'],
                    'order' => 1
                ]);
                SidebarMenu::create([
                    'parent_id' => $subMenuSiteManagement->id,
                    'key' => 'sub-settings-site-api',
                    'label' => 'API Settings',
                    'icon' => 'material-symbols:api',
                    'icon_filled' => 'material-symbols:api',
                    'href' => '/insider/settings/site/api',
                    'route_name' => 'insider.settings.site.api',
                    'guard_name' => 'insider',
                    'permissions' => ['access API settings'],
                    'order' => 2
                ]);
                SidebarMenu::create([
                    'parent_id' => $subMenuSiteManagement->id,
                    'key' => 'sub-settings-site-url',
                    'label' => 'URL Settings',
                    'icon' => 'material-symbols:link',
                    'icon_filled' => 'material-symbols:link',
                    'href' => '/insider/settings/site/url',
                    'route_name' => 'insider.settings.site.url',
                    'guard_name' => 'insider',
                    'permissions' => ['access url settings'],
                    'order' => 3
                ]);
                SidebarMenu::create([
                    'parent_id' => $subMenuSiteManagement->id,
                    'key' => 'sub-settings-site-auth',
                    'label' => 'Auth Settings',
                    'icon' => 'material-symbols:security',
                    'icon_filled' => 'material-symbols:security',
                    'href' => '/insider/settings/site/auth',
                    'route_name' => 'insider.settings.site.auth',
                    'guard_name' => 'insider',
                    'permissions' => ['access auth settings'],
                    'order' => 4
                ]);
                SidebarMenu::create([
                    'parent_id' => $subMenuSiteManagement->id,
                    'key' => 'sub-settings-site-payments',
                    'label' => 'Payments Settings',
                    'icon' => 'material-symbols:payments-outline-rounded',
                    'icon_filled' => 'material-symbols:payments-rounded',
                    'href' => '/insider/settings/site/payments',
                    'route_name' => 'insider.settings.site.payments',
                    'guard_name' => 'insider',
                    'permissions' => ['access payments settings'],
                    'order' => 5
                ]);
                SidebarMenu::create([
                    'parent_id' => $subMenuSiteManagement->id,
                    'key' => 'sub-settings-site-storage',
                    'label' => 'Storage Settings',
                    'icon' => 'material-symbols:folder-outline',
                    'icon_filled' => 'material-symbols:folder',
                    'href' => '/insider/settings/site/storage',
                    'route_name' => 'insider.settings.site.storage',
                    'guard_name' => 'insider',
                    'permissions' => ['access storage settings'],
                    'order' => 6
                ]);
                SidebarMenu::create([
                    'parent_id' => $subMenuSiteManagement->id,
                    'key' => 'sub-settings-site-custom',
                    'label' => 'Custom Settings',
                    'icon' => 'material-symbols:build-outline',
                    'icon_filled' => 'material-symbols:build',
                    'href' => '/insider/settings/site/custom',
                    'route_name' => 'insider.settings.site.custom',
                    'guard_name' => 'insider',
                    'permissions' => ['access custom settings'],
                    'order' => 7
                ]);
            // Sub-menu SEO Management
            SidebarMenu::create([
                'parent_id' => $groupSettings->id,
                'key' => 'sub-settings-seo',
                'label' => 'SEO Management',
                'icon' => 'material-symbols:search-check',
                'icon_filled' => 'material-symbols:search-check',
                'href' => '/insider/settings/seo',
                'route_name' => 'insider.settings.seo',
                'guard_name' => 'insider',
                'permissions' => ['access seo management'],
                'order' => 3
            ]);
            // Sub-menu Notifications
            SidebarMenu::create([
                'parent_id' => $groupSettings->id,
                'key' => 'sub-settings-notifications',
                'label' => 'Notifications',
                'icon' => 'material-symbols:notifications-outline',
                'icon_filled' => 'material-symbols:notifications',
                'href' => '/insider/settings/notifications',
                'route_name' => 'insider.settings.notifications',
                'guard_name' => 'insider',
                'permissions' => ['access notification management'],
                'order' => 4
            ]);


        // 12. Grup Developer Tools
        $groupDeveloper = SidebarMenu::create([
            'key' => 'group-developer-tools',
            'label' => 'Developer Tools',
            'title' => 'Developer Tools',
            'icon' => 'material-symbols:code',
            'icon_filled' => 'material-symbols:code',
            'guard_name' => 'insider',
            'permissions' => ['access all developer tools'],
            'order' => 120,
        ]);
            SidebarMenu::create([
                'parent_id' => $groupDeveloper->id,
                'key' => 'sub-developer-audit',
                'label' => 'Audit Log',
                'icon' => 'material-symbols:history',
                'icon_filled' => 'material-symbols:history',
                'href' => '/insider/developer/audit',
                'route_name' => 'insider.developer.audit',
                'guard_name' => 'insider',
                'permissions' => ['access audit log'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $groupDeveloper->id,
                'key' => 'sub-developer-maintenance',
                'label' => 'Maintenance Mode',
                'icon' => 'material-symbols:build-circle-outline',
                'icon_filled' => 'material-symbols:build-circle',
                'href' => '/insider/developer/maintenance',
                'route_name' => 'insider.developer.maintenance',
                'guard_name' => 'insider',
                'permissions' => ['access maintenance mode'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $groupDeveloper->id,
                'key' => 'sub-developer-backup',
                'label' => 'System Backup',
                'icon' => 'material-symbols:backup-outline',
                'icon_filled' => 'material-symbols:backup',
                'href' => '/insider/developer/backup',
                'route_name' => 'insider.developer.backup',
                'guard_name' => 'insider',
                'permissions' => ['run system backup'],
                'order' => 3
            ]);
            SidebarMenu::create([
                'parent_id' => $groupDeveloper->id,
                'key' => 'sub-developer-cache',
                'label' => 'Clear Cache',
                'icon' => 'material-symbols:cleaning-services-outline',
                'icon_filled' => 'material-symbols:cleaning-services',
                'href' => '/insider/developer/cache',
                'route_name' => 'insider.developer.cache',
                'guard_name' => 'insider',
                'permissions' => ['clear application cache'],
                'order' => 4
            ]);
            SidebarMenu::create([
                'parent_id' => $groupDeveloper->id,
                'key' => 'sub-developer-health',
                'label' => 'System Health',
                'icon' => 'material-symbols:monitor-heart-outline',
                'icon_filled' => 'material-symbols:monitor-heart',
                'href' => '/insider/developer/health',
                'route_name' => 'insider.developer.health',
                'guard_name' => 'insider',
                'permissions' => ['access system health check'],
                'order' => 5
            ]);
            SidebarMenu::create([
                'parent_id' => $groupDeveloper->id,
                'key' => 'sub-developer-docs',
                'label' => 'Documentation',
                'icon' => 'material-symbols:menu-book-outline',
                'icon_filled' => 'material-symbols:menu-book',
                'href' => '/insider/developer/docs',
                'route_name' => 'insider.developer.docs',
                'guard_name' => 'insider',
                'permissions' => ['access all documentation management'],
                'order' => 6
            ]);


        // 13. Grup Self Profile
        $groupSelfProfile = SidebarMenu::create([
            'key' => 'group-self-profile',
            'label' => 'My Profile',
            'title' => 'My Profile',
            'icon' => 'material-symbols:account-circle-outline',
            'icon_filled' => 'material-symbols:account-circle',
            'href' => '/insider/profile',
            'route_name' => 'insider.profile',
            'guard_name' => 'insider',
            'permissions' => ['access self profile'],
            'order' => 130,
        ]);
            SidebarMenu::create([
                'parent_id' => $groupSelfProfile->id,
                'key' => 'sub-self-update',
                'label' => 'Update Profile',
                'icon' => 'material-symbols:manage-accounts-outline',
                'icon_filled' => 'material-symbols:manage-accounts',
                'href' => '/insider/profile/update',
                'route_name' => 'insider.profile.update',
                'guard_name' => 'insider',
                'permissions' => ['update self profile'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $groupSelfProfile->id,
                'key' => 'sub-self-attendance',
                'label' => 'Attendance',
                'icon' => 'material-symbols:calendar-today-outline',
                'icon_filled' => 'material-symbols:calendar-today',
                'href' => '/insider/profile/attendance',
                'route_name' => 'insider.profile.attendance',
                'guard_name' => 'insider',
                'permissions' => ['access self attendance'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $groupSelfProfile->id,
                'key' => 'sub-self-wage',
                'label' => 'Wage',
                'icon' => 'material-symbols:attach-money',
                'icon_filled' => 'material-symbols:attach-money',
                'href' => '/insider/profile/wage',
                'route_name' => 'insider.profile.wage',
                'guard_name' => 'insider',
                'permissions' => ['access self wage'],
                'order' => 3
            ]);
            SidebarMenu::create([
                'parent_id' => $groupSelfProfile->id,
                'key' => 'sub-self-leave',
                'label' => 'Leave',
                'icon' => 'material-symbols:event-busy-outline',
                'icon_filled' => 'material-symbols:event-busy',
                'href' => '/insider/profile/leave',
                'route_name' => 'insider.profile.leave',
                'guard_name' => 'insider',
                'permissions' => ['access self leave'],
                'order' => 4
            ]);
            SidebarMenu::create([
                'parent_id' => $groupSelfProfile->id,
                'key' => 'sub-self-project',
                'label' => 'Project',
                'icon' => 'material-symbols:rocket-outline',
                'icon_filled' => 'material-symbols:rocket',
                'href' => '/insider/profile/project',
                'route_name' => 'insider.profile.project',
                'guard_name' => 'insider',
                'permissions' => ['access self project'],
                'order' => 5
            ]);


        // ----------------------------------------
        // --- VENDOR MENU (GUARD: 'vendor') ---
        // ----------------------------------------

        // 1. Dashboard Vendor
        $vendorDashboard = SidebarMenu::create([
            'key' => 'vendor-dashboard',
            'label' => 'Dashboard',
            'title' => 'Dashboard',
            'icon' => 'material-symbols:dashboard-outline',
            'icon_filled' => 'material-symbols:dashboard',
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
            'icon' => 'material-symbols:package-2-outline',
            'icon_filled' => 'material-symbols:package-2',
            'href' => '/vendor/products',
            'route_name' => 'vendor.products',
            'guard_name' => 'vendor',
            'permissions' => ['vendor product management'],
            'order' => 20,
        ]);
            SidebarMenu::create([
                'parent_id' => $vendorProduct->id,
                'key' => 'sub-vendor-products-list',
                'label' => 'All Products',
                'icon' => 'material-symbols:list-alt-outline',
                'icon_filled' => 'material-symbols:list-alt',
                'href' => '/vendor/products/list',
                'route_name' => 'vendor.products.list',
                'guard_name' => 'vendor',
                'permissions' => ['vendor view products'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorProduct->id,
                'key' => 'sub-vendor-products-categories',
                'label' => 'Categories',
                'icon' => 'material-symbols:category-outline',
                'icon_filled' => 'material-symbols:category',
                'href' => '/vendor/products/categories',
                'route_name' => 'vendor.products.categories',
                'guard_name' => 'vendor',
                'permissions' => ['vendor manage product categories'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorProduct->id,
                'key' => 'sub-vendor-products-attributes',
                'label' => 'Attributes',
                'icon' => 'material-symbols:tune',
                'icon_filled' => 'material-symbols:tune',
                'href' => '/vendor/products/attributes',
                'route_name' => 'vendor.products.attributes',
                'guard_name' => 'vendor',
                'permissions' => ['vendor manage product attributes'],
                'order' => 3
            ]);

        // 3. Order Management
        $vendorOrder = SidebarMenu::create([
            'key' => 'vendor-order-management',
            'label' => 'Order Management',
            'title' => 'Orders',
            'icon' => 'material-symbols:shopping-cart-outline',
            'icon_filled' => 'material-symbols:shopping-cart',
            'href' => '/vendor/orders',
            'route_name' => 'vendor.orders',
            'guard_name' => 'vendor',
            'permissions' => ['vendor order management'],
            'order' => 30,
        ]);
            SidebarMenu::create([
                'parent_id' => $vendorOrder->id,
                'key' => 'sub-vendor-orders-list',
                'label' => 'All Orders',
                'icon' => 'material-symbols:list-alt-outline',
                'icon_filled' => 'material-symbols:list-alt',
                'href' => '/vendor/orders/list',
                'route_name' => 'vendor.orders.list',
                'guard_name' => 'vendor',
                'permissions' => ['vendor view orders'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorOrder->id,
                'key' => 'sub-vendor-orders-refunds',
                'label' => 'Refunds',
                'icon' => 'material-symbols:currency-exchange',
                'icon_filled' => 'material-symbols:currency-exchange',
                'href' => '/vendor/orders/refunds',
                'route_name' => 'vendor.orders.refunds',
                'guard_name' => 'vendor',
                'permissions' => ['vendor process refunds'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorOrder->id,
                'key' => 'sub-vendor-orders-shipping',
                'label' => 'Shipping Labels',
                'icon' => 'material-symbols:local-shipping-outline',
                'icon_filled' => 'material-symbols:local-shipping',
                'href' => '/vendor/orders/shipping',
                'route_name' => 'vendor.orders.shipping',
                'guard_name' => 'vendor',
                'permissions' => ['vendor view shipping labels'],
                'order' => 3
            ]);

        // 4. Finance & Payouts
        $vendorFinance = SidebarMenu::create([
            'key' => 'vendor-finance-management',
            'label' => 'Finance & Payouts',
            'title' => 'Finance',
            'icon' => 'material-symbols:account-balance-wallet-outline',
            'icon_filled' => 'material-symbols:account-balance-wallet',
            'href' => '/vendor/finance',
            'route_name' => 'vendor.finance',
            'guard_name' => 'vendor',
            'permissions' => ['vendor finance management'],
            'order' => 40,
        ]);
            SidebarMenu::create([
                'parent_id' => $vendorFinance->id,
                'key' => 'sub-vendor-finance-earnings',
                'label' => 'Earnings',
                'icon' => 'material-symbols:attach-money-rounded',
                'icon_filled' => 'material-symbols:monetization-on',
                'href' => '/vendor/finance/earnings',
                'route_name' => 'vendor.finance.earnings',
                'guard_name' => 'vendor',
                'permissions' => ['vendor view earnings'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorFinance->id,
                'key' => 'sub-vendor-finance-payouts',
                'label' => 'Payouts',
                'icon' => 'material-symbols:payments-outline',
                'icon_filled' => 'material-symbols:payments',
                'href' => '/vendor/finance/payouts',
                'route_name' => 'vendor.finance.payouts',
                'guard_name' => 'vendor',
                'permissions' => ['vendor request payout'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorFinance->id,
                'key' => 'sub-vendor-finance-transactions',
                'label' => 'Transactions',
                'icon' => 'material-symbols:receipt-long-outline',
                'icon_filled' => 'material-symbols:receipt-long',
                'href' => '/vendor/finance/transactions',
                'route_name' => 'vendor.finance.transactions',
                'guard_name' => 'vendor',
                'permissions' => ['vendor view transaction history'],
                'order' => 3
            ]);

        // 5. Marketing & Promotions
        $vendorMarketing = SidebarMenu::create([
            'key' => 'vendor-marketing-management',
            'label' => 'Marketing & Promotions',
            'title' => 'Marketing',
            'icon' => 'material-symbols:percent-discount-outline',
            'icon_filled' => 'material-symbols:percent-discount',
            'href' => '/vendor/marketing',
            'route_name' => 'vendor.marketing',
            'guard_name' => 'vendor',
            'permissions' => ['vendor marketing management'],
            'order' => 50,
        ]);
            SidebarMenu::create([
                'parent_id' => $vendorMarketing->id,
                'key' => 'sub-vendor-marketing-promos',
                'label' => 'Promo Codes',
                'icon' => 'material-symbols:local-activity-outline',
                'icon_filled' => 'material-symbols:local-activity',
                'href' => '/vendor/marketing/promos',
                'route_name' => 'vendor.marketing.promos',
                'guard_name' => 'vendor',
                'permissions' => ['vendor create promo codes'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorMarketing->id,
                'key' => 'sub-vendor-marketing-ads',
                'label' => 'Ads Management',
                'icon' => 'material-symbols:ad-units-outline',
                'icon_filled' => 'material-symbols:ad-units',
                'href' => '/vendor/marketing/ads',
                'route_name' => 'vendor.marketing.ads',
                'guard_name' => 'vendor',
                'permissions' => ['vendor manage ads'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorMarketing->id,
                'key' => 'sub-vendor-marketing-reports',
                'label' => 'Reports',
                'icon' => 'material-symbols:analytics-outline',
                'icon_filled' => 'material-symbols:analytics',
                'href' => '/vendor/marketing/reports',
                'route_name' => 'vendor.marketing.reports',
                'guard_name' => 'vendor',
                'permissions' => ['vendor view marketing reports'],
                'order' => 3
            ]);

        // 6. Reviews & Support
        $vendorSupport = SidebarMenu::create([
            'key' => 'vendor-support-management',
            'label' => 'Reviews & Support',
            'title' => 'Support',
            'icon' => 'material-symbols:support-agent',
            'icon_filled' => 'material-symbols:support-agent',
            'guard_name' => 'vendor',
            'permissions' => ['vendor support management'],
            'order' => 60,
        ]);
            SidebarMenu::create([
                'parent_id' => $vendorSupport->id,
                'key' => 'sub-vendor-support-reviews',
                'label' => 'Reviews',
                'icon' => 'material-symbols:rate-review-outline',
                'icon_filled' => 'material-symbols:rate-review',
                'href' => '/vendor/support/reviews',
                'route_name' => 'vendor.support.reviews',
                'guard_name' => 'vendor',
                'permissions' => ['vendor view reviews'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorSupport->id,
                'key' => 'sub-vendor-support-tickets',
                'label' => 'Support Tickets',
                'icon' => 'material-symbols:confirmation-number-outline',
                'icon_filled' => 'material-symbols:confirmation-number',
                'href' => '/vendor/support/tickets',
                'route_name' => 'vendor.support.tickets',
                'guard_name' => 'vendor',
                'permissions' => ['vendor access support tickets'],
                'order' => 2
            ]);

        // 7. Team & Settings
        $vendorSettings = SidebarMenu::create([
            'key' => 'vendor-team-settings',
            'label' => 'Team & Settings',
            'title' => 'Settings',
            'icon' => 'material-symbols:settings-outline',
            'icon_filled' => 'material-symbols:settings',
            'guard_name' => 'vendor',
            'permissions' => ['vendor team and settings'],
            'order' => 70
        ]);
            SidebarMenu::create([
                'parent_id' => $vendorSettings->id,
                'key' => 'sub-vendor-settings-profile',
                'label' => 'Store Profile',
                'icon' => 'material-symbols:store-outline',
                'icon_filled' => 'material-symbols:store',
                'href' => '/vendor/settings/profile',
                'route_name' => 'vendor.settings.profile',
                'guard_name' => 'vendor',
                'permissions' => ['vendor update store profile'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorSettings->id,
                'key' => 'sub-vendor-settings-team',
                'label' => 'Team Members',
                'icon' => 'material-symbols:group-outline',
                'icon_filled' => 'material-symbols:group',
                'href' => '/vendor/settings/team',
                'route_name' => 'vendor.settings.team',
                'guard_name' => 'vendor',
                'permissions' => ['vendor manage team members'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorSettings->id,
                'key' => 'sub-vendor-settings-roles',
                'label' => 'Roles & Permissions',
                'icon' => 'material-symbols:lock-person-outline',
                'icon_filled' => 'material-symbols:lock-person',
                'href' => '/vendor/settings/roles',
                'route_name' => 'vendor.settings.roles',
                'guard_name' => 'vendor',
                'permissions' => ['vendor manage roles and permissions'],
                'order' => 3
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorSettings->id,
                'key' => 'sub-vendor-settings-store',
                'label' => 'Store Settings',
                'icon' => 'material-symbols:storefront-outline',
                'icon_filled' => 'material-symbols:storefront',
                'href' => '/vendor/settings/store',
                'route_name' => 'vendor.settings.store',
                'guard_name' => 'vendor',
                'permissions' => ['vendor manage store settings'],
                'order' => 4
            ]);
            SidebarMenu::create([
                'parent_id' => $vendorSettings->id,
                'key' => 'sub-vendor-settings-subscription',
                'label' => 'Subscription',
                'icon' => 'material-symbols:card-membership-outline',
                'icon_filled' => 'material-symbols:card-membership',
                'href' => '/vendor/settings/subscription',
                'route_name' => 'vendor.settings.subscription',
                'guard_name' => 'vendor',
                'permissions' => ['vendor change subscription'],
                'order' => 5
            ]);


        // ----------------------------------------
        // --- CLIENT MENU (GUARD: 'client') ---
        // ----------------------------------------

        // 1. Dashboard Client
        $clientDashboard = SidebarMenu::create([
            'key' => 'client-dashboard',
            'label' => 'Dashboard',
            'title' => 'Dashboard',
            'icon' => 'material-symbols:dashboard-outline',
            'icon_filled' => 'material-symbols:dashboard',
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
            'icon' => 'material-symbols:shopping-bag-outline',
            'icon_filled' => 'material-symbols:shopping-bag',
            'href' => '/client/orders',
            'route_name' => 'client.orders',
            'guard_name' => 'client',
            'permissions' => ['client order management'],
            'order' => 20,
        ]);
            SidebarMenu::create([
                'parent_id' => $clientOrder->id,
                'key' => 'sub-client-orders-list',
                'label' => 'All Orders',
                'icon' => 'material-symbols:list-alt-outline',
                'icon_filled' => 'material-symbols:list-alt',
                'href' => '/client/orders/list',
                'route_name' => 'client.orders.list',
                'guard_name' => 'client',
                'permissions' => ['client view orders'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $clientOrder->id,
                'key' => 'sub-client-orders-track',
                'label' => 'Track Order',
                'icon' => 'material-symbols:local-shipping-outline',
                'icon_filled' => 'material-symbols:local-shipping',
                'href' => '/client/orders/track',
                'route_name' => 'client.orders.track',
                'guard_name' => 'client',
                'permissions' => ['client track orders'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $clientOrder->id,
                'key' => 'sub-client-orders-refund',
                'label' => 'Request Refund',
                'icon' => 'material-symbols:currency-exchange',
                'icon_filled' => 'material-symbols:currency-exchange',
                'href' => '/client/orders/refund',
                'route_name' => 'client.orders.refund',
                'guard_name' => 'client',
                'permissions' => ['client request refund'],
                'order' => 3
            ]);

        // 3. Profile Management
        $clientProfile = SidebarMenu::create([
            'key' => 'client-profile-management',
            'label' => 'My Profile',
            'title' => 'Profile',
            'icon' => 'material-symbols:account-circle-outline',
            'icon_filled' => 'material-symbols:account-circle',
            'href' => '/client/profile',
            'route_name' => 'client.profile',
            'guard_name' => 'client',
            'permissions' => ['client profile management'],
            'order' => 30,
        ]);
            SidebarMenu::create([
                'parent_id' => $clientProfile->id,
                'key' => 'sub-client-profile-update',
                'label' => 'Update Profile',
                'icon' => 'material-symbols:manage-accounts-outline',
                'icon_filled' => 'material-symbols:manage-accounts',
                'href' => '/client/profile/update',
                'route_name' => 'client.profile.update',
                'guard_name' => 'client',
                'permissions' => ['client update profile'],
                'order' => 1
            ]);
            SidebarMenu::create([
                'parent_id' => $clientProfile->id,
                'key' => 'sub-client-profile-addresses',
                'label' => 'Addresses',
                'icon' => 'material-symbols:home-outline',
                'icon_filled' => 'material-symbols:home',
                'href' => '/client/profile/addresses',
                'route_name' => 'client.profile.addresses',
                'guard_name' => 'client',
                'permissions' => ['client manage addresses'],
                'order' => 2
            ]);
            SidebarMenu::create([
                'parent_id' => $clientProfile->id,
                'key' => 'sub-client-profile-payments',
                'label' => 'Payment Methods',
                'icon' => 'material-symbols:credit-card-outline',
                'icon_filled' => 'material-symbols:credit-card',
                'href' => '/client/profile/payments',
                'route_name' => 'client.profile.payments',
                'guard_name' => 'client',
                'permissions' => ['client manage payment methods'],
                'order' => 3
            ]);
            SidebarMenu::create([
                'parent_id' => $clientProfile->id,
                'key' => 'sub-client-profile-wishlist',
                'label' => 'Wishlist',
                'icon' => 'material-symbols:favorite-outline',
                'icon_filled' => 'material-symbols:favorite',
                'href' => '/client/profile/wishlist',
                'route_name' => 'client.profile.wishlist',
                'guard_name' => 'client',
                'permissions' => ['client view wishlists'],
                'order' => 4
            ]);

        // 4. Reviews
        $clientReview = SidebarMenu::create([
            'key' => 'client-review-management',
            'label' => 'My Reviews',
            'title' => 'Reviews',
            'icon' => 'material-symbols:star-outline',
            'icon_filled' => 'material-symbols:star',
            'href' => '/client/reviews',
            'route_name' => 'client.reviews',
            'guard_name' => 'client',
            'permissions' => ['client review management'],
            'order' => 40,
        ]);
            SidebarMenu::create([
                'parent_id' => $clientReview->id,
                'key' => 'sub-client-reviews-list',
                'label' => 'All Reviews',
                'icon' => 'material-symbols:list-alt-outline',
                'icon_filled' => 'material-symbols:list-alt',
                'href' => '/client/reviews/list',
                'route_name' => 'client.reviews.list',
                'guard_name' => 'client',
                'permissions' => ['client create review'],
                'order' => 1
            ]);

        // 5. Support
        $clientSupport = SidebarMenu::create([
            'key' => 'client-support-access',
            'label' => 'Support',
            'title' => 'Support',
            'icon' => 'material-symbols:support-agent',
            'icon_filled' => 'material-symbols:support-agent',
            'href' => '/client/support',
            'route_name' => 'client.support',
            'guard_name' => 'client',
            'permissions' => ['client support access'],
            'order' => 50,
        ]);
            SidebarMenu::create([
                'parent_id' => $clientSupport->id,
                'key' => 'sub-client-support-tickets',
                'label' => 'My Tickets',
                'icon' => 'material-symbols:confirmation-number-outline',
                'icon_filled' => 'material-symbols:confirmation-number',
                'href' => '/client/support/tickets',
                'route_name' => 'client.support.tickets',
                'guard_name' => 'client',
                'permissions' => ['client view support tickets'],
                'order' => 1
            ]);

        // 6. Subscriptions
        $clientSubscription = SidebarMenu::create([
            'key' => 'client-subscription-management',
            'label' => 'Subscriptions',
            'title' => 'Subscriptions',
            'icon' => 'material-symbols:card-membership-outline',
            'icon_filled' => 'material-symbols:card-membership',
            'href' => '/client/subscriptions',
            'route_name' => 'client.subscriptions',
            'guard_name' => 'client',
            'permissions' => ['client subscription management'],
            'order' => 60,
        ]);
            SidebarMenu::create([
                'parent_id' => $clientSubscription->id,
                'key' => 'sub-client-subscriptions-list',
                'label' => 'My Subscriptions',
                'icon' => 'material-symbols:list-alt-outline',
                'icon_filled' => 'material-symbols:list-alt',
                'href' => '/client/subscriptions/list',
                'route_name' => 'client.subscriptions.list',
                'guard_name' => 'client',
                'permissions' => ['client view subscriptions'],
                'order' => 1
            ]);
    }
}
