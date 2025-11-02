import { Icon } from '@iconify/react';
import { Link } from '@inertiajs/react';
import { Flex, Separator, Text } from '@radix-ui/themes';
import { AnimatePresence, motion } from 'framer-motion';
import React from 'react';

import GroupTrigger from './groupTrigger';
import { useSidebar } from './modeChanger';
import Trigger from './Trigger';
import MenuItemComponent, { MenuGroup } from './UI/MenuItem';

// Data dummy (ganti dengan data asli Anda)
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
                badge: { type: 'number', content: 12, color: 'gray' },
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
    // ... etc
];

export default function FullMode() {
    const { expandedGroups, toggleGroup } = useSidebar();

    // Scrollbar kustom
    const customScrollbarHideCSS = {
        '&::-webkit-scrollbar': { display: 'none' },
        '-ms-overflow-style': 'none',
        'scrollbar-width': 'none',
    } as React.CSSProperties;

    return (
        <Flex direction="column" className="h-full w-60">
            {' '}
            {/* Lebar full mode */}
            {/* Header */}
            <Flex
                align="center"
                justify="between"
                className="h-[65px] flex-shrink-0 px-4"
            >
                <Link href="/" className="flex flex-1 items-center gap-2">
                    <Flex
                        align="center"
                        justify="center"
                        className="flex-shrink-0 rounded-lg bg-gray-800 p-1.5 dark:bg-gray-700"
                    >
                        <Icon
                            icon="heroicons:squares-2x2-solid"
                            className="h-5 w-5 text-white"
                        />
                    </Flex>
                     <span className="text-lg font-bold text-black dark:text-white">
                         Fxology
                     </span>
                </Link>
                <Trigger />
            </Flex>
            <Separator className="dark:!bg-gray-700" />
            {/* Navigasi */}
            <div className="no-scrollbar flex-1 overflow-y-auto">
                <nav className="mt-4 flex flex-col justify-between">
                    <div>
                        {menuData.map((group) => (
                            <div key={group.key} className="mb-3">
                                <Flex
                                    align="center"
                                    justify="between"
                                    className="mb-1 px-4"
                                >
                                    <Text
                                        size="1"
                                        className="text-[0.65rem] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400"
                                    >
                                        {group.title}
                                    </Text>
                                    <GroupTrigger
                                        isOpen={expandedGroups.includes(
                                            group.key,
                                        )}
                                        onClick={() => toggleGroup(group.key)}
                                    />
                                </Flex>
                                <AnimatePresence>
                                    {expandedGroups.includes(group.key) && (
                                        <motion.div
                                            initial={{ height: 0, opacity: 0 }}
                                            animate={{
                                                height: 'auto',
                                                opacity: 1,
                                            }}
                                            exit={{ height: 0, opacity: 0 }}
                                            transition={{ duration: 0.2 }}
                                            className="overflow-hidden"
                                        >
                                            <Flex direction="column" gap="0.5">
                                                {group.items.map((item) => (
                                                    <MenuItemComponent key={item.key} item={item} />
                                                ))}
                                            </Flex>
                                        </motion.div>
                                    )}
                                </AnimatePresence>
                            </div>
                        ))}
                    </div>
                </nav>
            </div>
        </Flex>
    );
}
