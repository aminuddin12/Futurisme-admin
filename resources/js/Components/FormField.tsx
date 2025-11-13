import { Box, Text } from '@radix-ui/themes';
import React, {
    isValidElement,
    useId,
    type ComponentProps,
    type PropsWithChildren,
} from 'react';

interface FormFieldProps
    extends PropsWithChildren<
        Omit<ComponentProps<typeof Box>, 'children'> & {
            label: string;
            error?: string;
            htmlFor?: string;
        }
    > {}

export default function FormField({
    label,
    children,
    error,
    htmlFor,
    ...props
}: FormFieldProps) {
    const generatedId = useId();
    const id = htmlFor || generatedId;

    // Clone the child element to inject the `id` prop for accessibility.
    const childWithId =
        isValidElement(children) &&
        !('id' in (children.props as Record<string, unknown>))
            ? React.cloneElement(children as React.ReactElement, { id })
            : children;

    return (
        <Box {...props}>
            <label htmlFor={id}>
                <Text as="div" size="2" weight="medium" mb="1">
                    {label}
                </Text>
            </label>
            {childWithId}
            {error && (
                <Text color="red" size="1" mt="1">
                    {error}
                </Text>
            )}
        </Box>
    );
}
