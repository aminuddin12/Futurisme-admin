import { Icon } from '@iconify/react';
import { Badge } from '@radix-ui/themes';

export default function SuperSellerBadge() {
    return (
        <Badge color="orange">
            <Icon icon="heroicons:star-solid" className="mr-1 h-3 w-3" />
            Super Seller
        </Badge>
    );
}
