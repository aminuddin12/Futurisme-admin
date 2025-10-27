// resources/js/Components/Landing-Page/BankingServicesSection.tsx

import { Icon } from '@iconify/react';
import { Button, Heading, Text } from '@radix-ui/themes';
import { motion } from 'framer-motion';

// Data untuk service cards, Anda bisa menambah/mengubah ini
const services = [
    {
        icon: 'heroicons:banknotes',
        title: 'Checking accounts',
        description:
            'Lorem ipsum dolor sit amet consectetur sit nulla malesuada aenean iaculis.',
    },
    {
        icon: 'heroicons:credit-card',
        title: 'Credit cards',
        description:
            'Lorem ipsum dolor sit amet consectetur sit nulla malesuada aenean iaculis.',
    },
    {
        icon: 'heroicons:piggy-bank',
        title: 'Saving accounts',
        description:
            'Lorem ipsum dolor sit amet consectetur sit nulla malesuada aenean iaculis.',
    },
    {
        icon: 'heroicons:chart-pie',
        title: 'Investment services',
        description:
            'Lorem ipsum dolor sit amet consectetur sit nulla malesuada aenean iaculis.',
    },
    {
        icon: 'heroicons:building-office-2',
        title: 'Business loans',
        description:
            'Lorem ipsum dolor sit amet consectetur sit nulla malesuada aenean iaculis.',
    },
    {
        icon: 'heroicons:rocket-launch',
        title: 'Startup funding',
        description:
            'Lorem ipsum dolor sit amet consectetur sit nulla malesuada aenean iaculis.',
    },
];

// Varian animasi untuk stagger (efek muncul satu per satu)
const containerVariants = {
    hidden: { opacity: 0 },
    visible: {
        opacity: 1,
        transition: {
            staggerChildren: 0.1,
        },
    },
};

const itemVariants = {
    hidden: { opacity: 0, y: 20 },
    visible: {
        opacity: 1,
        y: 0,
    },
};

export default function BankingServicesSection() {
    return (
        <section className="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
            <motion.div
                initial="hidden"
                whileInView="visible"
                viewport={{ once: true, amount: 0.3 }}
                variants={itemVariants}
                transition={{ duration: 0.5 }}
            >
                <div className="flex flex-col items-center justify-between gap-4 sm:flex-row">
                    <div className="text-center sm:text-left">
                        <Text
                            as="p"
                            size="2"
                            weight="bold"
                            className="uppercase text-emerald-500"
                        >
                            Features
                        </Text>
                        <Heading
                            as="h2"
                            size="7"
                            className="mt-1 text-black dark:text-white"
                        >
                            Browse our set of banking services
                        </Heading>
                    </div>
                    <Button
                        variant="soft"
                        highContrast
                        className="!bg-gray-200/50 !text-black dark:!bg-gray-800/50 dark:!text-white"
                    >
                        Open your account
                        <Icon icon="heroicons:arrow-right-solid" />
                    </Button>
                </div>
            </motion.div>

            <motion.div
                className="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3"
                initial="hidden"
                whileInView="visible"
                viewport={{ once: true, amount: 0.2 }}
                variants={containerVariants}
            >
                {services.map((service) => (
                    <motion.div
                        key={service.title}
                        variants={itemVariants}
                        className="rounded-xl bg-gray-100/50 p-6 shadow-sm dark:bg-gray-900/50"
                    >
                        <Icon
                            icon={service.icon}
                            className="h-8 w-8 text-emerald-500"
                        />
                        <Heading
                            as="h3"
                            size="4"
                            className="mt-4 text-black dark:text-white"
                        >
                            {service.title}
                        </Heading>
                        <Text
                            as="p"
                            size="2"
                            className="mt-2 text-gray-600 dark:text-gray-400"
                        >
                            {service.description}
                        </Text>
                    </motion.div>
                ))}
            </motion.div>
        </section>
    );
}
