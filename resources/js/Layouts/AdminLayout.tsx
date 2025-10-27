// resources/js/Layouts/AdminLayout.tsx

import Sidebar from '@/Components/Admin/Sidebar/Sidebar';
import type { PageProps } from '@/types';
import { Icon } from '@iconify/react';
import { Link, usePage } from '@inertiajs/react';
import {
    Avatar,
    DropdownMenu,
    IconButton,
    Text,
    TextField,
} from '@radix-ui/themes';
import { ReactNode, useState } from 'react';

interface AdminLayoutProps {
    children: ReactNode;
    headerTitle?: string;
}

export default function AdminLayout({ children }: AdminLayoutProps) {
    const [isSidebarOpen, setSidebarOpen] = useState(true);

    interface AdminPageProps extends PageProps {
        pageTitle?: string;
    }

    const { props } = usePage<AdminPageProps>();
    const user = props.auth?.user;
    const pageTitle = props.pageTitle || 'Admin Panel';

    const toggleSidebar = () => setSidebarOpen((prev) => !prev);

    return (
        <div className="flex h-screen bg-gray-100 dark:bg-gray-900">
            <Sidebar
                isSidebarOpen={isSidebarOpen}
                toggleSidebar={toggleSidebar}
            />

            {/* Konten Utama */}
            <div className="flex flex-1 flex-col overflow-hidden">
                <header className="relative z-20 flex h-[65px] items-center justify-between px-6 py-2">
                    <div className="flex items-center gap-4">
                        <button
                            onClick={toggleSidebar}
                            className="text-gray-500 focus:text-gray-700 focus:outline-none dark:text-gray-400 dark:focus:text-gray-200"
                            aria-label="Toggle sidebar"
                        >
                            <Icon
                                icon={
                                    isSidebarOpen
                                        ? 'heroicons:bars-3-bottom-left-solid'
                                        : 'heroicons:bars-3-solid'
                                }
                                className="h-6 w-6"
                            />
                        </button>
                        <h1 className="text-3xl font-bold text-gray-800 dark:text-gray-100">
                            {pageTitle}
                        </h1>
                    </div>

                    {/* Kanan: Search, Icons, User Menu */}
                    <div className="flex items-center gap-3">
                        {/* Search */}
                        <div className="relative hidden md:block">
                            <TextField.Root
                                size="2"
                                placeholder="Search..."
                                // 6. Styling background putih bulat
                                className="!w-64 !rounded-full !bg-white !pl-10 !pr-4 !shadow-sm dark:!bg-gray-800"
                            >
                                <TextField.Slot>
                                    <Icon
                                        icon="heroicons:magnifying-glass-solid"
                                        className="h-4 w-4 text-gray-400"
                                    />
                                </TextField.Slot>
                            </TextField.Root>
                        </div>

                        {/* Icon Chat */}
                        <IconButton
                            radius="full" // 7. Styling background putih bulat
                            className="!bg-white !text-gray-500 !shadow-sm hover:!text-gray-700 dark:!bg-gray-800 dark:!text-gray-400 dark:hover:!text-gray-200"
                            variant="surface" // Gunakan surface agar background terlihat
                            size="2"
                        >
                            <Icon
                                icon="heroicons:chat-bubble-left-right-solid"
                                className="h-5 w-5"
                            />
                        </IconButton>

                        {/* Icon Lonceng (Notifikasi) */}
                        <IconButton
                            radius="full"
                            className="!bg-white !text-gray-500 !shadow-sm hover:!text-gray-700 dark:!bg-gray-800 dark:!text-gray-400 dark:hover:!text-gray-200"
                            variant="surface"
                            size="2"
                        >
                            <Icon
                                icon="heroicons:bell-solid"
                                className="h-5 w-5"
                            />
                        </IconButton>

                        {/* User Menu */}
                        <DropdownMenu.Root>
                            <DropdownMenu.Trigger>
                                {/* 8. Trigger dengan background putih bulat */}
                                <button className="flex items-center gap-2 rounded-full bg-white px-3 py-1.5 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <Avatar
                                        // Ganti fallback atau src jika perlu
                                        fallback={user?.name?.charAt(0) || '?'}
                                        src={user?.avatar_url} // Asumsi ada avatar_url
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
                                        className="hidden h-4 w-4 text-gray-500 md:block dark:text-gray-400"
                                    />
                                </button>
                            </DropdownMenu.Trigger>
                            <DropdownMenu.Content align="end">
                                <DropdownMenu.Item>Profile</DropdownMenu.Item>
                                <DropdownMenu.Item>Settings</DropdownMenu.Item>
                                <DropdownMenu.Separator />
                                {/* Gunakan Link Inertia method="post" untuk logout */}
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

                {/* Konten Halaman */}
                <main className="flex-1 overflow-y-auto bg-gray-100 dark:bg-gray-900">
                    {children}
                </main>
            </div>
        </div>
    );
}
