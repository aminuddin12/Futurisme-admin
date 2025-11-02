import BoxItem from '@/Components/Multi-Sidebar/BoxItem';
import { Text } from '@radix-ui/themes';
interface Props {
    title: string;
    description?: string;
}
export default function CustomForm({ title, description }: Props) {
    return (
        <BoxItem title={title} description={description}>
            <Text color="gray">Content for {title}</Text>
        </BoxItem>
    );
}
