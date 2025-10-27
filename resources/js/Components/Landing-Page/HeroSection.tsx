// resources/js/Components/Landing-Page/HeroSection.tsx

import { Icon } from '@iconify/react';
import { Button, Flex, Heading, Text } from '@radix-ui/themes';
import { motion } from 'framer-motion';
import FloatingFormulas from './FloatingFormulas';

export default function HeroSection() {
    const features = [
        'The Lab™ Native platform',
        'Fast progress',
        'No time Limit Prop firm',
        'Unique programs',
    ];

    return (
        <section className="relative flex min-h-screen items-center overflow-hidden">
            <div className="absolute left-1/2 top-1/2 z-0 h-[400px] w-[400px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-emerald-500/20 opacity-50 [filter:blur(120px)]" />
            <FloatingFormulas />
            <div className="relative z-10 mx-auto max-w-7xl px-4">
                <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.8, delay: 0.2 }}
                >
                    <Flex
                        direction="column"
                        align="center"
                        gap="4"
                        className="py-20 text-center" // py-20 untuk memberi ruang dari header
                    >
                        <Text
                            size="3"
                            className="font-medium tracking-wide text-gray-700 dark:text-gray-200"
                        >
                            Our Capital
                            <span className="mx-3 text-gray-400 dark:text-gray-600">
                                |
                            </span>
                            Your Success
                        </Text>

                        <Heading
                            as="h1"
                            size={{ initial: '8', md: '9' }}
                            className="!font-bold leading-tight text-black dark:text-white"
                        >
                            No Time Limit Prop Firm
                        </Heading>
                        <Heading
                            as="h2"
                            size={{ initial: '8', md: '9' }}
                            className="!font-semibold leading-tight text-gray-700 dark:text-gray-300"
                        >
                            Conquer the market
                        </Heading>

                        <Flex
                            gap={{ initial: '3', sm: '5' }}
                            my="3"
                            wrap="wrap"
                            justify="center"
                        >
                            {features.map((feature) => (
                                <Flex
                                    key={feature}
                                    align="center"
                                    gap="2"
                                    className="text-sm text-gray-600 dark:text-gray-400"
                                >
                                    <Icon
                                        icon="heroicons:check-badge-solid"
                                        className="h-5 w-5 text-emerald-500"
                                    />
                                    {feature}
                                </Flex>
                            ))}
                        </Flex>

                        <Flex gap="4" mt="4" justify="center" align="center">
                            <Button
                                size="3"
                                highContrast
                                className="!bg-black !text-white dark:!bg-white dark:!text-black"
                            >
                                Start a challenge
                                <Icon icon="heroicons:arrow-right-solid" />
                            </Button>
                            <Button size="3" variant="outline" color="gray">
                                Free trial
                            </Button>
                        </Flex>
                    </Flex>
                </motion.div>
            </div>
        </section>
    );
}
