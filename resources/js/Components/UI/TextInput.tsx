import { cn } from '@/lib/utils';
import { TextField } from '@radix-ui/themes';
import React, { forwardRef, useEffect, useRef } from 'react';

type RadixTextFieldInputProps = React.ComponentPropsWithoutRef<typeof TextField.Root>;

// Hapus React.ComponentPropsWithoutRef<'input'> untuk menghindari duplikasi props
interface TextInputProps extends Omit<RadixTextFieldInputProps, 'size'> {
    inputClassName?: string;
    rootClassName?: string;
    isFocused?: boolean;
    size?: '1' | '2' | '3';
    leftSlot?: React.ReactNode;
    rightSlot?: React.ReactNode;
}

const TextInput = forwardRef<HTMLInputElement, TextInputProps>(
    (
        { rootClassName = '', isFocused = false, size = '2', leftSlot, rightSlot, ...props },
        ref,
    ) => {
        const inputRef = useRef<HTMLInputElement>(null);

        useEffect(() => {
            if (isFocused) {
                // Gunakan ref yang diteruskan jika ada, jika tidak, gunakan ref internal
                const targetRef = ref && typeof ref !== 'function' ? ref : inputRef;
                targetRef.current?.focus();
            }
        }, [isFocused, ref]);

        return (
            // Gunakan TextField.Root sebagai komponen utama
            // dan teruskan ref serta props langsung ke dalamnya.
            <TextField.Root
                ref={ref || inputRef}
                size={size}
                className={cn(
                    'shadow-sm dark:bg-gray-900 dark:text-gray-300',
                    rootClassName,
                )}
                {...props} // Teruskan semua props yang tersisa
            >
                {/* Slot untuk ikon atau elemen di sisi kiri */}
                {leftSlot && (
                    <TextField.Slot side="left">{leftSlot}</TextField.Slot>
                )}
                {/* Slot untuk ikon atau elemen di sisi kanan */}
                {rightSlot && (
                    <TextField.Slot side="right">{rightSlot}</TextField.Slot>
                )}
                {/* HAPUS elemen <input> manual dari sini */}
            </TextField.Root>
        );
    },
);
TextInput.displayName = 'TextInput';
export default TextInput;
