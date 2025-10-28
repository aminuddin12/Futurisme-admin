// resources/js/Pages/Profile/Partials/AccountDeleteForm.tsx
// (Salin kode AccountDeleteForm.tsx dari respons sebelumnya, bungkus dengan BoxItem jika mau)
import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import ButtonDanger from '@/Components/UI/ButtonDanger'; // Gunakan ButtonDanger
import { Text } from '@radix-ui/themes';

export default function AccountDeleteForm() {
    return (
        <BoxItem
            title="Delete Account"
            description="Permanently delete your account."
        >
            <Text as="p" size="2" color="gray" mb="4">
                Once your account is deleted, all of its resources and data will
                be permanently deleted. Before deleting your account, please
                download any data or information that you wish to retain.
            </Text>
            <ButtonDanger>Delete Account</ButtonDanger>
        </BoxItem>
    );
}
