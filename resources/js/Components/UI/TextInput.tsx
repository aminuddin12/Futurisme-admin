// resources/js/Components/UI/TextInput.tsx
import React, { forwardRef, useEffect, useRef } from 'react';
// 1. Import HANYA 'TextField' dan tipe props Root jika perlu styling root
import { cn } from '@/lib/utils'; // Pastikan path ini benar
import { TextField } from '@radix-ui/themes';

// 2. Interface sekarang extend React.InputHTMLAttributes untuk props input standar
interface TextInputProps
    extends Omit<React.InputHTMLAttributes<HTMLInputElement>, 'size'> {
    inputClassName?: string; // className HANYA untuk <input>
    rootClassName?: string; // className HANYA untuk Root element
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
            inputClassName = '',
            rootClassName = '',
            isFocused = false,
            type = 'text',
            size = '2',
            variant = 'surface',
            radius,
            leftSlot,
            rightSlot,
            ...props // Props sisanya akan diteruskan ke <input>
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

        return (
            // 3. Gunakan TextField.Root dan TextField.Slot
            <TextField.Root
                size={size}
                variant={variant}
                radius={radius}
                className={cn('shadow-sm', rootClassName)} // Terapkan rootClassName
            >
                {leftSlot && (
                    <TextField.Slot side="left">{leftSlot}</TextField.Slot>
                )}
                {/* 4. Render elemen <input> HTML standar di dalamnya */}
                <input
                    ref={ref || inputRef} // Teruskan ref ke input
                    type={type}
                    className={cn(
                        // Kelas styling dasar biasanya tidak perlu di sini,
                        // Radix menangani styling input di dalam Root.
                        // Hanya tambahkan kelas spesifik jika perlu override.
                        'w-full', // Pastikan input mengisi Root
                        inputClassName, // Terapkan inputClassName
                    )}
                    {...props} // Sebarkan props sisanya (value, onChange, placeholder, dll.)
                />
                {rightSlot && (
                    <TextField.Slot side="right">{rightSlot}</TextField.Slot>
                )}
            </TextField.Root>
        );
    },
);

TextInput.displayName = 'TextInput';
export default TextInput;
