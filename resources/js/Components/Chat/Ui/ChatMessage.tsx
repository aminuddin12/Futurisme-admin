import { Box, Flex, Text } from '@radix-ui/themes';
import { cn } from '@/lib/utils';
import React from 'react';

export interface Message {
    id: number | string;
    senderId?: number | string;
    senderName?: string;
    senderAvatar?: string;
    text: string;
    time: string;
    isMe: boolean;
    isNew?: boolean;
}

interface ChatMessageProps {
    message: Message;
}

export default function ChatMessage({ message }: ChatMessageProps) {
    return (
        <Flex
            direction={message.isMe ? 'row-reverse' : 'row'}
            gap="2"
            align="end"
        >
            <Box
                className={cn(
                    'max-w-[70%] rounded-lg px-3 py-2 shadow-sm',
                    message.isMe
                        ? 'rounded-br-none bg-emerald-500 text-white'
                        : 'rounded-bl-none bg-white text-gray-800 dark:bg-gray-700 dark:text-gray-100',
                )}
            >
                <Text size="2" className="whitespace-pre-wrap">
                    {message.text}
                </Text>
                <Text
                    size="1"
                    className={cn(
                        'mt-1 block text-right opacity-70',
                        message.isMe
                            ? 'text-emerald-100'
                            : 'text-gray-500 dark:text-gray-400',
                    )}
                >
                    {message.time}
                </Text>
            </Box>
        </Flex>
    );
}
