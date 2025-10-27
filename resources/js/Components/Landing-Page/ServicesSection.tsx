// resources/js/Components/Landing-Page/ServicesSection.tsx

import { Icon } from '@iconify/react';
import { Flex, Heading, Text } from '@radix-ui/themes';
import { motion } from 'framer-motion';

// 1. Data baru dengan konteks Startup & Layanan
const serviceFeatures = [
    {
        icon: 'heroicons:swatch',
        title: 'Desain Intuitif',
        description:
            'Kami merancang aplikasi dengan UI/UX modern yang tidak hanya cantik, tapi juga mudah digunakan oleh pengguna akhir Anda.',
    },
    {
        icon: 'heroicons:adjustments-horizontal',
        title: 'Kustomisasi Fleksibel',
        description:
            'Setiap startup unik. Layanan kami dapat disesuaikan sepenuhnya untuk memenuhi kebutuhan spesifik dan skalabilitas bisnis Anda.',
    },
    {
        icon: 'heroicons:lifebuoy',
        title: 'Dukungan Penuh',
        description:
            'Tim kami siap membantu Anda 24/7. Kami bukan hanya vendor, tapi mitra strategis Anda dalam mengatasi setiap tantangan teknis.',
    },
    {
        icon: 'heroicons:rocket-launch',
        title: 'Performa Cepat',
        description:
            'Aplikasi yang kami bangun dioptimalkan untuk kecepatan dan keandalan, memastikan pengalaman pengguna yang lancar bahkan saat traffic tinggi.',
    },
];

// 2. Varian animasi untuk stagger (efek muncul satu per satu)
const containerVariants = {
    hidden: { opacity: 0 },
    visible: {
        opacity: 1,
        transition: {
            staggerChildren: 0.1, // Jeda antar kartu
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

export default function ServicesSection() {
    return (
        <section className="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
            <motion.div
                initial="hidden"
                whileInView="visible"
                viewport={{ once: true, amount: 0.3 }}
                variants={itemVariants}
                transition={{ duration: 0.5 }}
                className="text-center"
            >
                <Text
                    as="p"
                    size="2"
                    weight="bold"
                    className="uppercase text-emerald-500"
                >
                    Layanan Unggulan
                </Text>
                <Heading
                    as="h2"
                    size="8" // Ukuran heading besar
                    className="mt-2 font-bold text-black dark:text-white"
                >
                    Solusi Digital Terbaik
                </Heading>
                <Heading
                    as="h3"
                    size="7" // Ukuran heading lebih kecil
                    className="mt-1 font-medium text-gray-700 dark:text-gray-300"
                >
                    untuk Pertumbuhan Startup Anda
                </Heading>
            </motion.div>

            {/* 3. Grid untuk Kartu Layanan */}
            <motion.div
                className="mt-16 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4"
                initial="hidden"
                whileInView="visible"
                viewport={{ once: true, amount: 0.2 }} // Muncul saat 20% terlihat
                variants={containerVariants}
            >
                {serviceFeatures.map((feature) => (
                    <motion.div
                        key={feature.title}
                        variants={itemVariants}
                        // 4. Styling Kartu (Dark/Light Mode)
                        className="rounded-xl bg-gray-100/50 p-6 shadow-sm dark:bg-gray-900/50"
                    >
                        {/* 5. Styling Ikon (Tema Emerald) */}
                        <Flex
                            align="center"
                            justify="center"
                            className="h-10 w-10 rounded-lg bg-emerald-500/10"
                        >
                            <Icon
                                icon={feature.icon}
                                className="h-5 w-5 text-emerald-600 dark:text-emerald-400"
                            />
                        </Flex>

                        <Heading
                            as="h4"
                            size="4"
                            className="mt-5 font-semibold text-black dark:text-white"
                        >
                            {feature.title}
                        </Heading>
                        <Text
                            as="p"
                            size="2"
                            className="mt-2 text-gray-600 dark:text-gray-400"
                        >
                            {feature.description}
                        </Text>
                    </motion.div>
                ))}
            </motion.div>
        </section>
    );
}
