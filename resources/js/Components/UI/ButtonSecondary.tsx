// resources/js/Components/UI/ButtonSecondary.tsx
import { cn } from '@/lib/utils';
import { Button, ButtonProps } from '@radix-ui/themes';

interface ButtonSecondaryProps extends ButtonProps {}

export default function ButtonSecondary({
    className,
    children,
    ...props
}: ButtonSecondaryProps) {
    return (
        <Button
            // Contoh styling: Gunakan variant outline atau soft
            variant="outline"
            color="gray" // Atau warna lain
            className={cn('', className)}
            {...props}
        >
            {children}
        </Button>
    );
}
