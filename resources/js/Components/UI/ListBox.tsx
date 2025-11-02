import React from 'react';
import { cn } from '@/lib/utils';
export default ({ className, children, ...props }: React.HTMLAttributes<HTMLUListElement>) => (
    <ul className={cn('list-none p-1 m-0 border dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 shadow-sm', className)} {...props}>{children}</ul>
);
