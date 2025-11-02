import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import ActionButton from '@/Components/UI/ActionButton';
import { Text } from '@radix-ui/themes';

export default function SeoSettingsForm() {
    return (
        <BoxItem
            title="SEO Settings"
            description="Configure settings for search engine optimization."
            footer={<ActionButton>Save SEO Settings</ActionButton>}
        >
            <Text color="gray">Form content for SEO Settings.</Text>
        </BoxItem>
    );
}
