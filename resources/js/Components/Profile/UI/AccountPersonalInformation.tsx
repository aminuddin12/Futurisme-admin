// resources/js/Components/Profile/UI/AccountPersonalInformation.tsx
import React from 'react';
import { Heading, Box, Text, Flex, TextField } from '@radix-ui/themes';

// Terima data user sebagai props nanti
export default function AccountPersonalInformation({ user }: { user: any }) {
     return (
        <Box>
            <Heading size="5" mb="4" weight="medium">Personal Information</Heading>
            <Flex direction="column" gap="3">
                 {/* Ini akan diganti form di Partials */}
                <Box>
                    <Text as="label" size="2" weight="medium" mb="1" display="block">Full Name</Text>
                    <TextField.Root defaultValue={user?.name || 'User Name'} placeholder="Full Name" />
                </Box>
                 <Box>
                    <Text as="label" size="2" weight="medium" mb="1" display="block">Email Address</Text>
                    <TextField.Root type="email" defaultValue={user?.email || 'user@example.com'} placeholder="Email Address" disabled/>
                </Box>
                 {/* Tambahkan field lain */}
            </Flex>
        </Box>
    );
}
