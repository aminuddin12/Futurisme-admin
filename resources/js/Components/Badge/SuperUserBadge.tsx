// resources/js/Components/Badge/SuperUserBadge.tsx
import { Icon } from '@iconify/react';
import * as React from 'react';
interface Props extends React.SVGProps<SVGSVGElement> {
    size?: string | number;
}
const SuperUserBadge = ({ size = 18, className = '', ...props }: Props) => (
    <Icon
        icon="heroicons:bolt-solid"
        width={size}
        height={size}
        className={`text-purple-500 ${className}`}
        {...props}
    />
);
export default SuperUserBadge;
