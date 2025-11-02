import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import ActionButton from '@/Components/UI/ActionButton';
import { WebSettingsProps } from '@/types/page';
import { useForm } from '@inertiajs/react';
import { Flex, Select, Text, TextField } from '@radix-ui/themes';

interface GeneralSettingsFormProps {
    settings: WebSettingsProps['settings'];
}

export default function GeneralSettingsForm({
    settings,
}: GeneralSettingsFormProps) {
    const { data, setData, put, errors, processing, recentlySuccessful } =
        useForm({
            sitename: { value: settings.sitename?.value ?? '' },
            site_url: { url: settings.site_url?.url ?? '' },
            site_locale: {
                code: settings.site_locale?.code ?? 'id',
                options: settings.site_locale?.options ?? ['id', 'en'],
            },
            site_timezone: { zone: settings.site_timezone?.zone ?? 'UTC' },
        });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('admin.settings.update'), {
            preserveScroll: true,
        });
    };

    return (
        <BoxItem
            title="General Settings"
            description="Update general website information."
            footer={
                <ActionButton
                    type="submit"
                    form="general-form"
                    isProcessing={processing}
                    isSuccess={recentlySuccessful}
                >
                    Save Changes
                </ActionButton>
            }
        >
            <form id="general-form" onSubmit={handleSubmit}>
                <Flex direction="column" gap="4">
                    <label>
                        <Text as="div" size="2" mb="1" weight="bold">
                            Site Name
                        </Text>
                        <TextField.Root
                            value={data.sitename.value}
                            onChange={(e) =>
                                setData('sitename', { value: e.target.value })
                            }
                        />
                        {errors['sitename.value'] && (
                            <Text color="ruby" size="2" mt="1">
                                {errors['sitename.value']}
                            </Text>
                        )}
                    </label>

                    <label>
                        <Text as="div" size="2" mb="1" weight="bold">
                            Site URL
                        </Text>
                        <TextField.Root
                            type="url"
                            value={data.site_url.url}
                            onChange={(e) =>
                                setData('site_url', { url: e.target.value })
                            }
                        />
                        {errors['site_url.url'] && (
                            <Text color="ruby" size="2" mt="1">
                                {errors['site_url.url']}
                            </Text>
                        )}
                    </label>

                    <label>
                        <Text as="div" size="2" mb="1" weight="bold">
                            Site Locale
                        </Text>
                        <Select.Root
                            value={data.site_locale.code}
                            onValueChange={(value) =>
                                setData('site_locale', {
                                    ...data.site_locale,
                                    code: value,
                                })
                            }
                        >
                            <Select.Trigger className="w-full" />
                            <Select.Content>
                                {data.site_locale.options.map((option) => (
                                    <Select.Item key={option} value={option}>
                                        {option.toUpperCase()}
                                    </Select.Item>
                                ))}
                            </Select.Content>
                        </Select.Root>
                        {errors['site_locale.code'] && (
                            <Text color="ruby" size="2" mt="1">
                                {errors['site_locale.code']}
                            </Text>
                        )}
                    </label>

                    <label>
                        <Text as="div" size="2" mb="1" weight="bold">
                            Timezone
                        </Text>
                        <TextField.Root
                            value={data.site_timezone.zone}
                            onChange={(e) =>
                                setData('site_timezone', {
                                    zone: e.target.value,
                                })
                            }
                        />
                        {errors['site_timezone.zone'] && (
                            <Text color="ruby" size="2" mt="1">
                                {errors['site_timezone.zone']}
                            </Text>
                        )}
                    </label>
                </Flex>
            </form>
        </BoxItem>
    );
}
