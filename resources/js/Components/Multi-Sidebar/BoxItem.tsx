// resources/js/Components/Profile/BoxItem.tsx
import { cn } from '@/lib/utils';
import { Box, Separator } from '@radix-ui/themes';
import React from 'react';
import HeaderBox from './UI/HeaderBox'; // Impor HeaderBox

interface BoxItemProps {
    title: string;
    description?: string;
    children: React.ReactNode;
    className?: string;
    contentClassName?: string;
    footer?: React.ReactNode; // Slot untuk footer/tombol
}

export default function BoxItem({
    title,
    description,
    children,
    className,
    contentClassName,
    footer,
}: BoxItemProps) {
    return (
        <Box
            className={cn(
                'border border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800 sm:rounded-lg',
                className,
            )}
        >
            <div className="px-4 py-5 sm:px-6">
                <HeaderBox title={title} description={description} />
            </div>
            <Separator className="dark:!bg-gray-700" />
            <div className={cn('px-4 py-5 sm:p-6', contentClassName)}>
                {children}
            </div>
            {footer && (
                <>
                    <Separator className="dark:!bg-gray-700" />
                    <div className="flex items-center justify-end gap-4 rounded-b-lg bg-gray-50 px-4 py-3 dark:bg-gray-800/50 sm:px-6">
                        {footer}
                    </div>
                </>
            )}
        </Box>
    );
}
