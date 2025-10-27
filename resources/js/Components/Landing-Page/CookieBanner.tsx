// resources/js/Components/Landing-Page/CookieBanner.tsx

import { Button, Flex, Text } from '@radix-ui/themes';
import { motion } from 'framer-motion';
import { useState } from 'react';

export default function CookieBanner() {
    const [isVisible, setIsVisible] = useState(true);

    if (!isVisible) {
        return null;
    }

    return (
        <motion.div
            initial={{ opacity: 0, y: 50 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 2, duration: 0.5 }}
            className="fixed bottom-10 left-1/2 z-50 w-full max-w-3xl -translate-x-1/2 px-4"
        >
            <div className="flex flex-col items-center justify-between gap-4 rounded-full bg-gray-200/70 p-4 backdrop-blur-md sm:flex-row sm:p-3 dark:bg-gray-800/70">
                <Text
                    size="2"
                    className="text-center text-gray-700 sm:pl-4 dark:text-gray-300"
                >
                    We use cookies and other technology to provide you with our
                    services and for functional, analytical and advertising
                    purposes.
                </Text>
                <Flex gap="3" flexShrink="0">
                    <Button
                        variant="ghost"
                        color="gray"
                        onClick={() => setIsVisible(false)}
                    >
                        Decline
                    </Button>
                    <Button
                        highContrast
                        onClick={() => setIsVisible(false)}
                        className="!bg-black !text-white dark:!bg-white dark:!text-black"
                    >
                        Accept
                    </Button>
                </Flex>
            </div>
        </motion.div>
    );
}
