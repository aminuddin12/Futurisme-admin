// resources/js/Pages/Profile/Partials/AccountDeleteForm.tsx
import React from 'react';
import { Box, Heading, Text, Button } from '@radix-ui/themes';

export default function AccountDeleteForm() {
    return (
        <Box>
            <Heading size="5" mb="2" weight="medium" color="red">Delete Account</Heading>
            <Text as="p" size="2" color="gray" mb="4">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
            </Text>
            <Button color="red">Delete Account</Button>
        </Box>
    );
}
