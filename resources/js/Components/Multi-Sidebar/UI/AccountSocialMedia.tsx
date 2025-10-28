// resources/js/Components/Profile/UI/AccountSocialMedia.tsx
import FormField from '@/Components/FormField';
import { User } from '@/types';
import { Icon } from '@iconify/react';
import { useForm } from '@inertiajs/react';
import { Box, Button, Flex, Heading, Text, TextField } from '@radix-ui/themes';

interface AccountSocialMediaProps {
    user: User; // Expecting user prop to pre-fill social media links
}

export default function AccountSocialMedia({ user }: AccountSocialMediaProps) {
    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            linkedin_url: user.linkedin_url || '',
            twitter_url: user.twitter_url || '',
            // Tambahkan field media sosial lain di sini jika diperlukan
        });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        // Asumsi ada route 'profile.update.social_media' di backend Anda
        patch(route('profile.update.social_media'), {
            preserveScroll: true, // Pertahankan posisi scroll setelah submit
            onSuccess: () => {
                console.log('Social media links updated successfully!');
                // Anda bisa menambahkan notifikasi toast di sini
            },
            onError: (formErrors) => {
                console.error('Error updating social media:', formErrors);
            },
        });
    };

    return (
        <Box>
            <Heading size="5" mb="4" weight="medium">
                Social Media
            </Heading>
            <form onSubmit={handleSubmit}>
                <Flex direction="column" gap="3">
                    <FormField
                        label="LinkedIn Profile URL"
                        error={errors.linkedin_url}
                    >
                        <TextField.Root
                            placeholder="https://linkedin.com/in/username"
                            value={data.linkedin_url}
                            onChange={(e) =>
                                setData('linkedin_url', e.target.value)
                            }
                        >
                            <TextField.Slot>
                                <Icon
                                    icon="mdi:linkedin"
                                    height="16"
                                    width="16"
                                />
                            </TextField.Slot>
                        </TextField.Root>
                    </FormField>

                    <FormField
                        label="Twitter Profile URL"
                        error={errors.twitter_url}
                    >
                        <TextField.Root
                            placeholder="https://twitter.com/username"
                            value={data.twitter_url}
                            onChange={(e) =>
                                setData('twitter_url', e.target.value)
                            }
                        >
                            <TextField.Slot>
                                <Icon
                                    icon="mdi:twitter"
                                    height="16"
                                    width="16"
                                />
                            </TextField.Slot>
                        </TextField.Root>
                    </FormField>

                    {/* Tambahkan field media sosial lain di sini jika diperlukan */}

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
                            Save Changes
                        </Button>
                    </Flex>
                </Flex>
            </form>
        </Box>
    );
}
