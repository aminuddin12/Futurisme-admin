// resources/js/Components/UI/TextArea.tsx
import { cn } from '@/lib/utils';
import {
    TextArea as RadixTextArea,
    TextAreaProps as RadixTextAreaProps,
} from '@radix-ui/themes';
import React, { forwardRef } from 'react';

interface TextAreaProps extends Omit<RadixTextAreaProps, 'size'> {
    className?: string;
    isFocused?: boolean;
    size?: '1' | '2' | '3';
}

const TextArea = forwardRef<HTMLTextAreaElement, TextAreaProps>(
    ({ className = '', isFocused = false, size = '2', ...props }, ref) => {
        const inputRef = React.useRef<HTMLTextAreaElement>(null);

        React.useEffect(() => {
            if (isFocused) {
                inputRef.current?.focus();
            }
        }, [isFocused]);

        return (
            <RadixTextArea
                ref={ref || inputRef}
                size={size}
                className={cn(
                    'rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-emerald-600 dark:focus:ring-emerald-600',
                    className,
                )}
                {...props}
            />
        );
    },
);

TextArea.displayName = 'TextArea';
export default TextArea;
