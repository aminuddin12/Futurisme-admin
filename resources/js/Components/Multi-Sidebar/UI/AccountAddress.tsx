// resources/js/Components/Profile/UI/AccountAddress.tsx
import FormField from '@/Components/FormField';
import { User } from '@/types';
import { useForm } from '@inertiajs/react';
import { Box, Button, Flex, Heading, Text, TextField } from '@radix-ui/themes';

export default function AccountAddress({ user }: { user: User }) {
    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            street: user.street || '',
            city: user.city || '',
            postal_code: user.postal_code || '',
        });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        // Asumsi ada route 'profile.update.address' di backend Anda
        patch(route('profile.update.address'), {
            preserveScroll: true,
        });
    };

    return (
        <Box>
            <Heading size="5" mb="4" weight="medium">
                Address
            </Heading>
            <form onSubmit={handleSubmit}>
                <Flex direction="column" gap="3">
                    <FormField label="Street Address" error={errors.street}>
                        <TextField.Root
                            placeholder="123 Main St"
                            value={data.street}
                            onChange={(e) => setData('street', e.target.value)}
                        />
                    </FormField>

                    <Flex gap="3">
                        <FormField
                            label="City"
                            flexGrow="1"
                            error={errors.city}
                        >
                            <TextField.Root
                                placeholder="Anytown"
                                value={data.city}
                                onChange={(e) =>
                                    setData('city', e.target.value)
                                }
                            />
                        </FormField>

                        <FormField
                            label="Postal Code"
                            flexGrow="1"
                            error={errors.postal_code}
                        >
                            <TextField.Root
                                placeholder="12345"
                                value={data.postal_code}
                                onChange={(e) =>
                                    setData('postal_code', e.target.value)
                                }
                            />
                        </FormField>
                    </Flex>
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
                            Save Address
                        </Button>
                    </Flex>
                </Flex>
            </form>
        </Box>
    );
}
