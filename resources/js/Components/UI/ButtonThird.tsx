// resources/js/Components/UI/ButtonThird.tsx
import { cn } from '@/lib/utils';
import { Button, ButtonProps } from '@radix-ui/themes';

interface ButtonThirdProps extends ButtonProps {}

export default function ButtonThird({
    className,
    children,
    ...props
}: ButtonThirdProps) {
    return (
        <Button
            // Contoh styling: Gunakan variant ghost
            variant="ghost"
            color="gray"
            className={cn(
                'text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700',
                className,
            )}
            {...props}
        >
            {children}
        </Button>
    );
}
