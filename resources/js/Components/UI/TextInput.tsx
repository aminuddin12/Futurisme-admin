// resources/js/Components/UI/TextInput.tsx
import { cn } from '@/lib/utils';
import { TextField, TextFieldInputProps } from '@radix-ui/themes';
import React, { forwardRef } from 'react';

// Gabungkan props TextFieldInputProps dengan ref
interface TextInputProps extends Omit<TextFieldInputProps, 'size'> {
    className?: string;
    isFocused?: boolean; // Breeze prop
    type?: string;
    // Tambahkan prop Radix TextField.Root jika perlu
    size?: '1' | '2' | '3'; // Ukuran Radix
    variant?: 'classic' | 'surface' | 'soft';
    radius?: 'none' | 'small' | 'medium' | 'large' | 'full';
    leftSlot?: React.ReactNode;
    rightSlot?: React.ReactNode;
}

const TextInput = forwardRef<HTMLInputElement, TextInputProps>(
    (
        {
            className = '',
            isFocused = false,
            type = 'text',
            size = '2',
            variant = 'surface',
            radius,
            leftSlot,
            rightSlot,
            ...props
        },
        ref,
    ) => {
        const inputRef = React.useRef<HTMLInputElement>(null);

        React.useEffect(() => {
            if (isFocused) {
                inputRef.current?.focus();
            }
        }, [isFocused]);

        return (
            <TextField.Root
                size={size}
                variant={variant}
                radius={radius}
                className={cn(
                    'rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-emerald-600 dark:focus:ring-emerald-600',
                    className,
                )}
            >
                {leftSlot && (
                    <TextField.Slot side="left">{leftSlot}</TextField.Slot>
                )}
                <TextField.Input
                    ref={ref || inputRef} // Gunakan ref dari props atau ref internal
                    type={type}
                    {...props} // Sebarkan sisa props ke input
                />
                {rightSlot && (
                    <TextField.Slot side="right">{rightSlot}</TextField.Slot>
                )}
            </TextField.Root>
        );
    },
);

TextInput.displayName = 'TextInput'; // Nama untuk DevTools
export default TextInput;
