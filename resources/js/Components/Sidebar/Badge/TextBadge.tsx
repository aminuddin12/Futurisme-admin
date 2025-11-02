import { cn } from '@/lib/utils';
import { Badge } from '@radix-ui/themes';

interface TextBadgeProps {
    text: string;
    color?: 'emerald' | 'blue' | 'red' | 'yellow' | 'gray';
    className?: string;
}

export default function TextBadge({
    text,
    color = 'emerald',
    className,
}: TextBadgeProps) {
    const colors: {
        [key: string]: 'green' | 'blue' | 'red' | 'yellow' | 'gray';
    } = {
        emerald: 'green',
        blue: 'blue',
        red: 'red',
        yellow: 'yellow',
        gray: 'gray',
    };

    return (
        <Badge
            color={colors[color]}
            variant="soft"
            size="1"
            className={cn('uppercase', className)}
        >
            {text}
        </Badge>
    );
}
