// resources/js/Pages/Profile/Partials/AddressProfileForm.tsx
import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import ActionButton from '@/Components/UI/ActionButton';
import InputLabel from '@/Components/UI/InputLabel';
import TextInput from '@/Components/UI/TextInput';
import { Box, Flex } from '@radix-ui/themes';

export default function AddressProfileForm() {
    return (
        <BoxItem
            title="Address"
            description="Update your address details."
            footer={<ActionButton>Save Address</ActionButton>}
        >
            <Flex direction="column" gap="3">
                <Box>
                    <InputLabel htmlFor="street">Street Address</InputLabel>
                    <TextInput id="street" placeholder="123 Main St" />
                </Box>
                <Flex gap="3">
                    <Box flexGrow="1">
                        <InputLabel htmlFor="city">City</InputLabel>
                        <TextInput id="city" placeholder="Anytown" />
                    </Box>
                    <Box flexGrow="1">
                        <InputLabel htmlFor="postal">Postal Code</InputLabel>
                        <TextInput id="postal" placeholder="12345" />
                    </Box>
                </Flex>
            </Flex>
        </BoxItem>
    );
}
