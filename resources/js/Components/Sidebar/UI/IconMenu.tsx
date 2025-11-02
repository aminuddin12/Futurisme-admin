import { cn } from '@/lib/utils';
import { Icon } from '@iconify/react';
import { Link } from '@inertiajs/react';
import * as Tooltip from '@radix-ui/react-tooltip';
import { motion } from 'framer-motion';
import CornerBadge from '../Badge/CornerBadge';
import { MenuItem } from './ListMenuItem';
import PopupMenu from './PopupMenu';

interface IconMenuProps {
    item: MenuItem;
}

export default function IconMenu({ item }: IconMenuProps) {
    const hasSubmenu = item.submenu && item.submenu.length > 0;

    // Cek aktif
    const isDirectlyActive = item.routeName && route().current(item.routeName);
    const isSubmenuActive =
        hasSubmenu &&
        item.submenu?.some((sub) => route().current(sub.routeName));
    const isActive = !!isDirectlyActive || !!isSubmenuActive;

    // Tombol trigger (bisa Link atau button)
    const TriggerButton = (
        <Link
            href={item.href || '#'}
            as={hasSubmenu ? 'button' : 'a'} // Gunakan button jika ada submenu, 'a' jika link
            className={cn(
                'relative flex h-9 w-9 items-center justify-center rounded-lg transition-colors duration-200',
                isActive
                    ? 'bg-emerald-500/20 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-300' // Latar solid
                    : 'text-gray-600 hover:bg-gray-200/50 dark:text-gray-400 dark:hover:bg-gray-700/30', // Outlined
            )}
        >
            <Icon
                icon={isActive ? item.iconFilled : item.icon}
                className="h-5 w-5"
            />
            {item.badge?.type === 'corner' && <CornerBadge />}
        </Link>
    );

    return (
        <Tooltip.Provider delayDuration={100}>
            <Tooltip.Root>
                <Tooltip.Trigger asChild>{TriggerButton}</Tooltip.Trigger>
                <Tooltip.Portal>
                    <Tooltip.Content
                        side="right"
                        align="start"
                        sideOffset={6}
                        className="z-[60] rounded-md border bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800"
                        asChild
                    >
                        <motion.div
                            initial={{ opacity: 0, x: -5 }}
                            animate={{ opacity: 1, x: 0 }}
                            transition={{ duration: 0.15 }}
                        >
                            {/* Tampilkan PopupMenu saat hover */}
                            <PopupMenu item={item} />
                        </motion.div>
                    </Tooltip.Content>
                </Tooltip.Portal>
            </Tooltip.Root>
        </Tooltip.Provider>
    );
}
