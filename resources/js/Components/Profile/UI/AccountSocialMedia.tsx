// resources/js/Components/Profile/UI/AccountSocialMedia.tsx
import React from 'react';
import { Heading, Box, Text, Flex, TextField } from '@radix-ui/themes';
import { Icon } from '@iconify/react';

export default function AccountSocialMedia() {
     return (
        <Box>
            <Heading size="5" mb="4" weight="medium">Social Media</Heading>
             <Flex direction="column" gap="3">
                 {/* Placeholder */}
                 <Box>
                     <Text as="label" size="2" weight="medium" mb="1" display="block">LinkedIn</Text>
                     <TextField.Root placeholder="linkedin.com/in/username">
                         <TextField.Slot><Icon icon="mdi:linkedin" height="16" width="16" /></TextField.Slot>
                     </TextField.Root>
                 </Box>
                  <Box>
                     <Text as="label" size="2" weight="medium" mb="1" display="block">Twitter</Text>
                     <TextField.Root placeholder="twitter.com/username">
                         <TextField.Slot><Icon icon="mdi:twitter" height="16" width="16" /></TextField.Slot>
                     </TextField.Root>
                 </Box>
             </Flex>
        </Box>
    );
}
