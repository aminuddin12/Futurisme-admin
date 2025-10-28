// resources/js/Pages/Profile/Partials/CustomForm.tsx
import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import { Text } from '@radix-ui/themes';

interface CustomFormProps {
    title: string;
    description?: string;
}

export default function CustomForm({ title, description }: CustomFormProps) {
    return (
        <BoxItem title={title} description={description}>
            <Text color="gray">Content for {title} will appear here.</Text>
        </BoxItem>
    );
}
