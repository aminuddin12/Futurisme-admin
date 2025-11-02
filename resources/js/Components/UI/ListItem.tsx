import { cn } from '@/lib/utils';
import React from 'react';
export default ({
    className,
    children,
    ...props
}: React.HTMLAttributes<HTMLLIElement>) => (
    <ListItem
        className={cn(
            'cursor-pointer rounded-md px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700',
            className,
        )}
        {...props}
    >
        {children}
    </ListItem>
);

const ListItem = ({
    className,
    children,
    ...props
}: React.HTMLAttributes<HTMLLIElement>) => (
    <li
        className={cn(
            'cursor-pointer rounded-md px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700',
            className,
        )}
        {...props}
    >
        {children}
    </li>
);

ListItem.displayName = 'ListItem';
