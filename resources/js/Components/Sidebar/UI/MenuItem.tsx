import { cn } from '@/lib/utils';
import { Icon } from '@iconify/react';
import { Link } from '@inertiajs/react';
import { Flex, Text } from '@radix-ui/themes';
import { AnimatePresence, motion } from 'framer-motion';

import NumberBadge from '../Badge/NumberBadge';
import TextBadge from '../Badge/TextBadge';
import MenuTrigger from '../menuTrigger';
import { useSidebar } from '../modeChanger';
import { MenuItem } from './ListMenuItem'; // Impor tipe data
import SubMenuItemComponent from './SubMenuItem';

interface MenuItemProps {
    item: MenuItem;
}

export default function MenuItemComponent({ item }: MenuItemProps) {
    const { expandedMenus, toggleMenu } = useSidebar();
    const isOpen = expandedMenus.includes(item.key);
    const hasSubmenu = item.submenu && item.submenu.length > 0;

    const isDirectlyActive = item.routeName && route().current(item.routeName);
    const isSubmenuActive =
        hasSubmenu &&
        item.submenu?.some((sub) => route().current(sub.routeName));
    const isActive = !!isDirectlyActive || !!isSubmenuActive;

    // Tentukan elemen pembungkus: Link jika punya href, div jika hanya toggle
    const WrapperElement = hasSubmenu || !item.href ? 'div' : Link;
    const wrapperProps = hasSubmenu
        ? { onClick: () => toggleMenu(item.key) }
        : { href: item.href || '#' };

    return (
        <div className="flex flex-col">
            {/* PERBAIKAN ERROR NESTING:
        Wrapper (div/Link) hanya membungkus Ikon dan Teks.
        Badge dan Trigger (button) adalah SIBLING di dalam Flex.
      */}
            <Flex
                align="center"
                justify="between"
                className={cn(
                    'group mx-2 cursor-pointer rounded-lg px-3 py-2 transition-colors duration-200',
                    isActive
                        ? 'bg-emerald-100/80 dark:bg-emerald-900/50' // Latar aktif (soft)
                        : 'hover:bg-gray-200/50 dark:hover:bg-gray-700/30', // Hover
                    isSubmenuActive &&
                        !isOpen &&
                        'bg-gray-100 dark:bg-gray-800', // Parent dari submenu aktif (tapi tertutup)
                )}
            >
                {/* Bagian Kiri (Link/Button) */}
                <WrapperElement
                    {...wrapperProps}
                    className="flex min-w-0 flex-1 items-center gap-2.5" // flex-1 dan min-w-0 untuk truncate
                >
                    <Icon
                        icon={isActive ? item.iconFilled : item.icon}
                        className={cn(
                            'h-4 w-4 shrink-0',
                            isActive
                                ? 'text-emerald-500' // Ikon aktif
                                : 'text-gray-500 dark:text-gray-400', // Ikon inaktif
                        )}
                    />
                    <Text
                        size="2" // Radix size 2
                        weight={isActive ? 'medium' : 'regular'}
                        truncate
                        className={cn(
                            'text-xs', // Ukuran font
                            isActive
                                ? 'text-emerald-700 dark:text-emerald-300' // Teks aktif
                                : 'text-gray-700 group-hover:text-gray-900 dark:text-gray-300 dark:group-hover:text-gray-100', // Teks inaktif
                        )}
                    >
                        {item.label}
                    </Text>
                </WrapperElement>

                {/* Bagian Kanan (Badge & Trigger) */}
                <Flex align="center" gap="1.5" className="flex-shrink-0">
                    {item.badge?.type === 'text' && (
                        <TextBadge
                            text={item.badge.content as string}
                            color={item.badge.color || 'emerald'}
                        />
                    )}
                    {item.badge?.type === 'number' && (
                        <NumberBadge
                            count={item.badge.content as number}
                            color={item.badge.color || 'gray'}
                        />
                    )}
                    {hasSubmenu && (
                        <MenuTrigger
                            isOpen={isOpen}
                            onClick={() => toggleMenu(item.key)}
                        />
                    )}
                </Flex>
            </Flex>

            {/* Render Submenu */}
            <AnimatePresence>
                {hasSubmenu && isOpen && (
                    <motion.div
                        initial={{ height: 0, opacity: 0 }}
                        animate={{ height: 'auto', opacity: 1 }}
                        exit={{ height: 0, opacity: 0 }}
                        transition={{ duration: 0.2 }}
                        className="relative mt-0.5 overflow-hidden pl-8 pr-2" // Indentasi submenu
                    >
                        {/* Garis Vertikal Utama */}
                        <div className="absolute bottom-1 left-[27px] top-0 w-px bg-gray-200 dark:bg-gray-700"></div>

                        {item.submenu?.map((subItem, index) => (
                            <SubMenuItemComponent
                                key={subItem.key}
                                item={subItem}
                                isLast={
                                    index === (item.submenu?.length ?? 0) - 1
                                }
                            />
                        ))}
                    </motion.div>
                )}
            </AnimatePresence>
        </div>
    );
}
