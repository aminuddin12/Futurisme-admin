// resources/js/Components/Profile/ListItem.tsx
import { cn } from '@/lib/utils';
import { Icon } from '@iconify/react';
import { Text } from '@radix-ui/themes';

interface ListItemProps {
    icon: string;
    label: string;
    isActive: boolean;
    onClick: () => void;
}

export default function ListItem({
    icon,
    label,
    isActive,
    onClick,
}: ListItemProps) {
    return (
        <button
            onClick={onClick}
            className={cn(
                'flex w-full items-center gap-2.5 rounded-md px-3 py-2 text-left text-sm transition-colors duration-150', // Sedikit lebih kecil
                isActive
                    ? 'bg-gray-100 font-medium text-gray-900 dark:bg-gray-700/50 dark:text-gray-100'
                    : 'text-gray-600 hover:bg-gray-100/50 dark:text-gray-400 dark:hover:bg-gray-700/30',
            )}
        >
            <Icon icon={icon} className="h-4 w-4 flex-shrink-0 text-gray-500" />
            <Text size="2">{label}</Text>
        </button>
    );
}
