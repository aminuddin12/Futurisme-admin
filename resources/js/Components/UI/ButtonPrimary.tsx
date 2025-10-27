import React from 'react';

/**
 * Interface defining the properties for the ButtonPrimary component.
 */
interface ButtonPrimaryProps
    extends React.ButtonHTMLAttributes<HTMLButtonElement> {
    /** Optional React node to display as an icon, usually placed before the text. */
    icon?: React.ReactNode;
    /** Button text or other child elements. */
    children: React.ReactNode;
    /** Whether the button is currently in a loading or processing state. */
    processing?: boolean;
}

/**
 * A reusable primary action button component.
 * It supports an optional icon and displays a loading state when processing.
 */
export default function ButtonPrimary({
    children,
    icon,
    className = '',
    processing = false,
    disabled,
    ...props // Pass down other standard button props like 'onClick', 'type', 'aria-label', etc.
}: ButtonPrimaryProps) {
    const isDisabled = disabled || processing;

    return (
        <button
            type="button" // Default to 'button', can be overridden via props (e.g., type="submit")
            disabled={isDisabled}
            className={`inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition-colors duration-150 ease-in-out hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:focus:ring-offset-gray-800 ${className}`}
            {...props}
        >
            {/* Show loading spinner if processing, otherwise show icon if provided */}
            {processing ? (
                <svg
                    className="-ml-1 mr-2 h-5 w-5 animate-spin text-white"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle
                        className="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        strokeWidth="4"
                    ></circle>
                    <path
                        className="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                    ></path>
                </svg>
            ) : (
                icon && <span className="h-5 w-5 flex-shrink-0">{icon}</span> // Render icon if provided and not processing
            )}
            {children}
        </button>
    );
}
