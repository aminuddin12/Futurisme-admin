// resources/js/Components/UI/ButtonDanger.tsx
import React from 'react';
import { Button, ButtonProps } from '@radix-ui/themes';
import { cn } from '@/lib/utils';

interface ButtonDangerProps extends ButtonProps {}

export default function ButtonDanger({ className, children, ...props }: ButtonDangerProps) {
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
