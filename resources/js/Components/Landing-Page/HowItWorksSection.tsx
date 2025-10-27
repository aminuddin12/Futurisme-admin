// resources/js/Components/Landing-Page/HowItWorksSection.tsx

import { Icon } from '@iconify/react';
import * as Accordion from '@radix-ui/react-accordion';
import { Flex, Heading, Text } from '@radix-ui/themes';
import { motion } from 'framer-motion';

export default function HowItWorksSection() {
    return (
        <section className="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
            <div className="grid grid-cols-1 gap-12 lg:grid-cols-2 lg:gap-16">
                {/* Kolom Kiri: Phone Mockup */}
                <motion.div
                    initial={{ opacity: 0, x: -50 }}
                    whileInView={{ opacity: 1, x: 0 }}
                    viewport={{ once: true, amount: 0.3 }}
                    transition={{ duration: 0.6 }}
                >
                    {/* Placeholder untuk Phone Mockup */}
                    <div className="relative mx-auto h-[500px] w-[250px] rounded-3xl border-8 border-gray-300 bg-gray-100 p-2 dark:border-gray-700 dark:bg-gray-900">
                        <div className="h-full w-full rounded-2xl bg-white p-4 dark:bg-black">
                            {/* Konten Mockup Sederhana */}
                            <Heading
                                size="3"
                                className="text-black dark:text-white"
                            >
                                Create account
                            </Heading>
                            <Text
                                size="1"
                                className="mt-2 text-gray-600 dark:text-gray-400"
                            >
                                EMAIL ADDRESS
                            </Text>
                            <div className="mt-1 h-8 w-full rounded bg-gray-100 dark:bg-gray-800" />
                            <Text
                                size="1"
                                className="mt-4 text-gray-600 dark:text-gray-400"
                            >
                                PASSWORD
                            </Text>
                            <div className="mt-1 h-8 w-full rounded bg-gray-100 dark:bg-gray-800" />
                            <div className="mt-6 h-10 w-full rounded-lg bg-emerald-500" />
                        </div>
                    </div>
                </motion.div>

                {/* Kolom Kanan: Accordion */}
                <motion.div
                    initial={{ opacity: 0, x: 50 }}
                    whileInView={{ opacity: 1, x: 0 }}
                    viewport={{ once: true, amount: 0.3 }}
                    transition={{ duration: 0.6 }}
                >
                    <Text
                        as="p"
                        size="2"
                        weight="bold"
                        className="uppercase text-emerald-500"
                    >
                        Why Us?
                    </Text>
                    <Heading
                        as="h2"
                        size="7"
                        className="mt-1 text-black dark:text-white"
                    >
                        How it works?
                    </Heading>

                    <div className="mt-8 space-y-4">
                        {/* Radix Accordion untuk item pertama */}
                        <Accordion.Root
                            type="single"
                            defaultValue="item-1"
                            collapsible
                        >
                            <Accordion.Item
                                value="item-1"
                                className="rounded-xl bg-gray-100/50 p-4 dark:bg-gray-900/50"
                            >
                                <Accordion.Trigger className="w-full">
                                    <Flex align="center" gap="3">
                                        <Icon
                                            icon="heroicons:pencil-square"
                                            className="h-6 w-6 text-emerald-500"
                                        />
                                        <Text
                                            weight="medium"
                                            className="text-black dark:text-white"
                                        >
                                            Create account
                                        </Text>
                                    </Flex>
                                </Accordion.Trigger>
                                <Accordion.Content className="pl-9 pt-2">
                                    <Text
                                        size="2"
                                        className="text-gray-600 dark:text-gray-400"
                                    >
                                        Lorem ipsum dolor sit amet consectetur
                                        velit gravida malesuada aenean iaculis.
                                        <span className="mt-2 block cursor-pointer font-medium text-emerald-500">
                                            LEARN MORE
                                        </span>
                                    </Text>
                                </Accordion.Content>
                            </Accordion.Item>
                        </Accordion.Root>

                        {/* Item statis untuk sisanya (sesuai gambar) */}
                        <div className="flex items-center justify-between rounded-xl bg-gray-100/50 p-4 dark:bg-gray-900/50">
                            <Flex align="center" gap="3">
                                <Icon
                                    icon="heroicons:credit-card"
                                    className="h-6 w-6 text-gray-500"
                                />
                                <Text
                                    weight="medium"
                                    className="text-gray-700 dark:text-gray-300"
                                >
                                    Get your card
                                </Text>
                            </Flex>
                            <Icon
                                icon="heroicons:chevron-right"
                                className="h-5 w-5 text-gray-500"
                            />
                        </div>
                        <div className="flex items-center justify-between rounded-xl bg-gray-100/50 p-4 dark:bg-gray-900/50">
                            <Flex align="center" gap="3">
                                <Icon
                                    icon="heroicons:chart-bar"
                                    className="h-6 w-6 text-gray-500"
                                />
                                <Text
                                    weight="medium"
                                    className="text-gray-700 dark:text-gray-300"
                                >
                                    Start investing
                                </Text>
                            </Flex>
                            <Icon
                                icon="heroicons:chevron-right"
                                className="h-5 w-5 text-gray-500"
                            />
                        </div>
                    </div>
                </motion.div>
            </div>
        </section>
    );
}
