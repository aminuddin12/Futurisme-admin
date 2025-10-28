// resources/js/Pages/Profile/Partials/PaymentForm.tsx
import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import { Text } from '@radix-ui/themes';

export default function PaymentForm() {
    return (
        <BoxItem
            title="Payment Methods"
            description="Manage your billing information."
        >
            <Text color="gray">
                Payment details and options will appear here.
            </Text>
        </BoxItem>
    );
}
