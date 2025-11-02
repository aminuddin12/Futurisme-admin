import MenuTrigger from '@/Components/Sidebar/menuTrigger';
import { useSidebar } from '@/Components/Sidebar/modeChanger';
import { cn } from '@/lib/utils';
import { Icon } from '@iconify/react';
import { Link } from '@inertiajs/react';
import { Badge, Text } from '@radix-ui/themes';
import { AnimatePresence, motion } from 'framer-motion';

export interface MenuItem {
    key: string;
    label: string;
    icon: string;
    iconFilled: string;
    href?: string;
    routeName?: string;
    badge?: {
        type: 'text' | 'number' | 'corner';
        content: string | number;
        color?:
            | 'gray'
            | 'red'
            | 'green'
            | 'blue'
            | 'yellow'
            | 'orange'
            | 'purple'
            | 'pink'
            | 'brown'
            | 'cyan'
            | 'emerald';
    };
    submenu?: SubMenuItem[];
}

export interface SubMenuItem {
    key: string;
    label: string;
    href: string;
    routeName: string;
}

export interface MenuGroup {
    key: string;
    title: string;
    items: MenuItem[];
}

export default function ListMenuItem({ item }: { item: MenuItem }) {
    const { expandedMenus, toggleMenu } = useSidebar();
    const hasSubmenu = item.submenu && item.submenu.length > 0;
    const isOpen = hasSubmenu && expandedMenus.includes(item.key);

    const isActiveDirect = item.routeName && route().current(item.routeName);
    const isSubmenuActive =
        hasSubmenu &&
        item.submenu?.some((sub) => route().current(sub.routeName));

    const linkClasses = cn(
        'flex items-center justify-between mx-2 rounded-lg px-3 py-2 transition-colors duration-200 cursor-pointer group',
        isActiveDirect || (isSubmenuActive && !isOpen)
            ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300'
            : 'text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700',
    );

    const LinkContent = (
        <>
            <div className="flex items-center gap-2">
                <Icon
                    icon={
                        isActiveDirect || isSubmenuActive
                            ? item.iconFilled
                            : item.icon
                    }
                    className="h-5 w-5 shrink-0"
                />
                <span className="text-sm font-medium">{item.label}</span>
            </div>
            <div className="flex items-center gap-1.5">
                {item.badge && item.badge.type !== 'corner' && (
                    <Badge
                        color={item.badge.color as any}
                        variant="soft"
                        size="1"
                    >
                        {item.badge.content}
                    </Badge>
                )}
                {hasSubmenu && (
                    <MenuTrigger
                        isOpen={isOpen}
                        onClick={() => toggleMenu(item.key)}
                    />
                )}
            </div>
        </>
    );

    return (
        <div>
            <div
                onClick={() => (hasSubmenu ? toggleMenu(item.key) : null)}
                className={linkClasses}
            >
                {hasSubmenu ? (
                    <div className="flex w-full items-center justify-between">
                        {LinkContent}
                    </div>
                ) : (
                    <Link
                        href={item.href || '#'}
                        className="flex w-full items-center justify-between"
                    >
                        {LinkContent}
                    </Link>
                )}
            </div>

            <AnimatePresence>
                {isOpen && (
                    <motion.div
                        initial={{ height: 0, opacity: 0 }}
                        animate={{ height: 'auto', opacity: 1 }}
                        exit={{ height: 0, opacity: 0 }}
                        transition={{ duration: 0.2 }}
                        className="relative mt-0.5 overflow-hidden pl-7 pr-2"
                    >
                        {item.submenu?.map((subItem) => (
                            <Link key={subItem.key} href={subItem.href}>
                                <Text size="2">{subItem.label}</Text>
                            </Link>
                        ))}
                    </motion.div>
                )}
            </AnimatePresence>
        </div>
    );
}
