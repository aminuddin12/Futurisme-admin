// resources/js/Components/UI/ButtonWarning.tsx
import React from 'react';
import { Button, ButtonProps } from '@radix-ui/themes';
import { cn } from '@/lib/utils';

interface ButtonWarningProps extends ButtonProps {}

export default function ButtonWarning({ className, children, ...props }: ButtonWarningProps) {
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
