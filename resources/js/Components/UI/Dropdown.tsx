// resources/js/Components/UI/Dropdown.tsx
import * as RadixDropdown from '@radix-ui/react-dropdown-menu'; // Impor sebagai namespace
import { AnimatePresence, motion } from 'framer-motion';
import React from 'react';

interface DropdownProps {
    trigger: React.ReactNode;
    children: React.ReactNode;
    contentProps?: RadixDropdown.DropdownMenuContentProps;
}

export default function Dropdown({
    trigger,
    children,
    contentProps = {},
}: DropdownProps) {
    const [open, setOpen] = React.useState(false);
    return (
        <RadixDropdown.Root open={open} onOpenChange={setOpen}>
            <RadixDropdown.Trigger asChild>{trigger}</RadixDropdown.Trigger>
            <AnimatePresence>
                {open && (
                    <RadixDropdown.Portal forceMount>
                        <RadixDropdown.Content
                            asChild
                            forceMount
                            sideOffset={5}
                            align="end"
                            className="z-50 min-w-[8rem] overflow-hidden rounded-md border border-gray-200 bg-white p-1 shadow-md dark:border-gray-700 dark:bg-gray-800"
                            {...contentProps}
                        >
                            <motion.div
                                initial={{ opacity: 0, scale: 0.95 }}
                                animate={{ opacity: 1, scale: 1 }}
                                exit={{ opacity: 0, scale: 0.95 }}
                                transition={{ duration: 0.1 }}
                            >
                                {children}
                            </motion.div>
                        </RadixDropdown.Content>
                    </RadixDropdown.Portal>
                )}
            </AnimatePresence>
        </RadixDropdown.Root>
    );
}

// Export item-itemnya juga agar mudah digunakan
export const DropdownItem = RadixDropdown.Item;
export const DropdownCheckboxItem = RadixDropdown.CheckboxItem;
export const DropdownRadioItem = RadixDropdown.RadioItem;
export const DropdownSeparator = RadixDropdown.Separator;
export const DropdownLabel = RadixDropdown.Label;
export const DropdownRadioGroup = RadixDropdown.RadioGroup;
