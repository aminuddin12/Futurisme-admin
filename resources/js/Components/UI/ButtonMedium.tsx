// resources/js/Components/UI/ButtonMedium.tsx
import { cn } from '@/lib/utils';
import { Button, ButtonProps } from '@radix-ui/themes';

interface ButtonMediumProps extends ButtonProps {}

export default function ButtonMedium({
    className,
    children,
    ...props
}: ButtonMediumProps) {
    return (
        <Button
            size="3" // Ukuran medium Radix
            className={cn('', className)}
            {...props}
        >
            {children}
        </Button>
    );
}
