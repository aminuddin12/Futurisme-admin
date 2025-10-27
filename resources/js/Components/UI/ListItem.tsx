import React from 'react';

/**
 * Interface defining the properties for the ListItem component.
 */
interface ListItemProps {
    /** The main text or label to display for the list item. */
    label: string;
    /** Optional secondary text or description. */
    description?: string;
    /** Optional React node to display as an icon or prefix. */
    icon?: React.ReactNode;
    /** Optional React node for actions (e.g., button, link, badge) on the right side. */
    actions?: React.ReactNode;
    /** Optional CSS class names for custom styling. */
    className?: string;
    /** Optional click handler function. */
    onClick?: () => void;
    /** Optional href to make the item a link. */
    href?: string;
    /** Optional prop to indicate if the item is active. */
    isActive?: boolean;
}

/**
 * A reusable list item component designed to display data within a list.
 * It supports a primary label, an optional description, an icon, and actions.
 */
export default function ListItem({
    label,
    description,
    icon,
    actions,
    className = '',
    onClick,
    href,
    isActive = false,
}: ListItemProps) {
    // Determine the wrapper element based on whether it's clickable or a link
    const WrapperElement = href ? 'a' : onClick ? 'button' : 'div';
    const wrapperProps = href
        ? { href }
        : onClick
          ? { type: 'button' as const, onClick }
          : {};

    return (
        <WrapperElement
            {...wrapperProps}
            className={`flex w-full items-center justify-between px-4 py-3 text-left ${onClick || href ? 'cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700' : ''} ${className}`}
            aria-current={isActive ? 'page' : undefined}
        >
            {/* Left side: Icon and Text */}
            <div className="flex min-w-0 items-center gap-3">
                {icon && (
                    <span className="h-5 w-5 flex-shrink-0 text-gray-500 dark:text-gray-400">
                        {icon}
                    </span>
                )}
                <div className="min-w-0 flex-1">
                    <p className="truncate text-sm font-medium text-gray-900 dark:text-white">
                        {label}
                    </p>
                    {description && (
                        <p className="truncate text-xs text-gray-500 dark:text-gray-400">
                            {description}
                        </p>
                    )}
                </div>
            </div>

            {/* Right side: Actions */}
            {actions && <div className="ml-4 flex-shrink-0">{actions}</div>}
        </WrapperElement>
    );
}
