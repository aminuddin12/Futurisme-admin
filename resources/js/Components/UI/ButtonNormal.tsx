// resources/js/Components/UI/ButtonNormal.tsx
import { cn } from '@/lib/utils';
import { Button, ButtonProps } from '@radix-ui/themes';

interface ButtonNormalProps extends ButtonProps {}

export default function ButtonNormal({
    className,
    children,
    ...props
}: ButtonNormalProps) {
    return (
        <Button
            size="2" // Ukuran default Radix
            className={cn('', className)}
            {...props}
        >
            {children}
        </Button>
    );
}
