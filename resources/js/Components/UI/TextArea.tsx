import React, { forwardRef, useRef, useEffect } from 'react';
import { TextArea as RadixTextArea, TextAreaProps as RadixTextAreaProps} from '@radix-ui/themes';
import { cn } from '@/lib/utils';
interface Props extends Omit<RadixTextAreaProps, 'size'> { className?: string; isFocused?: boolean; size?: "1" | "2" | "3";}
const TextArea = forwardRef<HTMLTextAreaElement, Props>(({ className = '', isFocused = false, size = "2", ...props }, ref) => {
    const inputRef = useRef<HTMLTextAreaElement>(null);
    useEffect(() => { if (isFocused) { inputRef.current?.focus(); } }, [isFocused]);
    return <RadixTextArea ref={ref || inputRef} size={size} className={cn('shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md', className)} {...props} />;
});
TextArea.displayName = 'TextArea'; export default TextArea;
