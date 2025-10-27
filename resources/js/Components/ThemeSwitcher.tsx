// resources/js/Components/Landing-Page/ThemeSwitcher.tsx

import { useTheme } from '@/Context/ThemeContext'; // Impor hook kita
import { Icon } from '@iconify/react';
import { Button, DropdownMenu } from '@radix-ui/themes';

export default function ThemeSwitcher() {
    const { setTheme } = useTheme();

    return (
        <DropdownMenu.Root>
            <DropdownMenu.Trigger>
                <Button variant="ghost" color="gray">
                    <Icon
                        icon="heroicons:sun"
                        className="h-5 w-5 rotate-0 scale-100 transition-all dark:-rotate-90 dark:scale-0"
                    />
                    <Icon
                        icon="heroicons:moon"
                        className="absolute h-5 w-5 rotate-90 scale-0 transition-all dark:rotate-0 dark:scale-100"
                    />
                    <span className="sr-only">Toggle theme</span>
                </Button>
            </DropdownMenu.Trigger>
            <DropdownMenu.Content>
                <DropdownMenu.Item onClick={() => setTheme('light')}>
                    <Icon icon="heroicons:sun" className="mr-2 h-4 w-4" />
                    Light
                </DropdownMenu.Item>
                <DropdownMenu.Item onClick={() => setTheme('dark')}>
                    <Icon icon="heroicons:moon" className="mr-2 h-4 w-4" />
                    Dark
                </DropdownMenu.Item>
                <DropdownMenu.Item onClick={() => setTheme('system')}>
                    <Icon
                        icon="heroicons:computer-desktop"
                        className="mr-2 h-4 w-4"
                    />
                    System
                </DropdownMenu.Item>
            </DropdownMenu.Content>
        </DropdownMenu.Root>
    );
}
