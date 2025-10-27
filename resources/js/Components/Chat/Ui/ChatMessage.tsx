// resources/js/Components/Chat/Ui/ChatMessage.tsx

import { Box, Flex, Text } from '@radix-ui/themes';
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
    const bubbleClasses = `
        max-w-[70%] px-3 py-2 shadow-sm relative // Tambah relative untuk pseudo-element
        ${
            message.isMe
                ? 'bg-emerald-500 text-white rounded-lg rounded-br-none' // Pesan saya
                : 'bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 rounded-lg rounded-bl-none' // Pesan lain
        }
    `;

    return (
        <Flex
            direction={message.isMe ? 'row-reverse' : 'row'}
            gap="2"
            align="end"
        >
            {/* Opsional: Tampilkan Avatar untuk Pengirim Lain */}
            {/* (!message.isMe && message.senderAvatar) && (
                <Avatar
                    fallback={message.senderName?.charAt(0) || '?'}
                    src={message.senderAvatar}
                    radius="full"
                    size="2"
                    className="mb-1 flex-shrink-0"
                 />
            )} */}

            <Box
                className={bubbleClasses}
                style={
                    {
                        '--bubble-tail-color-me': '#10b981', // emerald-500
                        '--bubble-tail-color-me-dark': '#10b981', // tetap emerald untuk dark mode (sesuaikan jika perlu)
                        '--bubble-tail-color-other': 'white',
                        '--bubble-tail-color-other-dark': '#374151', // gray-700
                    } as React.CSSProperties
                }
            >
                {/* Pseudo-element untuk ekor bubble */}
                <style>{`
                    .dark .bubble-tail-me::before {
                        background-color: var(
                            --bubble-tail-color-me-dark
                        ) !important;
                    }
                    .bubble-tail-me::before {
                        content: '';
                        position: absolute;
                        bottom: 0;
                        right: -8px; /* Sesuaikan posisi horizontal untuk pesan saya */
                        width: 10px;
                        height: 10px;
                        background-color: var(--bubble-tail-color-me);
                        clip-path: polygon(
                            0% 100%,
                            100% 100%,
                            100% 0%
                        ); /* Segitiga di sudut bawah kanan */
                        transform: rotate(-45deg); /* Putar untuk pesan saya */
                        transform-origin: bottom left;
                    }

                    .dark .bubble-tail-other::before {
                        background-color: var(
                            --bubble-tail-color-other-dark
                        ) !important;
                    }
                    .bubble-tail-other::before {
                        content: '';
                        position: absolute;
                        bottom: 0;
                        left: -8px; /* Sesuaikan posisi horizontal untuk pesan lain */
                        width: 10px;
                        height: 10px;
                        background-color: var(--bubble-tail-color-other);
                        clip-path: polygon(
                            0% 100%,
                            100% 100%,
                            100% 0%
                        ); /* Segitiga di sudut bawah kiri */
                        transform: rotate(45deg); /* Putar untuk pesan lain */
                        transform-origin: bottom right;
                    }
                `}</style>
                <div
                    className={`bubble-tail-${message.isMe ? 'me' : 'other'}`}
                ></div>

                <Text size="2" className="whitespace-pre-wrap">
                    {message.text}
                </Text>
                <Text
                    size="1"
                    className={`mt-1 block text-right opacity-70 ${message.isMe ? 'text-emerald-100' : 'text-gray-500 dark:text-gray-400'}`}
                >
                    {message.time}
                </Text>
            </Box>
        </Flex>
    );
}
