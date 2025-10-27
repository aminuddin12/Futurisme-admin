// resources/js/Components/UI/ButtonWarning.tsx
import { cn } from '@/lib/utils';
import { Button, ButtonProps } from '@radix-ui/themes';

interface ButtonWarningProps extends ButtonProps {}

export default function ButtonWarning({
    className,
    children,
    ...props
}: ButtonWarningProps) {
    return (
        <Button
            color="yellow" // Warna warning
            className={cn('', className)}
            {...props}
        >
            {children}
        </Button>
    );
}
