// resources/js/Components/Chat/Ui/TypingIndicator.tsx

import { Avatar, Box, Flex } from '@radix-ui/themes';
import { motion } from 'framer-motion';
import React from 'react';

interface TypingIndicatorProps {
    senderAvatar?: string;
    senderName?: string;
}

const dotVariants = {
    start: {
        y: '0%',
    },
    end: {
        y: '100%',
    },
};

const dotTransition = {
    duration: 0.5,
    repeat: Infinity,
    repeatType: 'reverse' as const,
    ease: [0.42, 0, 0.58, 1], // cubic-bezier for easeInOut
};

export default function TypingIndicator({
    senderAvatar,
    senderName,
}: TypingIndicatorProps) {
    return (
        <Flex direction="row" gap="2" align="end">
            {/* Opsional: Avatar pengirim yang sedang mengetik */}
            {senderAvatar && (
                <Avatar
                    fallback={senderName?.charAt(0) || '?'}
                    src={senderAvatar}
                    radius="full"
                    size="2"
                    className="mb-1"
                />
            )}
            <Box
                className="flex min-h-[38px] max-w-[70%] items-center justify-center space-x-1 rounded-lg rounded-bl-none bg-white px-3 py-2 text-gray-800 shadow-sm dark:bg-gray-700 dark:text-gray-100"
                style={
                    {
                        // Styling tambahan untuk "ekor" bubble di sudut kiri bawah
                        position: 'relative',
                        '--bubble-tail-color': 'white', // Warna ekor
                        '--bubble-tail-color-dark': '#374151', // Warna ekor dark mode
                    } as React.CSSProperties
                } // Cast ke CSSProperties
            >
                {/* Styling ekor bubble menggunakan pseudo-element */}
                <style>{`
                    .dark .bubble-tail::before {
                        background-color: var(
                            --bubble-tail-color-dark
                        ) !important;
                    }
                    .bubble-tail::before {
                        content: '';
                        position: absolute;
                        bottom: 0;
                        left: -8px; /* Sesuaikan posisi horizontal */
                        width: 10px;
                        height: 10px;
                        background-color: var(--bubble-tail-color);
                        clip-path: polygon(
                            0% 100%,
                            100% 100%,
                            100% 0%
                        ); /* Segitiga di sudut bawah kiri */
                        transform: rotate(
                            45deg
                        ); /* Putar agar lebih mirip ekor */
                        transform-origin: bottom right; /* Titik putar */
                    }
                `}</style>
                <div className="bubble-tail"></div>{' '}
                {/* Placeholder untuk pseudo-element */}
                {/* Tiga Titik Bergerak */}
                {[0, 1, 2].map((i) => (
                    <motion.span
                        key={i}
                        className="block h-2 w-2 rounded-full bg-gray-400 dark:bg-gray-500"
                        variants={dotVariants}
                        initial="start"
                        animate="end"
                        transition={{ ...dotTransition, delay: i * 0.1 }}
                    />
                ))}
            </Box>
        </Flex>
    );
}
