import { Text } from '@radix-ui/themes';
import React from 'react';
const InputLabel = (props: React.LabelHTMLAttributes<HTMLLabelElement>) => (
    <Text
        as="label"
        size="2"
        weight="medium"
        className="mb-1 block text-gray-700 dark:text-gray-300"
        {...props}
    />
);

InputLabel.displayName = 'InputLabel';
export default InputLabel;
