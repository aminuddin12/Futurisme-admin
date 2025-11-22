import { cn } from '@/lib/utils';
import { Icon } from '@iconify/react';
import { Link } from '@inertiajs/react';
import { Flex, Text } from '@radix-ui/themes';
import { AnimatePresence, motion } from 'framer-motion';

import NumberBadge from '../Badge/NumberBadge';
import TextBadge from '../Badge/TextBadge';
import MenuTrigger from '../menuTrigger';
import { useSidebar } from '../modeChanger';
// import { MenuItem } from './ListMenuItem'; // Opsional: Bisa di-uncomment jika tipe data sudah sesuai
import SubMenuItemComponent from './SubMenuItem';

// Definisikan interface yang lebih longgar untuk menangani snake_case dari Laravel
interface MenuItemProps {
    item: {
        key: string;
        label: string;
        href?: string;

        // Support kedua format casing
        icon?: string;

        iconFilled?: string; // CamelCase
        icon_filled?: string; // Snake_case (dari DB)

        routeName?: string; // CamelCase
        route_name?: string; // Snake_case (dari DB)

        badge?: {
            type: string;
            content: string | number;
            color?: string;
        };
        submenu?: any[];
    };
}

export default function MenuItemComponent({ item }: MenuItemProps) {
    const { expandedMenus, toggleMenu } = useSidebar();

    // --- 1. NORMALISASI DATA (FIX BUG) ---
    // Ambil data dari property snake_case jika camelCase tidak ada
    const routeName = item.routeName || item.route_name;
    const iconFilled = item.iconFilled || item.icon_filled;
    const iconNormal = item.icon;
    // -------------------------------------

    const isOpen = expandedMenus.includes(item.key);
    const hasSubmenu = item.submenu && item.submenu.length > 0;

    // --- 2. PERBAIKAN LOGIKA ACTIVE ---
    // Gunakan routeName yang sudah dinormalisasi
    const isDirectlyActive = routeName && route().current(routeName);

    const isSubmenuActive =
        hasSubmenu &&
        item.submenu?.some((sub) => {
            // Handle submenu route_name juga jika perlu
            const subRoute = sub.routeName || sub.route_name;
            return subRoute && route().current(subRoute);
        });

    const isActive = !!isDirectlyActive || !!isSubmenuActive;

    // Tentukan elemen pembungkus: Link jika punya href, div jika hanya toggle
    const WrapperElement = hasSubmenu || !item.href ? 'div' : Link;
    const wrapperProps = hasSubmenu
        ? { onClick: () => toggleMenu(item.key) }
        : { href: item.href || '#' };

    return (
        <div className="flex flex-col">
            <Flex
                align="center"
                justify="between"
                className={cn(
                    'group mx-2 cursor-pointer rounded-lg px-3 py-2 transition-colors duration-200',
                    isActive
                        ? 'bg-emerald-100/80 dark:bg-emerald-900/50'
                        : 'hover:bg-gray-200/50 dark:hover:bg-gray-700/30',
                    isSubmenuActive &&
                        !isOpen &&
                        'bg-gray-100 dark:bg-gray-800',
                )}
            >
                {/* Bagian Kiri (Link/Button) */}
                <WrapperElement
                    {...wrapperProps}
                    className="flex min-w-0 flex-1 items-center gap-2.5"
                >
                    {/* --- 3. RENDER IKON DENGAN DATA YANG BENAR --- */}
                    <Icon
                        icon={isActive && iconFilled ? iconFilled : iconNormal}
                        className={cn(
                            'h-4 w-4 shrink-0',
                            isActive
                                ? 'text-emerald-500'
                                : 'text-gray-500 dark:text-gray-400',
                        )}
                    />

                    <Text
                        size="2"
                        weight={isActive ? 'medium' : 'regular'}
                        truncate
                        className={cn(
                            'text-xs',
                            isActive
                                ? 'text-emerald-700 dark:text-emerald-300'
                                : 'text-gray-700 group-hover:text-gray-900 dark:text-gray-300 dark:group-hover:text-gray-100',
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
                        className="relative mt-0.5 overflow-hidden pl-8 pr-2"
                    >
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
