// resources/js/Components/UI/Dialog.tsx
import * as RadixDialog from '@radix-ui/react-dialog'; // Impor sebagai namespace
import { Cross2Icon } from '@radix-ui/react-icons';
import { IconButton } from '@radix-ui/themes';
import { AnimatePresence, motion } from 'framer-motion';
import React from 'react';

interface DialogProps {
    open: boolean;
    onOpenChange: (open: boolean) => void;
    title?: string;
    description?: string;
    children: React.ReactNode;
    hideCloseButton?: boolean;
    contentProps?: RadixDialog.DialogContentProps;
}

export default function Dialog({
    open,
    onOpenChange,
    title,
    description,
    children,
    hideCloseButton = false,
    contentProps = {},
}: DialogProps) {
    return (
        <RadixDialog.Root open={open} onOpenChange={onOpenChange}>
            <AnimatePresence>
                {open && (
                    <RadixDialog.Portal forceMount>
                        <RadixDialog.Overlay asChild forceMount>
                            <motion.div
                                className="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm"
                                initial={{ opacity: 0 }}
                                animate={{ opacity: 1 }}
                                exit={{ opacity: 0 }}
                            />
                        </RadixDialog.Overlay>
                        <RadixDialog.Content
                            asChild
                            forceMount
                            {...contentProps}
                        >
                            <motion.div
                                className="fixed left-1/2 top-1/2 z-50 w-full max-w-lg -translate-x-1/2 -translate-y-1/2 rounded-lg border border-gray-200 bg-white p-6 shadow-lg dark:border-gray-700 dark:bg-gray-800"
                                initial={{ opacity: 0, scale: 0.95, y: '-48%' }}
                                animate={{ opacity: 1, scale: 1, y: '-50%' }}
                                exit={{ opacity: 0, scale: 0.95, y: '-48%' }}
                                transition={{ duration: 0.2 }}
                            >
                                {title && (
                                    <RadixDialog.Title className="mb-2 text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {title}
                                    </RadixDialog.Title>
                                )}
                                {description && (
                                    <RadixDialog.Description className="mb-4 text-sm text-gray-500 dark:text-gray-400">
                                        {description}
                                    </RadixDialog.Description>
                                )}

                                {children}

                                {!hideCloseButton && (
                                    <RadixDialog.Close asChild>
                                        <IconButton
                                            variant="ghost"
                                            color="gray"
                                            className="absolute right-4 top-4"
                                            aria-label="Close"
                                        >
                                            <Cross2Icon />
                                        </IconButton>
                                    </RadixDialog.Close>
                                )}
                            </motion.div>
                        </RadixDialog.Content>
                    </RadixDialog.Portal>
                )}
            </AnimatePresence>
        </RadixDialog.Root>
    );
}
