// resources/js/Pages/Profile/Partials/AccountHistoryList.tsx
import React from 'react';
import { Box, Heading, Text } from '@radix-ui/themes';

export default function AccountHistoryList() {
    return (
        <Box>
            <Heading size="5" mb="4" weight="medium">Account History</Heading>
            <Text color="gray">List of recent activities will appear here.</Text>
            {/* Tampilkan list history nanti */}
        </Box>
    );
}
