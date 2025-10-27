// resources/js/Components/Badge/SuperUserBadge.tsx
import { Icon } from '@iconify/react';
import * as React from 'react';

interface SuperUserBadgeProps extends React.SVGProps<SVGSVGElement> {
    size?: string | number;
}

const SuperUserBadge = ({
    size = 24,
    className = '',
    ...props
}: SuperUserBadgeProps) => (
    <Icon
        icon="heroicons:bolt-solid" // Example icon
        width={size}
        height={size}
        className={`text-purple-500 ${className}`} // Example color
        {...props}
    />
);

export default SuperUserBadge;
