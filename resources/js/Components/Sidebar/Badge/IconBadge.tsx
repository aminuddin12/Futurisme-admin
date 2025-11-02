import { cn } from '@/lib/utils';
import { Icon } from '@iconify/react';

interface IconBadgeProps {
    icon: string;
    color?: 'emerald' | 'blue' | 'red' | 'yellow' | 'gray';
    className?: string;
}

export default function IconBadge({
    icon,
    color = 'gray',
    className,
}: IconBadgeProps) {
    const colors = {
        emerald:
            'bg-emerald-100 text-emerald-700 dark:bg-emerald-900 dark:text-emerald-300',
        blue: 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300',
        red: 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
        yellow: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300',
        gray: 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
    };

    return (
        <div
            className={cn(
                'flex h-5 w-5 items-center justify-center rounded-full',
                colors[color],
                className,
            )}
        >
            <Icon icon={icon} className="h-3 w-3" />
        </div>
    );
}
