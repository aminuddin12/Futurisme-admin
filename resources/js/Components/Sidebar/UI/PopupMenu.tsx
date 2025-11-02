import { cn } from '@/lib/utils';
import { Link } from '@inertiajs/react';
import { Flex, Separator, Text } from '@radix-ui/themes';
import { MenuItem } from './ListMenuItem'; // Impor tipe data

interface PopupMenuProps {
    item: MenuItem;
}

export default function PopupMenu({ item }: PopupMenuProps) {
    return (
        <Flex direction="column" gap="1" p="2" className="min-w-[160px]">
            <Text
                size="1"
                weight="medium"
                className="mb-1 px-2 text-gray-900 dark:text-gray-100"
            >
                {item.label}
            </Text>

            {/* Tampilkan link utama jika ada */}
            {item.href && (
                <Link
                    href={item.href || '#'}
                    className={cn(
                        'block rounded px-3 py-1 text-xs transition-colors',
                        route().current(item.routeName)
                            ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-300'
                            : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700',
                    )}
                >
                    {item.label}
                </Link>
            )}

            {/* Tampilkan submenu */}
            {item.submenu && item.submenu.length > 0 && (
                <>
                    {item.href && (
                        <Separator my="1" className="dark:!bg-gray-600" />
                    )}
                    {item.submenu.map((subItem) => {
                        const isSubActive = route().current(subItem.routeName);
                        return (
                            <Link
                                key={subItem.key}
                                href={subItem.href}
                                className={cn(
                                    'block rounded px-3 py-1 text-xs transition-colors',
                                    isSubActive
                                        ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-300'
                                        : 'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700',
                                )}
                            >
                                {subItem.label}
                            </Link>
                        );
                    })}
                </>
            )}
        </Flex>
    );
}
