import { Icon } from '@iconify/react';
import { Badge } from '@radix-ui/themes';

export default function VerifiedBadge() {
    return (
        <Badge color="blue">
            <Icon icon="heroicons:check-badge-solid" className="mr-1 h-3 w-3" />
            Verified
        </Badge>
    );
}
