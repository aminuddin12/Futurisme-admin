import { Icon } from '@iconify/react';
import { Link, usePage } from '@inertiajs/react'; // <-- Ditambahkan usePage
import { Flex, Separator, Text } from '@radix-ui/themes';
import { AnimatePresence, motion } from 'framer-motion';
import React from 'react';

import { PageProps } from '../../types/page'; // <-- Ditambahkan PageProps
import GroupTrigger from './groupTrigger';
import { useSidebar } from './modeChanger';
import Trigger from './Trigger';
import MenuItemComponent, { MenuGroup } from './UI/MenuItem';

// --- BLOK DATA DUMMY DIHAPUS ---
// const menuData: MenuGroup[] = [ ...data statis... ];
// --- AKHIR BLOK DATA DUMMY ---

export default function FullMode() {
    const { expandedGroups, toggleGroup } = useSidebar();

    // --- TAMBAHAN BARU ---
    // Mengambil sidebarMenu dari props Inertia
    const { sidebarMenu } = usePage<PageProps>().props;
    // Menetapkan data dinamis ke variabel menuData, tambahkan fallback array kosong
    // Kita paksakan tipenya sebagai MenuGroup[] karena kita tahu datanya cocok
    const menuData: MenuGroup[] = (sidebarMenu as MenuGroup[]) || [];
    // --- AKHIR TAMBAHAN ---

    // Scrollbar kustom
    const customScrollbarHideCSS = {
        '&::-webkit-scrollbar': { display: 'none' },
        '-ms-overflow-style': 'none',
        'scrollbar-width': 'none',
    } as React.CSSProperties;

    return (
        <Flex direction="column" className="w-90 h-full">
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
                        {/* Filter(Boolean) ditambahkan untuk keamanan jika ada data null/undefined */}
                        {menuData.filter(Boolean).map((group) => (
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
                                                {/* --- INI PERBAIKANNYA --- */}
                                                {/* Menambahkan cek 'group.items &&'
                                                    Ini untuk menangani grup yang merupakan link (spt Dashboard)
                                                    yang mungkin memiliki 'items: []' atau 'items: undefined' dari service.
                                                    Juga filter(Boolean) untuk keamanan ekstra jika ada item yang null.
                                                */}
                                                {group.items &&
                                                    group.items
                                                        .filter(Boolean)
                                                        .map((item) => (
                                                            <MenuItemComponent
                                                                key={item.key}
                                                                item={item}
                                                            />
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
