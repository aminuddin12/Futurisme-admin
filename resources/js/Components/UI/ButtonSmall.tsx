// resources/js/Components/UI/ButtonSmall.tsx
import { cn } from '@/lib/utils';
import { Button, ButtonProps } from '@radix-ui/themes';

interface ButtonSmallProps extends ButtonProps {}

export default function ButtonSmall({
    className,
    children,
    ...props
}: ButtonSmallProps) {
    return (
        <Button
            size="1" // Ukuran small Radix
            className={cn('', className)}
            {...props}
        >
            {children}
        </Button>
    );
}
