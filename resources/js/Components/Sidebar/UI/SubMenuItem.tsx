import { cn } from '@/lib/utils';
import { Link } from '@inertiajs/react';
import NumberBadge from '../Badge/NumberBadge';
import TextBadge from '../Badge/TextBadge';
import { SubMenuItem } from './ListMenuItem'; // Impor tipe data

interface SubMenuItemProps {
    item: SubMenuItem;
    isLast: boolean;
}

export default function SubMenuItemComponent({
    item,
    isLast,
}: SubMenuItemProps) {
    const isActive = route().current(item.routeName);

    return (
        <div className="relative">
            {/* Garis Horizontal */}
            <div className="absolute left-[-9px] top-[11px] h-px w-[10px] bg-gray-300 dark:bg-gray-700"></div>

            {/* Garis Vertikal (sembunyikan di item terakhir) */}
            {!isLast && (
                <div className="absolute bottom-0 left-[-5px] top-[11px] w-px bg-gray-300 dark:bg-gray-700"></div>
            )}

            <Link
                href={item.href || '#'}
                className={cn(
                    'flex items-center justify-between rounded-md px-4 py-1.5 text-xs transition-colors duration-200',
                    isActive
                        ? 'font-medium text-emerald-600 dark:text-emerald-300' // Aktif
                        : 'text-gray-500 hover:bg-gray-200/50 dark:text-gray-400 dark:hover:bg-gray-700/30', // Inaktif
                )}
            >
                <span className="truncate">{item.label}</span>
                {/* Tampilkan Badge jika ada */}
                {item.badge?.type === 'number' && (
                    <NumberBadge
                        count={item.badge.content as number}
                        color={item.badge.color || 'gray'}
                    />
                )}
                {item.badge?.type === 'text' && (
                    <TextBadge
                        text={item.badge.content as string}
                        color={item.badge.color || 'emerald'}
                    />
                )}
            </Link>
        </div>
    );
}
