// resources/js/Components/UI/InputError.tsx
import { Text } from '@radix-ui/themes';

export default function InputError({
    message,
    className = '',
    ...props
}: {
    message?: string;
    className?: string;
}) {
    return message ? (
        <Text color="red" size="1" className={className} {...props}>
            {message}
        </Text>
    ) : null;
}
