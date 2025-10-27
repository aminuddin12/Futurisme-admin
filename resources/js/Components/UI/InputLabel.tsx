// resources/js/Components/UI/InputLabel.tsx
import { Text } from '@radix-ui/themes';
import React from 'react';

export default function InputLabel({
    value,
    className = '',
    children,
    ...props
}: {
    value?: string;
    className?: string;
    children?: React.ReactNode;
}) {
    return (
        <Text
            as="label"
            size="2"
            weight="medium"
            className={`mb-1 block text-gray-700 dark:text-gray-300 ${className}`}
            {...props}
        >
            {value ? value : children}
        </Text>
    );
}
