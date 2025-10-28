// resources/js/Components/UI/InputError.tsx
import { Text } from '@radix-ui/themes';
export default function InputError({
    message,
    className = '',
}: {
    message?: string;
    className?: string;
}) {
    return message ? (
        <Text color="red" size="1" className={`mt-1 ${className}`}>
            {message}
        </Text>
    ) : null;
}
