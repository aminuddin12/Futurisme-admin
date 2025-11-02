import { Icon } from '@iconify/react';
import { Badge } from '@radix-ui/themes';

export default function SuperUserBadge() {
    return (
        <Badge color="purple">
            <Icon icon="heroicons:bolt-solid" className="mr-1 h-3 w-3" />
            Super User
        </Badge>
    );
}
