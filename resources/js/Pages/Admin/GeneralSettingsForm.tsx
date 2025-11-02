import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import ActionButton from '@/Components/UI/ActionButton';
import { Text } from '@radix-ui/themes';

export default function GeneralSettingsForm() {
    return (
        <BoxItem
            title="General Settings"
            description="Update general website information."
            footer={<ActionButton>Save Changes</ActionButton>}
        >
            <Text color="gray">Form content for General Settings.</Text>
        </BoxItem>
    );
}
