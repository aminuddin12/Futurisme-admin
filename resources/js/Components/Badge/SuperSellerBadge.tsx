// resources/js/Components/Badge/SuperSellerBadge.tsx
import { Icon } from '@iconify/react';
import * as React from 'react';
interface Props extends React.SVGProps<SVGSVGElement> {
    size?: string | number;
}
const SuperSellerBadge = ({ size = 18, className = '', ...props }: Props) => (
    <Icon
        icon="heroicons:star-solid"
        width={size}
        height={size}
        className={`text-orange-500 ${className}`}
        {...props}
    />
);
export default SuperSellerBadge;
