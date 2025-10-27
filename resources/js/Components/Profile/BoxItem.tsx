import React from 'react';
import HeaderBox from './UI/HeaderBox';

interface BoxItemProps {
    title?: string; // Optional title for the header
    description?: string; // Optional description
    actions?: React.ReactNode; // Optional action buttons for the header
    children: React.ReactNode;
    className?: string; // Allow additional styling
}

export default function BoxItem({
    title,
    description,
    actions,
    children,
    className = '',
}: BoxItemProps) {
    return (
        <div
            className={`overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800 ${className}`}
        >
            {(title || description || actions) && (
                <HeaderBox
                    title={title}
                    description={description}
                    actions={actions}
                />
            )}
            <div className="p-6">{children}</div>
        </div>
    );
}
