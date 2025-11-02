import { cn } from '@/lib/utils';

interface CornerBadgeProps {
    className?: string;
}

export default function CornerBadge({ className }: CornerBadgeProps) {
    return (
        <span
            className={cn(
                'absolute -right-1 -top-1 block h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-white dark:ring-gray-800',
                className,
            )}
        />
    );
}
