import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import Box2column from '@/Components/Multi-Sidebar/UI/Box2column';
import ProfileImage from '@/Components/Multi-Sidebar/UI/ProfileImage';
import ActionButton from '@/Components/UI/ActionButton';
import InputLabel from '@/Components/UI/InputLabel';
import TextInput from '@/Components/UI/TextInput';
import { User } from '@/types';
import { Flex, Text, TextArea } from '@radix-ui/themes';

export default function PublicProfileForm({
    user,
}: {
    user: User | null | undefined;
}) {
    return (
        <Flex direction="column" gap="6">
            <BoxItem
                title="Public Profile"
                description="This information will be displayed publicly."
                footer={<ActionButton>Save Changes</ActionButton>}
            >
                <Flex align="center" gap="4">
                    <ProfileImage user={user} />
                    <div>
                        <Text weight="medium">{user?.name || 'User Name'}</Text>
                        <Text size="2" color="gray">
                            {user?.email || 'user@example.com'}
                        </Text>
                    </div>
                </Flex>
            </BoxItem>
            <BoxItem
                title="Status & Quote"
                description="Set your current status and a personal quote."
                footer={<ActionButton>Save Status</ActionButton>}
            >
                <Flex direction="column" gap="3">
                    <div>
                        <InputLabel htmlFor="status">Status</InputLabel>
                        <TextInput
                            id="status"
                            placeholder="What's happening?"
                        />
                    </div>
                    <div>
                        <InputLabel htmlFor="quote">Quote</InputLabel>
                        <TextArea
                            id="quote"
                            placeholder="Your favorite quote"
                        />
                    </div>
                </Flex>
            </BoxItem>
            <BoxItem
                title="Account Details"
                description="Update your account information."
                footer={<ActionButton>Save Details</ActionButton>}
            >
                <Box2column>
                    <div>
                        <InputLabel htmlFor="username">Username</InputLabel>
                        <TextInput
                            id="username"
                            placeholder="Username"
                            defaultValue={user?.name || ''}
                        />
                    </div>
                </Box2column>
            </BoxItem>
        </Flex>
    );
}
