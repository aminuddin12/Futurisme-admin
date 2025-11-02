import { cn } from '@/lib/utils';
import { Badge } from '@radix-ui/themes';

interface NumberBadgeProps {
    count: number;
    color?: 'emerald' | 'blue' | 'red' | 'gray';
    className?: string;
}

export default function NumberBadge({
    count,
    color = 'gray',
    className,
}: NumberBadgeProps) {
    const colors: { [key: string]: 'green' | 'blue' | 'red' | 'gray' } = {
        emerald: 'green',
        blue: 'blue',
        red: 'red',
        gray: 'gray',
    };
    return (
        <Badge
            color={colors[color]}
            variant="solid"
            radius="full"
            size="1"
            className={cn(
                'flex min-w-[1.25rem] items-center justify-center',
                className,
            )}
        >
            {count}
        </Badge>
    );
}
