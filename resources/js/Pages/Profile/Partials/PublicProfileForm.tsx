// resources/js/Pages/Profile/Partials/PublicProfileForm.tsx
import AdminBadge from '@/Components/Badge/AdminBadge'; // Contoh Badge
import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import Box2column from '@/Components/Multi-Sidebar/UI/Box2column';
import ProfileImage from '@/Components/Multi-Sidebar/UI/ProfileImage';
import ActionButton from '@/Components/UI/ActionButton';
import InputLabel from '@/Components/UI/InputLabel';
import TextInput from '@/Components/UI/TextInput';
import { Box, Flex, Text, TextArea } from '@radix-ui/themes';

export default function PublicProfileForm({ user }: { user: any }) {
    // Anda akan menggunakan useForm di sini untuk data yang bisa diubah
    const name = user?.name || 'User Name';
    const email = user?.email || 'user@example.com';

    return (
        <Flex direction="column" gap="6">
            {/* Box 1: Public Account */}
            <BoxItem
                title="Public Account"
                description="This information will be displayed publicly."
                footer={<ActionButton>Save Changes</ActionButton>}
            >
                <Flex direction="column" gap="4">
                    <Flex gap="4" align="center">
                        <ProfileImage user={user} />
                        <div>
                            <Flex align="center" gap="2" mb="1">
                                <Text weight="medium">{name}</Text>
                                {/* Contoh menampilkan badge */}
                                {user?.isAdmin && <AdminBadge size={16} />}
                            </Flex>
                            <Text size="2" color="gray">
                                {email}
                            </Text>
                        </div>
                    </Flex>
                </Flex>
            </BoxItem>

            {/* Box 2: Status & Quote */}
            <BoxItem
                title="Status & Quote"
                description="Set your current status and a personal quote."
                footer={<ActionButton>Save Status</ActionButton>}
            >
                <Flex direction="column" gap="3">
                    <Box>
                        <InputLabel htmlFor="status">Status</InputLabel>
                        <TextInput
                            id="status"
                            placeholder="What's happening?"
                            defaultValue="Working on Futurisme Admin..."
                        />
                    </Box>
                    <Box>
                        <InputLabel htmlFor="quote">Quote</InputLabel>
                        <TextArea
                            id="quote"
                            placeholder="Your favorite quote"
                            defaultValue="Simplicity is the ultimate sophistication."
                        />
                    </Box>
                </Flex>
            </BoxItem>

            {/* Box 3: Account Details (Contoh 2 Kolom) */}
            <BoxItem
                title="Account Details"
                description="Update your account information."
                footer={<ActionButton>Save Details</ActionButton>}
            >
                <Box2column>
                    <Box>
                        <InputLabel htmlFor="username">Username</InputLabel>
                        <TextInput
                            id="username"
                            placeholder="Username"
                            defaultValue={user?.username || ''}
                        />
                    </Box>
                    <Box>
                        <InputLabel htmlFor="phone">Phone Number</InputLabel>
                        <TextInput
                            id="phone"
                            type="tel"
                            placeholder="+62 812..."
                            defaultValue={user?.phone || ''}
                        />
                    </Box>
                    <Box>
                        <InputLabel htmlFor="website">Website</InputLabel>
                        <TextInput
                            id="website"
                            type="url"
                            placeholder="https://example.com"
                            defaultValue={user?.website || ''}
                        />
                    </Box>
                    {/* ... field lainnya */}
                </Box2column>
            </BoxItem>

            {/* Address & Social dipisah jadi form sendiri atau digabung di sini */}
            {/* Contoh jika formnya dipisah: */}
            {/* <AddressProfileForm /> */}
            {/* <SocialMediaForm /> */}
        </Flex>
    );
}
