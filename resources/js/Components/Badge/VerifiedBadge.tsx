// resources/js/Components/Badge/VerifiedBadge.tsx
import { Icon } from '@iconify/react';
import * as React from 'react';

interface VerifiedBadgeProps extends React.SVGProps<SVGSVGElement> {
    size?: string | number; // Optional size prop
}

const VerifiedBadge = ({
    size = 24,
    className = '',
    ...props
}: VerifiedBadgeProps) => (
    // Simple placeholder using Iconify
    <Icon
        icon="heroicons:check-badge-solid"
        width={size}
        height={size}
        className={`text-blue-500 ${className}`} // Example color
        {...props}
    />
);

export default VerifiedBadge;
