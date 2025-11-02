import { Text } from '@radix-ui/themes';
const InputError = ({ message }: { message?: string }) =>
    message ? (
        <Text color="red" size="1" className="mt-1">
            {message}
        </Text>
    ) : null;

InputError.displayName = 'InputError';
export default InputError;
