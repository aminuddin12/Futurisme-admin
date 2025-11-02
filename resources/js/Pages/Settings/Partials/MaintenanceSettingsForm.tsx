import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import ActionButton from '@/Components/UI/ActionButton';
import { WebSettingsProps } from '@/types/page';
import { useForm } from '@inertiajs/react';
import { Flex, Select, Text } from '@radix-ui/themes';

interface MaintenanceSettingsFormProps {
    settings: WebSettingsProps['settings'];
}

export default function MaintenanceSettingsForm({
    settings,
}: MaintenanceSettingsFormProps) {
    const { data, setData, put, errors, processing, recentlySuccessful } =
        useForm({
            site_status: {
                status: settings.site_status?.status ?? 'live',
                options: settings.site_status?.options ?? [
                    'live',
                    'maintenance',
                ],
            },
        });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        put(route('admin.settings.update'), {
            preserveScroll: true,
        });
    };

    return (
        <BoxItem
            title="Maintenance Mode"
            description="Enable or disable maintenance mode for the website."
            footer={
                <ActionButton
                    type="submit"
                    form="maintenance-form"
                    isProcessing={processing}
                    isSuccess={recentlySuccessful}
                >
                    Save Changes
                </ActionButton>
            }
        >
            <form id="maintenance-form" onSubmit={handleSubmit}>
                <Flex direction="column" gap="3">
                    <label>
                        <Text as="div" size="2" mb="1" weight="bold">
                            Website Status
                        </Text>
                        <Select.Root
                            value={data.site_status.status}
                            onValueChange={(value) =>
                                setData('site_status', {
                                    ...data.site_status,
                                    status: value,
                                })
                            }
                        >
                            <Select.Trigger className="w-full" />
                            <Select.Content>
                                {data.site_status.options.map((option) => (
                                    <Select.Item key={option} value={option}>
                                        {option.charAt(0).toUpperCase() +
                                            option.slice(1)}
                                    </Select.Item>
                                ))}
                            </Select.Content>
                        </Select.Root>
                        {errors['site_status.status'] && (
                            <Text color="ruby" size="2" mt="1">
                                {errors['site_status.status']}
                            </Text>
                        )}
                    </label>
                </Flex>
            </form>
        </BoxItem>
    );
}
