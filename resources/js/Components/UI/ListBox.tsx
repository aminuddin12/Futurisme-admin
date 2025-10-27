// resources/js/Components/UI/ListBox.tsx
import { cn } from '@/lib/utils';
import React from 'react';

interface ListBoxProps extends React.HTMLAttributes<HTMLUListElement> {}

export default function ListBox({
    className,
    children,
    ...props
}: ListBoxProps) {
    return (
        <ul
            className={cn(
                'm-0 list-none rounded-lg border border-gray-200 bg-white p-0 shadow-sm dark:border-gray-700 dark:bg-gray-800',
                className,
            )}
            {...props}
        >
            {children}
        </ul>
    );
}
