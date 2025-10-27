import React from 'react';

interface ListItemProps {
    label: string;
    isActive: boolean;
    onClick: () => void;
    icon?: React.ReactNode;
}

export default function ListItem({ label, isActive, onClick }: ListItemProps) {
    return (
        <li>
            <button
                type="button"
                onClick={onClick}
                className={`flex w-full items-center gap-3 rounded-md px-3 py-2 text-left text-sm font-medium transition-colors duration-150 ease-in-out ${
                    isActive
                        ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700/50 dark:hover:text-white'
                }`}
            >
                {/* Optional Icon Placeholder */}
                {/* {icon && <span className="flex-shrink-0 w-5 h-5">{icon}</span>} */}
                <span>{label}</span>
            </button>
        </li>
    );
}
