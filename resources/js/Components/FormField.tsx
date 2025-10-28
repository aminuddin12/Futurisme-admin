import { Box, Text } from '@radix-ui/themes';
import React, { isValidElement, useId, type ComponentProps } from 'react';

interface FormFieldProps extends Omit<ComponentProps<typeof Box>, 'children'> {
    label: string;
    error?: string;
    htmlFor?: string;
    children: React.ReactNode;
}

/**
 * A reusable and accessible form field component.
 * It wraps a label, the input control (children), and an optional error message.
 * It automatically links the label to the input using a generated ID for accessibility.
 */
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
