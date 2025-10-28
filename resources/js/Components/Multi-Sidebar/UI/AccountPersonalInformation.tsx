// resources/js/Components/Profile/UI/AccountPersonalInformation.tsx
import FormField from '@/Components/FormField';
import { User } from '@/types';
import { useForm } from '@inertiajs/react';
import { Box, Button, Flex, Heading, Text, TextField } from '@radix-ui/themes';

export default function AccountPersonalInformation({ user }: { user: User }) {
    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            name: user.name || '',
            email: user.email || '',
        });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        // Asumsi ada route 'profile.update' di backend Anda
        patch(route('profile.update'), {
            preserveScroll: true,
        });
    };

    return (
        <Box>
            <Heading size="5" mb="4" weight="medium">
                Personal Information
            </Heading>
            <form onSubmit={handleSubmit}>
                <Flex direction="column" gap="3">
                    <FormField label="Full Name" error={errors.name}>
                        <TextField.Root
                            value={data.name}
                            onChange={(e) => setData('name', e.target.value)}
                            placeholder="Full Name"
                        />
                    </FormField>

                    <FormField label="Email Address" error={errors.email}>
                        <TextField.Root
                            type="email"
                            value={data.email}
                            placeholder="Email Address"
                            disabled
                            className="cursor-not-allowed"
                        />
                    </FormField>

                    <Flex justify="end" mt="4" align="center">
                        {recentlySuccessful && (
                            <Text size="2" color="green" mr="3">
                                Saved.
                            </Text>
                        )}
                        <Button
                            type="submit"
                            loading={processing}
                            disabled={processing}
                        >
                            Save
                        </Button>
                    </Flex>
                </Flex>
            </form>
        </Box>
    );
}
