// resources/js/Components/UI/ButtonSmall.tsx
import React from 'react';
import { Button, ButtonProps } from '@radix-ui/themes';
import { cn } from '@/lib/utils';

interface ButtonSmallProps extends ButtonProps {}

export default function ButtonSmall({ className, children, ...props }: ButtonSmallProps) {
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
