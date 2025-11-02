import { cn } from '@/lib/utils';
import { Icon } from '@iconify/react';
import { Link } from '@inertiajs/react';

export default function MobileMode() {
    const menuItems = [
        {
            key: 'home',
            label: 'Home',
            icon: 'heroicons:home-solid',
            href: route('admin.dashboard'),
            routeName: 'admin.dashboard',
        },
        {
            key: 'chat',
            label: 'Chat',
            icon: 'heroicons:chat-bubble-left-solid',
            href: route('admin.chat'),
            routeName: 'admin.chat',
        },
        {
            key: 'settings',
            label: 'Settings',
            icon: 'heroicons:cog-6-tooth-solid',
            href: '#',
            routeName: 'admin.settings',
        },
        {
            key: 'profile',
            label: 'Profile',
            icon: 'heroicons:user-solid',
            href: route('admin.profile'),
            routeName: 'admin.profile',
        },
    ];

    return (
        <nav className="fixed bottom-0 left-0 right-0 z-50 h-16 border-t border-white/20 bg-white/50 backdrop-blur-lg dark:border-gray-800/50 dark:bg-gray-900/50 md:hidden">
            <div className="mx-auto grid h-full max-w-lg grid-cols-4">
                {menuItems.map((item) => {
                    const isActive = route().current(item.routeName);
                    return (
                        <Link
                            key={item.key}
                            href={item.href}
                            className="group inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50/50 dark:hover:bg-gray-800/50"
                        >
                            <Icon
                                icon={item.icon}
                                className={cn(
                                    'mb-1 h-5 w-5',
                                    isActive
                                        ? 'text-emerald-600 dark:text-emerald-400'
                                        : 'text-gray-500 group-hover:text-emerald-600 dark:text-gray-400 dark:group-hover:text-emerald-400',
                                )}
                            />
                            <span
                                className={cn(
                                    'text-[0.65rem]',
                                    isActive
                                        ? 'font-medium text-emerald-600 dark:text-emerald-400'
                                        : 'text-gray-500 group-hover:text-emerald-600 dark:text-gray-400 dark:group-hover:text-emerald-400',
                                )}
                            >
                                {item.label}
                            </span>
                        </Link>
                    );
                })}
            </div>
        </nav>
    );
}
