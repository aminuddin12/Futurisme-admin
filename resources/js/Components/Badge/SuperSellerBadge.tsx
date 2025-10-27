// resources/js/Components/Badge/SuperSellerBadge.tsx
import { Icon } from '@iconify/react';
import * as React from 'react';

interface SuperSellerBadgeProps extends React.SVGProps<SVGSVGElement> {
    size?: string | number;
}

const SuperSellerBadge = ({
    size = 24,
    className = '',
    ...props
}: SuperSellerBadgeProps) => (
    <Icon
        icon="heroicons:star-solid" // Example icon
        width={size}
        height={size}
        className={`text-orange-500 ${className}`} // Example color
        {...props}
    />
);

export default SuperSellerBadge;
