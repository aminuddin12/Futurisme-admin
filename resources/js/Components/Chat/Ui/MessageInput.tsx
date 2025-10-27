// resources/js/Components/Chat/Ui/MessageInput.tsx
import { Icon } from '@iconify/react';
import { Box, IconButton, TextField } from '@radix-ui/themes';
import React, { useState } from 'react';

interface MessageInputProps {
    onSendMessage: (messageText: string) => void;
}

export default function MessageInput({ onSendMessage }: MessageInputProps) {
    const [message, setMessage] = useState('');

    const handleSend = () => {
        if (message.trim()) {
            onSendMessage(message);
            setMessage('');
        }
    };

    const handleKeyDown = (event: React.KeyboardEvent<HTMLInputElement>) => {
        if (event.key === 'Enter' && !event.shiftKey) {
            // Kirim dengan Enter (bukan Shift+Enter)
            event.preventDefault();
            handleSend();
        }
    };

    return (
        <Box
            p="4"
            className="border-t bg-gray-50 dark:border-gray-700 dark:bg-gray-800"
        >
            {' '}
            {/* Beri background */}
            <TextField.Root
                placeholder="Type a message..."
                size="3"
                value={message}
                onChange={(e) => setMessage(e.target.value)}
                onKeyDown={handleKeyDown}
                // Styling input agar lebih mirip
                className="!rounded-lg !border-gray-300 !bg-white focus:!border-emerald-500 focus:!ring-emerald-500 dark:!border-gray-600 dark:!bg-gray-700"
            >
                {/* Tombol Kirim */}
                <TextField.Slot side="right">
                    <IconButton
                        variant="ghost"
                        color="gray"
                        onClick={handleSend}
                        disabled={!message.trim()}
                    >
                        <Icon
                            icon="heroicons:paper-airplane-solid"
                            className="h-5 w-5 rotate-90"
                        />
                    </IconButton>
                </TextField.Slot>
                {/* Opsional: Tombol Attachment */}
                {/* <TextField.Slot side="left">
                    <IconButton variant="ghost" color="gray">
                        <Icon icon="heroicons:paper-clip" className="h-5 w-5"/>
                    </IconButton>
                </TextField.Slot> */}
            </TextField.Root>
        </Box>
    );
}
