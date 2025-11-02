import { cn } from '@/lib/utils';
import { Icon } from '@iconify/react';

interface MenuTriggerProps {
    isOpen: boolean;
    onClick: () => void;
}

// Ini identik dengan groupTrigger, tapi dibuat terpisah sesuai permintaan
export default function MenuTrigger({ isOpen, onClick }: MenuTriggerProps) {
    return (
        <button
            onClick={(e) => {
                e.stopPropagation();
                onClick();
            }}
            className="rounded-full p-1 hover:bg-gray-500/10"
        >
            <Icon
                icon="heroicons:chevron-down-solid"
                className={cn(
                    'h-3.5 w-3.5 text-gray-400 transition-transform duration-200',
                    isOpen ? 'rotate-180' : '',
                )}
            />
        </button>
    );
}
