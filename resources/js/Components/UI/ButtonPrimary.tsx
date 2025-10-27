// resources/js/Components/UI/ButtonPrimary.tsx
import { cn } from '@/lib/utils'; // Asumsi Anda punya helper `cn`
import { Button, ButtonProps } from '@radix-ui/themes';

interface ButtonPrimaryProps extends ButtonProps {}

export default function ButtonPrimary({
    className,
    children,
    ...props
}: ButtonPrimaryProps) {
    return (
        <Button
            variant="solid" // Atau 'soft', 'surface'
            highContrast
            className={cn('shadow-sm', className)} // Gabungkan kelas
            {...props}
        >
            {children}
        </Button>
    );
}
