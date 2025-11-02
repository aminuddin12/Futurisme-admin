import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import ButtonDanger from '@/Components/UI/ButtonDanger';
import { Text } from '@radix-ui/themes';
export default function AccountDeleteForm() {
    return (
        <BoxItem
            title="Delete Account"
            description="Permanently delete your account."
        >
            <Text as="p" size="2" color="gray" mb="4">
                Once deleted, all data will be permanently lost.
            </Text>
            <ButtonDanger>Delete Account</ButtonDanger>
        </BoxItem>
    );
}
