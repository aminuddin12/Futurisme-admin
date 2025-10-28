// resources/js/Components/Badge/VerifiedBadge.tsx
import { Icon } from '@iconify/react';
import * as React from 'react';
interface Props extends React.SVGProps<SVGSVGElement> {
    size?: string | number;
}
const VerifiedBadge = ({ size = 18, className = '', ...props }: Props) => (
    <Icon
        icon="heroicons:check-badge-solid"
        width={size}
        height={size}
        className={`text-blue-500 ${className}`}
        {...props}
    />
);
export default VerifiedBadge;
