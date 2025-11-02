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
        key: 'group-menu',
        title: 'Menu',
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
                key: 'menu-ai',
                label: 'AI Assistant',
                icon: 'heroicons:cpu-chip',
                iconFilled: 'heroicons:cpu-chip-solid',
                badge: { type: 'corner', content: '' },
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
                badge: { type: 'corner', content: '' },
                submenu: [
                    {
                        key: 'sub-prod',
                        label: 'Produk',
                        href: '#',
                        routeName: 'admin.ecommerce.products',
                    },
                    {
                        key: 'sub-order',
                        label: 'Pesanan',
                        href: '#',
                        routeName: 'admin.ecommerce.orders',
                    },
                ],
            },
            {
                key: 'menu-cal',
                label: 'Calendar',
                icon: 'heroicons:calendar-days',
                iconFilled: 'heroicons:calendar-days-solid',
                href: '#',
                routeName: 'admin.calendar',
            },
        ],
    },
    {
        key: 'group-support',
        title: 'Support',
        items: [
            {
                key: 'menu-ticket',
                label: 'Support Ticket',
                icon: 'heroicons:headset',
                iconFilled: 'heroicons:headset-solid',
                badge: { type: 'corner', content: '' },
                submenu: [
                    {
                        key: 'sub-list',
                        label: 'Ticket List',
                        href: '#',
                        routeName: 'admin.tickets.list',
                    },
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
        ],
    },
    {
        key: 'group-Site',
        title: 'Site Settings',
        items: [
            {
                key: 'web-settings',
                label: 'Website Settings',
                icon: 'heroicons:cog-6-tooth',
                iconFilled: 'heroicons:cog-6-tooth-solid',
                href: route('admin.settings'),
                routeName: 'settings',
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
