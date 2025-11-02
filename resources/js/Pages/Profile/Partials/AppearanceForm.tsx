import { useBackgroundTheme } from '@/Context/BackgroundThemeContext';
import { useTheme } from '@/Context/ThemeContext';
import { cn } from '@/lib/utils';
import { Icon } from '@iconify/react';
import {
    Card,
    Flex,
    Heading,
    RadioGroup,
    Separator,
    Text,
} from '@radix-ui/themes';

export default function AppearanceForm() {
    const { theme, setTheme } = useTheme();
    const { backgroundTheme, setBackgroundTheme } = useBackgroundTheme();

    return (
        <section>
            <header>
                <Heading as="h2" size="6" weight="bold">
                    Appearance
                </Heading>
                <Text
                    as="p"
                    className="mt-1 text-sm text-gray-600 dark:text-gray-400"
                >
                    Customize the look and feel of your dashboard now.
                </Text>
            </header>

            <Separator my="5" size="4" />

            <Flex direction="column" gap="5">
                {/* Background Theme Selection */}
                <div>
                    <Heading as="h3" size="3" weight="medium" mb="2">
                        Background Theme
                    </Heading>
                    <Flex gap="4" direction={{ initial: 'column', sm: 'row' }}>
                        <Card
                            asChild
                            onClick={() => setBackgroundTheme('nebula')}
                            className={cn(
                                'cursor-pointer transition-all',
                                backgroundTheme === 'nebula' &&
                                    'ring-2 ring-emerald-500',
                            )}
                        >
                            <a>
                                <div className="h-24 w-full rounded bg-gradient-to-br from-emerald-200 via-cyan-300 to-blue-400 dark:from-emerald-900 dark:via-cyan-800 dark:to-blue-900"></div>
                                <Text as="div" size="2" weight="bold" mt="2">
                                    Nebula
                                </Text>
                                <Text as="div" size="1" color="gray">
                                    Green and blue tones.
                                </Text>
                            </a>
                        </Card>
                        <Card
                            asChild
                            onClick={() => setBackgroundTheme('aurora')}
                            className={cn(
                                'cursor-pointer transition-all',
                                backgroundTheme === 'aurora' &&
                                    'ring-2 ring-purple-500',
                            )}
                        >
                            <a>
                                <div className="h-24 w-full rounded bg-gradient-to-br from-pink-300 via-purple-400 to-indigo-500 dark:from-pink-900 dark:via-purple-800 dark:to-indigo-900"></div>
                                <Text as="div" size="2" weight="bold" mt="2">
                                    Aurora
                                </Text>
                                <Text as="div" size="1" color="gray">
                                    Pinks and purple hues.
                                </Text>
                            </a>
                        </Card>
                    </Flex>
                </div>

                {/* Light/Dark Mode Selection */}
                <div>
                    <Heading as="h3" size="3" weight="medium" mb="2">
                        Interface Theme
                    </Heading>
                    <RadioGroup.Root
                        value={theme}
                        onValueChange={(value) => setTheme(value as any)}
                    >
                        <Flex
                            gap="4"
                            direction={{ initial: 'column', sm: 'row' }}
                        >
                            <Card asChild>
                                <label className="flex cursor-pointer items-center gap-3 p-3">
                                    <RadioGroup.Item value="light" />
                                    <Icon
                                        icon="heroicons:sun"
                                        className="h-5 w-5"
                                    />
                                    <Text size="2">Light</Text>
                                </label>
                            </Card>
                            <Card asChild>
                                <label className="flex cursor-pointer items-center gap-3 p-3">
                                    <RadioGroup.Item value="dark" />
                                    <Icon
                                        icon="heroicons:moon"
                                        className="h-5 w-5"
                                    />
                                    <Text size="2">Dark</Text>
                                </label>
                            </Card>
                            <Card asChild>
                                <label className="flex cursor-pointer items-center gap-3 p-3">
                                    <RadioGroup.Item value="system" />
                                    <Icon
                                        icon="heroicons:computer-desktop"
                                        className="h-5 w-5"
                                    />
                                    <Text size="2">System</Text>
                                </label>
                            </Card>
                        </Flex>
                    </RadioGroup.Root>
                </div>
            </Flex>
        </section>
    );
}
