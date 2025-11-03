import { Icon } from '@iconify/react';
import { Link } from '@inertiajs/react';
import * as Tooltip from '@radix-ui/react-tooltip';
import { Flex, Separator } from '@radix-ui/themes';
import React from 'react';

import Trigger from '../Sidebar/Trigger';
import { useSidebar } from './modeChanger';
import IconMenu from './UI/IconMenu';
import { MenuGroup } from './UI/ListMenuItem';

// Data yang sama dengan fullMode
const menuData: MenuGroup[] = [
    {
        key: 'group-main',
        title: 'Main',
        items: [
            {
                key: 'menu-dash',
                label: 'Dashboard',
                icon: 'heroicons:squares-2x2',
                iconFilled: 'heroicons:squares-2x2-solid',
                href: route('admin.dashboard'),
                routeName: 'admin.dashboard',
            },
            {
                key: 'menu-analytics',
                label: 'Analytics',
                icon: 'heroicons:chart-pie',
                iconFilled: 'heroicons:chart-pie-solid',
                href: '#',
                routeName: 'admin.analytics',
            },
            {
                key: 'menu-cal',
                label: 'Calendar',
                icon: 'heroicons:calendar-days',
                iconFilled: 'heroicons:calendar-days-solid',
                href: '#',
                routeName: 'admin.calendar',
            },
            {
                key: 'menu-files',
                label: 'File Manager',
                icon: 'heroicons:folder',
                iconFilled: 'heroicons:folder-solid',
                href: '#',
                routeName: 'admin.files',
            },
        ],
    },
    {
        key: 'group-apps',
        title: 'Apps',
        items: [
            {
                key: 'menu-ai',
                label: 'AI Assistant',
                icon: 'heroicons:cpu-chip',
                iconFilled: 'heroicons:cpu-chip-solid',
                badge: { type: 'text', content: 'New', color: 'emerald' },
                submenu: [
                    {
                        key: 'sub-chat',
                        label: 'Chat',
                        href: route('admin.chat'),
                        routeName: 'admin.chat',
                    },
                    {
                        key: 'sub-img',
                        label: 'Image Gen',
                        href: '#',
                        routeName: 'admin.ai.image',
                    },
                ],
            },
            {
                key: 'menu-ecom',
                label: 'E-commerce',
                icon: 'heroicons:shopping-cart',
                iconFilled: 'heroicons:shopping-cart-solid',
                badge: { type: 'number', content: 5, color: 'red' },
                submenu: [
                    {
                        key: 'sub-prod',
                        label: 'Products',
                        href: '#',
                        routeName: 'admin.ecommerce.products',
                    },
                    {
                        key: 'sub-order',
                        label: 'Orders',
                        href: '#',
                        routeName: 'admin.ecommerce.orders',
                    },
                    {
                        key: 'sub-cust',
                        label: 'Customers',
                        href: '#',
                        routeName: 'admin.ecommerce.customers',
                    },
                    {
                        key: 'sub-report',
                        label: 'Reports',
                        href: '#',
                        routeName: 'admin.ecommerce.reports',
                    },
                ],
            },
            {
                key: 'menu-blog',
                label: 'Blog',
                icon: 'heroicons:pencil-square',
                iconFilled: 'heroicons:pencil-square-solid',
                submenu: [
                    { key: 'sub-posts', label: 'Posts', href: '#', routeName: 'admin.blog.posts' },
                    { key: 'sub-cat', label: 'Categories', href: '#', routeName: 'admin.blog.categories' },
                    { key: 'sub-tags', label: 'Tags', href: '#', routeName: 'admin.blog.tags' },
                ],
            },
            {
                key: 'menu-email',
                label: 'Email',
                icon: 'heroicons:envelope',
                iconFilled: 'heroicons:envelope-solid',
                href: '#',
                routeName: 'admin.email',
            },
            {
                key: 'menu-ticket',
                label: 'Support Ticket',
                icon: 'heroicons:ticket',
                iconFilled: 'heroicons:ticket-solid',
                badge: { type: 'number', content: 12, color: 'gray' },
                href: '#',
                routeName: 'admin.tickets',
            },
        ],
    },
    {
        key: 'group-management',
        title: 'Management',
        items: [
            {
                key: 'menu-users',
                label: 'Insiders Management',
                icon: 'heroicons:users',
                iconFilled: 'heroicons:users-solid',
                submenu: [
                    { key: 'sub-ulist', label: 'User List', href: '#', routeName: 'admin.users.list' },
                    { key: 'sub-roles', label: 'Roles & Permissions', href: '#', routeName: 'admin.users.roles' },
                    { key: 'sub-groups', label: 'Groups', href: '#', routeName: 'admin.users.groups' },
                    { key: 'attendance', label: 'Attendance', href: '#', routeName: 'admin.users.attendance' },
                ],
            },
            {
                key: 'menu-customers',
                label: 'Customers Management',
                icon: 'heroicons:face-smile',
                iconFilled: 'heroicons:face-smile-solid',
                href: '#',
                routeName: 'admin.customers',
            },
            {
                key: 'menu-departments',
                label: 'Department Management',
                icon: 'heroicons:building-office',
                iconFilled: 'heroicons:building-office-solid',
                href: '#',
                routeName: 'admin.departments',
            },
            {
                key: 'menu-teams',
                label: 'Team Management',
                icon: 'heroicons:user-group',
                iconFilled: 'heroicons:user-group-solid',
                href: '#',
                routeName: 'admin.teams',
            },
            {
                key: 'menu-projects',
                label: 'Project Management',
                icon: 'heroicons:briefcase',
                iconFilled: 'heroicons:briefcase-solid',
                href: '#',
                routeName: 'admin.projects',
            },
        ],
    },
    {
        key: 'group-docs',
        title: 'Documentation',
        items: [
            {
                key: 'menu-docs-start',
                label: 'Getting Started',
                icon: 'heroicons:rocket-launch',
                iconFilled: 'heroicons:rocket-launch-solid',
                href: '#',
                routeName: 'admin.docs.start',
            },
            {
                key: 'menu-docs-guides',
                label: 'Guides',
                icon: 'heroicons:book-open',
                iconFilled: 'heroicons:book-open-solid',
                submenu: [
                    { key: 'sub-guide-auth', label: 'Authentication', href: '#', routeName: 'admin.docs.guides.auth' },
                    { key: 'sub-guide-crud', label: 'CRUD Operations', href: '#', routeName: 'admin.docs.guides.crud' },
                ],
            },
            {
                key: 'menu-docs-api',
                label: 'API Reference',
                icon: 'heroicons:code-bracket-square',
                iconFilled: 'heroicons:code-bracket-square-solid',
                href: '#',
                routeName: 'admin.docs.api',
            },
            {
                key: 'menu-docs-settings',
                label: 'Documentation Settings',
                icon: 'heroicons:cog-8-tooth',
                iconFilled: 'heroicons:cog-8-tooth-solid',
                href: '#',
                routeName: 'admin.docs.settings',
            },
        ],
    },
    {
        key: 'group-settings',
        title: 'Settings',
        items: [
            {
                key: 'web-settings',
                label: 'Website Settings',
                icon: 'heroicons:cog-6-tooth',
                iconFilled: 'heroicons:cog-6-tooth-solid',
                href: route('admin.settings'),
                routeName: 'admin.settings',
            },
            {
                key: 'menu-logs',
                label: 'System Logs',
                icon: 'heroicons:document-text',
                iconFilled: 'heroicons:document-text-solid',
                href: '#',
                routeName: 'admin.logs',
            },
            {
                key: 'profile-settings',
                label: 'Profile Settings',
                icon: 'heroicons:user-circle',
                iconFilled: 'heroicons:user-circle-solid',
                href: route('admin.profile'),
                routeName: 'admin.profile',
            },
        ],
    },
];

export default function IconMode() {
    return (
        <Flex direction="column" className="h-full w-[72px]">
            {' '}
            {/* Lebar icon mode */}
            {/* Header: Trigger untuk expand */}
            <Flex align="center" justify="center" className="h-[65px] flex-shrink-0">
                <Trigger />
            </Flex>
            <Separator className="dark:!bg-gray-700" />
            {/* Navigasi */}
            <div className="no-scrollbar flex-1 overflow-y-auto">
                <nav className="mt-4 flex flex-col justify-between">
                    <Flex
                        direction="column"
                        align="center"
                        gap="1"
                        className="px-2"
                    >
                        {menuData.map((group, index) => (
                            <React.Fragment key={group.key}>
                                {index > 0 && (
                                    <Separator className="mx-2 my-2 dark:!bg-gray-700" />
                                )}
                                {group.items.map((item) => (
                                    <IconMenu key={item.key} item={item} />
                                ))}
                            </React.Fragment>
                        ))}
                    </Flex>
                </nav>
            </div>
        </Flex>
    );
}
