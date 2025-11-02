import { cn } from '@/lib/utils';
import { Icon } from '@iconify/react';

interface GroupTriggerProps {
    isOpen: boolean;
    onClick: () => void;
}

export default function GroupTrigger({ isOpen, onClick }: GroupTriggerProps) {
    return (
        <button
            onClick={(e) => {
                e.stopPropagation();
                onClick();
            }}
            className="-mr-1 rounded-full p-1 hover:bg-gray-500/10"
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
