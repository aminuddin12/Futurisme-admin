// resources/js/Components/UI/TextInput.tsx
import React, { forwardRef, useEffect, useRef } from 'react';
// 1. Import TextField dari Radix Themes
import { cn } from '@/lib/utils'; // Pastikan path ini benar
import { TextField } from '@radix-ui/themes'; // Box mungkin diperlukan jika styling root kompleks

// 2. Interface sekarang extend React.InputHTMLAttributes
interface TextInputProps
    extends Omit<React.InputHTMLAttributes<HTMLInputElement>, 'size'> {
    isFocused?: boolean;
    // Props untuk TextField.Root
    size?: '1' | '2' | '3';
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
            ...props // Props sisanya akan diteruskan ke TextField.Root
        },
        ref,
    ) => {
        const inputRef = useRef<HTMLInputElement>(null);

        useEffect(() => {
            if (isFocused) {
                const targetRef =
                    ref && typeof ref !== 'function' ? ref : inputRef;
                targetRef.current?.focus();
            }
        }, [isFocused, ref]);

        // 3. Gunakan TextField.Root sebagai input utama.
        //    Tidak perlu merender <input> terpisah di dalamnya.
        return (
            <TextField.Root
                ref={ref}
                type={type}
                size={size}
                variant={variant}
                radius={radius}
                className={cn('shadow-sm', className)} // Styling Root
                {...props} // Sebarkan props sisanya (value, onChange, placeholder, dll.)
            >
                {leftSlot && (
                    <TextField.Slot side="left">{leftSlot}</TextField.Slot>
                )}
                {rightSlot && (
                    <TextField.Slot side="right">{rightSlot}</TextField.Slot>
                )}
            </TextField.Root>
        );
    },
);

TextInput.displayName = 'TextInput';
export default TextInput;
