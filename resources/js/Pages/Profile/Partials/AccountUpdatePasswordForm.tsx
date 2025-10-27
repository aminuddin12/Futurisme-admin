// resources/js/Pages/Profile/Partials/AccountUpdatePasswordForm.tsx
import React from 'react';
import { Box, Heading, Text, Flex, TextField, Button } from '@radix-ui/themes';

export default function AccountUpdatePasswordForm() {
    return (
        <Box>
            <Heading size="5" mb="4" weight="medium">Update Password</Heading>
             <Flex direction="column" gap="3">
                 <Box>
                     <Text as="label" size="2" weight="medium" mb="1" display="block">Current Password</Text>
                     <TextField.Root type="password" placeholder="••••••••" />
                 </Box>
                  <Box>
                     <Text as="label" size="2" weight="medium" mb="1" display="block">New Password</Text>
                     <TextField.Root type="password" placeholder="••••••••" />
                 </Box>
                  <Box>
                     <Text as="label" size="2" weight="medium" mb="1" display="block">Confirm New Password</Text>
                     <TextField.Root type="password" placeholder="••••••••" />
                 </Box>
                 <Flex justify="end" mt="4">
                     <Button>Save Password</Button>
                 </Flex>
             </Flex>
        </Box>
    );
}
