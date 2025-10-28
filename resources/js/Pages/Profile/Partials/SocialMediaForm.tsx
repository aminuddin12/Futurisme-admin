// resources/js/Pages/Profile/Partials/SocialMediaForm.tsx
import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import ActionButton from '@/Components/UI/ActionButton';
import InputLabel from '@/Components/UI/InputLabel';
import TextInput from '@/Components/UI/TextInput';
import { Icon } from '@iconify/react';
import { Box, Flex } from '@radix-ui/themes';

export default function SocialMediaForm() {
    return (
        <BoxItem
            title="Social Media"
            description="Connect your social accounts."
            footer={<ActionButton>Save Links</ActionButton>}
        >
            <Flex direction="column" gap="3">
                <Box>
                    <InputLabel htmlFor="linkedin">LinkedIn</InputLabel>
                    <TextInput
                        id="linkedin"
                        placeholder="linkedin.com/in/username"
                        leftSlot={
                            <Icon icon="mdi:linkedin" height="16" width="16" />
                        }
                    />
                </Box>
                <Box>
                    <InputLabel htmlFor="twitter">Twitter</InputLabel>
                    <TextInput
                        id="twitter"
                        placeholder="twitter.com/username"
                        leftSlot={
                            <Icon icon="mdi:twitter" height="16" width="16" />
                        }
                    />
                </Box>
            </Flex>
        </BoxItem>
    );
}
