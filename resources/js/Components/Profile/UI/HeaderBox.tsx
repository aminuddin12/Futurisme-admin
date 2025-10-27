import React from 'react';

interface HeaderBoxProps {
    title?: string;
    description?: string;
    actions?: React.ReactNode;
}

export default function HeaderBox({
    title,
    description,
    actions,
}: HeaderBoxProps) {
    return (
        <div className="border-b border-gray-200 bg-gray-50 px-6 py-4 md:flex md:items-center md:justify-between dark:border-gray-700 dark:bg-gray-700/50">
            <div className="min-w-0 flex-1">
                {title && (
                    <h2 className="text-lg font-semibold leading-6 text-gray-900 dark:text-white">
                        {title}
                    </h2>
                )}
                {description && (
                    <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {description}
                    </p>
                )}
            </div>
            {actions && (
                <div className="mt-4 flex md:ml-4 md:mt-0">{actions}</div>
            )}
        </div>
    );
}
