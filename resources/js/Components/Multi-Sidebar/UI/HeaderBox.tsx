// resources/js/Components/Profile/UI/HeaderBox.tsx
import { Heading, Text } from '@radix-ui/themes';

interface HeaderBoxProps {
    title: string;
    description?: string;
}

export default function HeaderBox({ title, description }: HeaderBoxProps) {
    return (
        <div>
            <Heading
                as="h3"
                size="4"
                weight="medium"
                className="text-gray-900 dark:text-gray-100"
            >
                {title}
            </Heading>
            {description && (
                <Text as="p" size="2" color="gray" mt="1">
                    {description}
                </Text>
            )}
        </div>
    );
}
