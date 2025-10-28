// resources/js/Components/Profile/UI/AccountUser.tsx
import { User } from '@/types';
import { Box, Flex, Heading, Text } from '@radix-ui/themes';
import { useEffect, useState } from 'react';

import AccountAddress from './AccountAddress';
import AccountPersonalInformation from './AccountPersonalInformation';
import ProfileImage from './ProfileImage';

/**
 * A component that formats and renders a date only on the client-side
 * to prevent server-client hydration mismatch due to timezones.
 */
function ClientOnlyDate({
    dateString,
    options,
}: {
    dateString: string | undefined;
    options: Intl.DateTimeFormatOptions;
}) {
    const [formattedDate, setFormattedDate] = useState<string | null>(null);

    useEffect(() => {
        setFormattedDate(
            dateString
                ? new Date(dateString).toLocaleDateString('en-US', options)
                : 'Not available',
        );
    }, [dateString, options]);

    if (formattedDate === null) {
        return '...'; // Placeholder during server render and initial client render
    }

    return <>{formattedDate}</>;
}

export default function AccountUser({ user }: { user: User }) {
    return (
        // Wrap all components in a single root element for valid JSX
        <Flex direction="column" gap="6">
            <Box>
                {/* Bagian Account */}
                <Heading size="5" mb="4" weight="medium">
                    Account Details
                </Heading>
                <Flex direction="column" gap="4">
                    <Flex align="center" gap="4">
                        {/* Use the reusable ProfileImage component */}
                        <ProfileImage user={user} />
                        <Box flexGrow="1">
                            <Text as="div" weight="medium">
                                {user.name}
                            </Text>
                            <Text as="div" size="2" color="gray">
                                {user.email}
                            </Text>
                        </Box>
                    </Flex>
                    <Text size="2" color="gray" as="p">
                        Member since:{' '}
                        <ClientOnlyDate
                            dateString={user.created_at}
                            options={{ month: 'long', year: 'numeric' }}
                        />
                    </Text>
                </Flex>
            </Box>
            {/* Pass the user prop to child components */}
            <AccountPersonalInformation user={user} />
            <AccountAddress user={user} />
        </Flex>
    );
}
