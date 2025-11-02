// resources/js/Components/Admin/Sidebar/Sidebar.tsx

import { Icon } from '@iconify/react';
import { Link, usePage } from '@inertiajs/react';
import * as Tooltip from '@radix-ui/react-tooltip';
import { Badge, Flex, IconButton, Separator, Text } from '@radix-ui/themes';
import { AnimatePresence, motion } from 'framer-motion';
import { useState } from 'react';

// Interface untuk tipe data menu
interface SubMenuItem {
    name: string;
    href: string;
    routeName: string; // Nama route Inertia
}

interface MenuItem {
    name: string;
    icon: string;
    href?: string;
    routeName?: string;
    isNew?: boolean;
    submenu?: SubMenuItem[];
}

interface SidebarProps {
    isSidebarOpen: boolean;
    toggleSidebar: () => void;
}

// Data menu (sesuaikan dengan kebutuhan Anda)
const menuItems: MenuItem[] = [
    {
        name: 'Dashboard',
        icon: 'heroicons:squares-2x2-solid',
        href: route('admin.dashboard'),
        routeName: 'admin.dashboard',
    },
    {
        name: 'AI Assistant',
        icon: 'heroicons:cpu-chip-solid',
        isNew: true,
        submenu: [
            { name: 'Chat', href: '#', routeName: 'admin.ai.chat' },
            { name: 'Image Gen', href: '#', routeName: 'admin.ai.image' },
        ],
    },
    {
        name: 'E-commerce',
        icon: 'heroicons:shopping-cart-solid',
        isNew: true,
        submenu: [
            {
                name: 'Produk',
                href: '#',
                routeName: 'admin.ecommerce.products',
            },
            { name: 'Pesanan', href: '#', routeName: 'admin.ecommerce.orders' },
        ],
    },
    {
        name: 'Calendar',
        icon: 'heroicons:calendar-days-solid',
        href: '#',
        routeName: 'admin.calendar',
    },
    {
        name: 'User Profile',
        icon: 'heroicons:user-solid',
        submenu: [
            { name: 'Account', href: route('admin.profile'), routeName: 'admin.profile' },
            { name: 'Settings', href: route('admin.profile.settings'), routeName: 'admin.profile.settings' },
        ],
    },
    {
        name: 'Task',
        icon: 'heroicons:clipboard-document-list-solid',
        submenu: [
            { name: 'List', href: '#', routeName: 'admin.tasks.list' },
            { name: 'Detail', href: '#', routeName: 'admin.tasks.detail' },
        ],
    },
    {
        name: 'Forms',
        icon: 'heroicons:document-text-solid',
        submenu: [
            { name: 'Input', href: '#', routeName: 'admin.forms.input' },
            { name: 'Layout', href: '#', routeName: 'admin.forms.layout' },
        ],
    },
    {
        name: 'Tables',
        icon: 'heroicons:table-cells-solid',
        submenu: [
            { name: 'Basic', href: '#', routeName: 'admin.tables.basic' },
            { name: 'Data', href: '#', routeName: 'admin.tables.data' },
        ],
    },
    {
        name: 'Pages',
        icon: 'heroicons:document-duplicate-solid',
        submenu: [
            { name: 'Login', href: '#', routeName: 'login' }, // Contoh ke route non-admin
            { name: 'Register', href: '#', routeName: 'register' },
        ],
    },
];

const supportItems: MenuItem[] = [
    {
        name: 'Chat',
        icon: 'heroicons:chat-bubble-left-right-solid',
        href: route('admin.chat'),
        routeName: 'admin.chat',
    },
    {
        name: 'Support Ticket',
        icon: 'heroicons:ticket-solid',
        isNew: true,
        submenu: [
            { name: 'Ticket List', href: '#', routeName: 'admin.tickets.list' },
            {
                name: 'Ticket Reply',
                href: '#',
                routeName: 'admin.tickets.reply',
            },
        ],
    },
    {
        name: 'Email',
        icon: 'heroicons:envelope-solid',
        submenu: [
            { name: 'Inbox', href: '#', routeName: 'admin.email.inbox' },
            { name: 'Compose', href: '#', routeName: 'admin.email.compose' },
        ],
    },
];

const otherItems: MenuItem[] = [
    {
        name: 'Analytics',
        icon: 'heroicons:clock-solid',
        href: '#',
        routeName: 'admin.analytics',
    },
    {
        name: 'Settings',
        icon: 'heroicons:cog-6-tooth-solid',
        href: '#',
        routeName: 'admin.settings',
    },
];

// Komponen untuk satu item menu (bisa punya submenu)
function SidebarMenuItem({
    item,
    isSidebarOpen,
    isActive,
    isSubmenuActive,
    isOpen,
    onClick,
}: {
    item: MenuItem;
    isSidebarOpen: boolean;
    isActive: boolean;
    isSubmenuActive: boolean;
    isOpen: boolean;
    onClick: () => void;
}) {
    const hasSubmenu = item.submenu && item.submenu.length > 0;

    // const isSubmenuActive =
    //     hasSubmenu &&
    //     item.submenu?.some((subItem) => route().current(subItem.routeName));

    // Konten Tautan Internal (Ikon + Teks jika terbuka)
    const LinkContent = (
        <div
            className={`flex w-full items-center ${!isSidebarOpen && 'justify-center'}`}
        >
            <div className="flex items-center">
                <Icon icon={item.icon} className="h-5 w-5 shrink-0" />
                {isSidebarOpen && (
                    <span className="ml-2 text-sm font-medium">
                        {item.name}
                    </span>
                )}
            </div>
            {isSidebarOpen && (
                <div className="flex items-center gap-1.5">
                    {item.isNew && (
                        <Badge color="green" variant="soft" size="1">
                            NEW
                        </Badge>
                    )}
                    {hasSubmenu && (
                        <Icon
                            icon="heroicons:chevron-down-solid"
                            className={`h-3 w-3 transition-transform duration-200 ${isOpen ? 'rotate-180' : ''}`}
                        />
                    )}
                </div>
            )}
        </div>
    );

    // Konten Popup Tooltip (saat sidebar tertutup)
    const TooltipPopupContent = (
        <div className="flex min-w-[150px] flex-col gap-1 p-2">
            {' '}
            {/* Tambah min-width */}
            <Text
                size="1"
                weight="medium"
                className="mb-1 px-3 text-gray-900 dark:text-gray-100"
            >
                {item.name}
            </Text>
            {hasSubmenu &&
                item.submenu?.map((subItem) => {
                    const isSubActive = route().current(subItem.routeName);
                    return (
                        <Link
                            key={subItem.name}
                            href={subItem.href}
                            className={`block rounded px-3 py-1 text-xs transition-colors ${isSubActive ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-300' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600'} `}
                        >
                            {subItem.name}
                        </Link>
                    );
                })}
            {/* Jika item utama punya link langsung (bukan hanya submenu) */}
            {!hasSubmenu && item.href && (
                <Link
                    href={item.href}
                    className={`block rounded px-3 py-1 text-xs transition-colors ${isActive ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-300' : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600'} `}
                >
                    {item.name}
                </Link>
            )}
        </div>
    );

    // --- PERUBAHAN UTAMA DI SINI ---
    const linkClasses = `
        flex items-center justify-between mx-2 rounded-lg px-3 py-2 transition-colors duration-200 cursor-pointer group // Tambah group
        ${
            isActive || (isSubmenuActive && !isOpen)
                ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300'
                : 'text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700'
        }
        ${!isSidebarOpen && 'justify-center'}
    `;

    return (
        <div>
            {!isSidebarOpen ? (
                <Tooltip.Provider delayDuration={100}>
                    <Tooltip.Root>
                        <Tooltip.Trigger asChild>
                            <div className={linkClasses}>{LinkContent}</div>
                        </Tooltip.Trigger>
                        <Tooltip.Portal>
                            <Tooltip.Content
                                side="right"
                                align="start"
                                sideOffset={6}
                                className="z-[60] rounded-md border bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800"
                            >
                                {TooltipPopupContent}
                            </Tooltip.Content>
                        </Tooltip.Portal>
                    </Tooltip.Root>
                </Tooltip.Provider>
            ) : (
                // Jika sidebar terbuka, gunakan Link Inertia seperti biasa
                <Link
                    href={item.href || '#'}
                    onClick={(e) => {
                        if (hasSubmenu) {
                            e.preventDefault();
                            onClick();
                        }
                    }}
                    className={linkClasses}
                >
                    {LinkContent}
                </Link>
            )}

            <AnimatePresence>
                {hasSubmenu && isOpen && isSidebarOpen && (
                    <motion.div
                        initial={{ height: 0, opacity: 0 }}
                        animate={{ height: 'auto', opacity: 1 }}
                        exit={{ height: 0, opacity: 0 }}
                        transition={{ duration: 0.2 }}
                        className="relative mt-0.5 overflow-hidden pl-7 pr-2" // Tambah mt-0.5
                    >
                        {/* Garis Vertikal Utama */}
                        <div className="absolute bottom-1 left-[26px] top-0 w-px bg-gray-200 dark:bg-gray-600"></div>

                        {item.submenu?.map((subItem) => {
                            const isSubActive = route().current(
                                subItem.routeName,
                            );
                            return (
                                <div
                                    key={subItem.name}
                                    className="relative my-0.5"
                                >
                                    {/* Garis Horizontal ke Item */}
                                    <div className="absolute left-[-9px] top-[11px] h-px w-[10px] bg-gray-200 dark:bg-gray-600"></div>

                                    <Link
                                        href={subItem.href || '#'}
                                        className={`flex items-center rounded-lg px-4 py-1.5 text-xs transition-colors duration-200 ${
                                            isSubActive
                                                ? 'bg-emerald-50 font-medium text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-300'
                                                : 'text-gray-500 hover:bg-gray-200 dark:text-gray-400 dark:hover:bg-gray-700'
                                        }`}
                                    >
                                        {subItem.name}
                                    </Link>
                                </div>
                            );
                        })}
                    </motion.div>
                )}
            </AnimatePresence>
        </div>
    );
}

// Komponen Sidebar Utama
export default function Sidebar({
    isSidebarOpen,
    toggleSidebar,
}: SidebarProps) {
    const { url } = usePage();
    const [openMenus, setOpenMenus] = useState<Record<string, boolean>>({});
    useState(() => {
        const activeParent = [
            ...menuItems,
            ...supportItems,
            ...otherItems,
        ].find((item) =>
            item.submenu?.some((sub) => route().current(sub.routeName)),
        );
        if (activeParent) {
            setOpenMenus((prev) => ({ ...prev, [activeParent.name]: true }));
        }
    }, [url]);

    const toggleMenu = (menuName: string) => {
        setOpenMenus((prev) => ({
            ...prev,
            [menuName]: !prev[menuName],
        }));
    };

    const renderMenuGroup = (title: string, items: MenuItem[]) => (
        <div className="mb-4">
            {isSidebarOpen && (
                <Text
                    size="1"
                    className="mb-1 px-4 text-[0.65rem] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400"
                >
                    {title}
                </Text>
            )}
            {!isSidebarOpen && (
                <Separator className="mx-4 my-2 dark:!bg-gray-700" />
            )}
            <Flex direction="column" gap="0.5">
                {items.map((item) => {
                    const isActiveDirect =
                        item.routeName && route().current(item.routeName);
                    const isSubmenuActive =
                        item.submenu?.some((sub) =>
                            route().current(sub.routeName),
                        ) ?? false; // Cek submenu aktif
                    return (
                        <SidebarMenuItem
                            key={item.name}
                            item={item}
                            isSidebarOpen={isSidebarOpen}
                            isActive={!!isActiveDirect}
                            isSubmenuActive={isSubmenuActive} // <-- Kirim prop ini
                            isOpen={!!openMenus[item.name]}
                            onClick={() => toggleMenu(item.name)}
                        />
                    );
                })}
            </Flex>
        </div>
    );

    const customScrollbarHideCSS = {
        /* Hide scrollbar for Chrome, Safari and Opera */
        '&::WebkitScrollbar': {
            display: 'none',
        },
        /* Hide scrollbar for IE, Edge and Firefox */
        msOverflowStyle: 'none' /* IE and Edge */,
        scrollbarWidth: 'none' /* Firefox */,
    } as React.CSSProperties;

    const LogoTooltipContent = (
        <Flex direction="column" gap="2" p="2" align="center">
            <Link
                href={route('admin.dashboard')}
                className="flex w-full items-center gap-2 rounded px-3 py-1 text-xs text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
            >
                <Icon icon="heroicons:home-solid" className="h-4 w-4" />
                <span>Dashboard</span>
            </Link>
            <Separator className="my-1 !bg-gray-200 dark:!bg-gray-600" />
            <button
                onClick={toggleSidebar}
                className="flex w-full items-center gap-2 rounded px-3 py-1 text-xs text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
                aria-label="Expand sidebar"
            >
                {/* Ganti ikon expand */}
                <Icon
                    icon="heroicons:arrows-pointing-out"
                    className="h-4 w-4"
                />
                <span>Expand</span>
            </button>
        </Flex>
    );

    return (
        <aside
            className={` ${isSidebarOpen ? 'w-60' : 'w-[72px]'} flex-shrink-0 ...`}
            style={{ overflowY: 'hidden' }}
        >
            {/* Logo & Tombol Toggle */}
            <div
                className={`flex items-center justify-between ${isSidebarOpen ? 'pl-4 pr-2' : 'justify-center px-2'} h-[65px] flex-shrink-0`}
            >
                {!isSidebarOpen ? (
                    <Tooltip.Provider delayDuration={100}>
                        <Tooltip.Root>
                            <Tooltip.Trigger asChild>
                                <Link
                                    href={route('admin.dashboard')}
                                    className="flex items-center justify-center"
                                >
                                    <Flex
                                        align="center"
                                        justify="center"
                                        className="rounded-lg bg-gray-800 p-1.5 dark:bg-gray-700"
                                    >
                                        {' '}
                                        {/* Ubah background logo */}
                                        <Icon
                                            icon="heroicons:squares-2x2-solid"
                                            className="h-5 w-5 text-white"
                                        />{' '}
                                        {/* Ganti ikon logo */}
                                    </Flex>
                                </Link>
                            </Tooltip.Trigger>
                            <Tooltip.Portal>
                                <Tooltip.Content
                                    side="right"
                                    align="center"
                                    sideOffset={8}
                                    className="z-[60] rounded-md border bg-white shadow-lg dark:border-gray-700 dark:bg-gray-800"
                                >
                                    {LogoTooltipContent}
                                </Tooltip.Content>
                            </Tooltip.Portal>
                        </Tooltip.Root>
                    </Tooltip.Provider>
                ) : (
                    <Link href="/" className="flex items-center gap-2">
                        <Flex
                            align="center"
                            justify="center"
                            className="rounded-lg bg-gray-800 p-1.5 dark:bg-gray-700"
                        >
                            {' '}
                            {/* Ubah background logo */}
                            <Icon
                                icon="heroicons:squares-2x2-solid"
                                className="h-5 w-5 text-white"
                            />{' '}
                            {/* Ganti ikon logo */}
                        </Flex>
                        <span className="text-lg font-bold text-black dark:text-white">
                            Fxology {/* Ganti dengan nama Anda */}
                        </span>
                    </Link>
                )}

                {/* Tombol Minimize */}
                {isSidebarOpen && (
                    <IconButton
                        size="1"
                        variant="ghost"
                        color="gray"
                        onClick={toggleSidebar}
                        className="text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white"
                        aria-label="Minimize sidebar"
                    >
                        {/* Ganti ikon minimize */}
                        <Icon
                            icon="heroicons:arrows-pointing-in"
                            className="h-5 w-5"
                        />
                    </IconButton>
                )}
            </div>

            <Separator className="dark:!bg-gray-700" />

            {/* Kontainer Nav */}
            <div
                className="h-[calc(100%-65px)] overflow-y-auto overflow-x-hidden"
                style={customScrollbarHideCSS}
            >
                <nav className="mt-4 flex flex-col justify-between">
                    <div>
                        {renderMenuGroup('MAIN NAVIGATION', menuItems)}
                        {renderMenuGroup('SUPPORT ITEMS', supportItems)}
                        {/* Ganti nama grup sesuai contoh */}
                    </div>
                    <div className="mt-auto p-4"></div>
                </nav>
            </div>
        </aside>
    );
}

// Definisikan ulang customScrollbarHideCSS di sini jika belum
const customScrollbarHideCSS = {
    '&::-webkit-scrollbar': { display: 'none' },
    '-ms-overflow-style': 'none',
    'scrollbar-width': 'none',
} as React.CSSProperties;
