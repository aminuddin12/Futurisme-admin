// resources/js/Components/UI/ButtonDanger.tsx
import { cn } from '@/lib/utils';
import { Button, ButtonProps } from '@radix-ui/themes';

interface ButtonDangerProps extends ButtonProps {}

export default function ButtonDanger({
    className,
    children,
    ...props
}: ButtonDangerProps) {
    return (
        <Button
            color="red" // Warna danger
            className={cn('', className)}
            {...props}
        >
            {children}
        </Button>
    );
}
