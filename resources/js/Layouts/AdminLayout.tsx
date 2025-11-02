import SidebarLayout from '@/Layouts/SidebarLayout';
import { Icon } from '@iconify/react';
import { Link, usePage } from '@inertiajs/react';
import { Avatar, DropdownMenu, Text } from '@radix-ui/themes';
import { ReactNode } from 'react';

interface AdminLayoutProps {
    children: ReactNode;
}

export default function AdminLayout({ children }: AdminLayoutProps) {
    const { props } = usePage();
    const user = props.auth?.user;
    const pageTitle = props.pageTitle || 'Admin Panel';

    // State sidebar (isSidebarOpen, toggleSidebar) sekarang DIKELOLA OLEH SidebarLayout

    return (
        // 2. Bungkus semua dengan SidebarLayout
        <SidebarLayout>
            {/* SidebarLayout akan merender Sidebar di kiri dan children (div ini) di kanan.
              Kita tidak perlu merender <Sidebar> secara manual lagi.
            */}

            {/* Ini adalah children dari SidebarLayout (konten utama) */}
            <div className="flex flex-1 flex-col overflow-hidden">
                <header
                    // Header ini sekarang adalah bagian dari konten utama
                    className="relative z-20 flex h-[65px] flex-shrink-0 items-center justify-between border-b border-white/20 bg-white/30 px-6 py-2 backdrop-blur-sm dark:border-gray-800/50 dark:bg-gray-900/30"
                >
                    {/* Kiri: Judul Halaman */}
                    <div className="flex items-center gap-4">
                        <h1 className="text-xl font-semibold text-gray-800 dark:text-gray-100">
                            {pageTitle}
                        </h1>
                    </div>

                    {/* Kanan: Search, Icons, User Menu */}
                    <div className="flex items-center gap-3">
                        {/* User Menu */}
                        <DropdownMenu.Root>
                            <DropdownMenu.Trigger>
                                <button className="flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1.5 shadow-sm transition-colors hover:bg-gray-200 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">
                                    <Avatar
                                        fallback={user?.name?.charAt(0) || '?'}
                                        src={user?.avatar_url}
                                        radius="full"
                                        size="2"
                                    />
                                    <div className="hidden text-left md:block">
                                        <Text
                                            size="2"
                                            weight="medium"
                                            className="block text-gray-800 dark:text-gray-100"
                                        >
                                            {user?.name || 'User Name'}
                                        </Text>
                                        <Text
                                            size="1"
                                            className="block text-gray-500 dark:text-gray-400"
                                        >
                                            {user?.email || 'user@example.com'}
                                        </Text>
                                    </div>
                                    <Icon
                                        icon="heroicons:chevron-down-solid"
                                        className="hidden h-4 w-4 text-gray-500 dark:text-gray-400 md:block"
                                    />
                                </button>
                            </DropdownMenu.Trigger>
                            <DropdownMenu.Content align="end">
                                <DropdownMenu.Item asChild>
                                    <Link href={route('admin.profile')}>
                                        Profile
                                    </Link>
                                </DropdownMenu.Item>
                                <DropdownMenu.Item>Settings</DropdownMenu.Item>
                                <DropdownMenu.Separator />
                                <DropdownMenu.Item color="red" asChild>
                                    <Link
                                        href={route('logout')}
                                        method="post"
                                        as="button"
                                    >
                                        Logout
                                    </Link>
                                </DropdownMenu.Item>
                            </DropdownMenu.Content>
                        </DropdownMenu.Root>
                    </div>
                </header>

                <main className="flex-1 overflow-y-auto bg-transparent p-6">
                    {children}
                </main>
            </div>
        </SidebarLayout>
    );
}
