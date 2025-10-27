// resources/js/Components/Profile/UI/AccountUser.tsx
import { Avatar, Box, Button, Flex, Heading, Text } from '@radix-ui/themes';

import AccountAddress from './AccountAddress';
import AccountPersonalInformation from './AccountPersonalInformation';

// Terima data user sebagai props nanti
export default function AccountUser({ user }: { user: any }) {
    return (
        <Box>
            {/* Bagian Account */}
            <Heading size="5" mb="4" weight="medium">
                Account Details
            </Heading>
            <Flex direction="column" gap="4">
                <Flex align="center" gap="4">
                    <Avatar
                        radius="full"
                        size="5"
                        fallback={user?.name?.charAt(0) || 'A'}
                        src={user?.avatar_url}
                    />
                    <Box flexGrow="1">
                        <Text as="div" weight="medium">
                            {user?.name || 'User Name'}
                        </Text>
                        <Text as="div" size="2" color="gray">
                            {user?.email || 'user@example.com'}
                        </Text>
                    </Box>
                    <Button variant="outline" color="gray" size="2">
                        Change Avatar
                    </Button>
                </Flex>
                <Text size="2" color="gray">
                    Member since: January 2024
                </Text>
            </Flex>
        </Box>
        <AccountPersonalInformation />
        <AccountAddress />
    );
}
