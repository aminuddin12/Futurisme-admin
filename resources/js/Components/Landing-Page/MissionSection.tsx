// resources/js/Components/Landing-Page/MissionSection.tsx

import { Heading, Text } from '@radix-ui/themes';
import { motion } from 'framer-motion';

export default function MissionSection() {
    return (
        <section className="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
            <motion.div
                className="grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-16"
                initial="hidden"
                whileInView="visible"
                viewport={{ once: true, amount: 0.3 }}
                transition={{ staggerChildren: 0.2 }}
            >
                <motion.div
                    variants={{
                        hidden: { opacity: 0, x: -50 },
                        visible: {
                            opacity: 1,
                            x: 0,
                            transition: { duration: 0.6 },
                        },
                    }}
                >
                    <Text
                        as="p"
                        size="2"
                        weight="bold"
                        className="uppercase text-emerald-500"
                    >
                        More about us
                    </Text>
                    <Heading
                        as="h2"
                        size="7"
                        className="mt-1 text-black dark:text-white"
                    >
                        Discover the mission and story behind our company
                    </Heading>
                </motion.div>

                <motion.div
                    variants={{
                        hidden: { opacity: 0, x: 50 },
                        visible: {
                            opacity: 1,
                            x: 0,
                            transition: { duration: 0.6 },
                        },
                    }}
                >
                    <Text
                        as="p"
                        size="3"
                        className="text-gray-600 dark:text-gray-400"
                    >
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quasi, repellendus. Lorem ipsum dolor sit amet
                        consectetur adipisicing elit. Officiis, dolor. Amet
                        minima, id enim et nobis cumque, exercitationem
                        voluptatibus non facilis, quasi at!
                    </Text>
                </motion.div>
            </motion.div>
        </section>
    );
}
