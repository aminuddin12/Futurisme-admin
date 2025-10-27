// resources/js/Components/Profile/UI/AccountAddress.tsx
import React from 'react';
import { Heading, Box, Text, Flex, TextField } from '@radix-ui/themes';

export default function AccountAddress() {
     return (
        <Box>
            <Heading size="5" mb="4" weight="medium">Address</Heading>
             <Flex direction="column" gap="3">
                 {/* Placeholder - Ganti dengan form/data asli */}
                 <Box>
                     <Text as="label" size="2" weight="medium" mb="1" display="block">Street Address</Text>
                     <TextField.Root placeholder="123 Main St" />
                 </Box>
                 <Flex gap="3">
                     <Box flexGrow="1">
                         <Text as="label" size="2" weight="medium" mb="1" display="block">City</Text>
                         <TextField.Root placeholder="Anytown" />
                     </Box>
                     <Box flexGrow="1">
                         <Text as="label" size="2" weight="medium" mb="1" display="block">Postal Code</Text>
                         <TextField.Root placeholder="12345" />
                     </Box>
                 </Flex>
             </Flex>
        </Box>
    );
}
