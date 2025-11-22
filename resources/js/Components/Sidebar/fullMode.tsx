import { Icon } from '@iconify/react';
import { Link, usePage } from '@inertiajs/react';
import { Flex, Separator, Text } from '@radix-ui/themes';
import { AnimatePresence, motion } from 'framer-motion';

import { PageProps } from '../../types/page';
import GroupTrigger from './groupTrigger';
import { useSidebar } from './modeChanger';
import Trigger from './Trigger';
import MenuItemComponent, { MenuGroup } from './UI/MenuItem';

export default function FullMode() {
    const { expandedGroups, toggleGroup } = useSidebar();
    const { sidebarMenu } = usePage<PageProps>().props;

    // Pastikan data menu ada dan sesuai format
    const menuData: MenuGroup[] = (sidebarMenu as MenuGroup[]) || [];

    return (
        <Flex direction="column" className="w-90 h-full">
            {/* Header Sidebar */}
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

            {/* Area Navigasi (Scrollable) */}
            <div className="no-scrollbar flex-1 overflow-y-auto">
                <nav className="mt-4 flex flex-col justify-between">
                    <div>
                        {menuData.filter(Boolean).map((group) => (
                            <div key={group.key} className="mb-3">
                                {/* Judul Group & Trigger Collapse */}
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

                                {/* List Menu dalam Group (Animasi Collapse) */}
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
                                                {group.items &&
                                                    group.items
                                                        .filter(Boolean)
                                                        .map((item) => {
                                                            // --- LOGIKA PERBAIKAN DI SINI ---

                                                            // 1. Cek apakah rute saat ini sesuai dengan menu ini
                                                            const isActive =
                                                                route().current(
                                                                    item.route_name,
                                                                );

                                                            // 2. Tentukan ikon:
                                                            // Jika aktif DAN punya icon_filled, pakai icon_filled.
                                                            // Jika tidak, pakai icon biasa.
                                                            const iconToDisplay =
                                                                isActive &&
                                                                item.icon_filled
                                                                    ? item.icon_filled
                                                                    : item.icon;

                                                            // 3. Clone item dengan ikon yang sudah dimanipulasi
                                                            // agar MenuItemComponent merender ikon yang tepat
                                                            const modifiedItem =
                                                                {
                                                                    ...item,
                                                                    icon: iconToDisplay,
                                                                };

                                                            return (
                                                                <MenuItemComponent
                                                                    key={
                                                                        item.key
                                                                    }
                                                                    item={
                                                                        modifiedItem
                                                                    }
                                                                />
                                                            );
                                                        })}
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
