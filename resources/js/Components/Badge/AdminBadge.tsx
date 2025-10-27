import React from 'react';

export default function AdminBadge({
    className = '',
    ...props
}: React.HTMLAttributes<HTMLSpanElement>) {
    return (
        <span
            className={`inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-semibold text-red-800 dark:bg-red-900/50 dark:text-red-300 ${className}`}
            {...props}
        >
            Admin
        </span>
    );
}
