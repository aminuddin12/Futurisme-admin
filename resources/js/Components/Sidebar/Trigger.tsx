import { cn } from '@/lib/utils';
import { Icon } from '@iconify/react';
import * as Tooltip from '@radix-ui/react-tooltip';
import { Flex, IconButton } from '@radix-ui/themes';
import { useSidebar } from './modeChanger';

interface TriggerProps {
    className?: string;
}

export default function Trigger({ className }: TriggerProps) {
    const { mode, toggleMode } = useSidebar();

    // Mode 'full': Tombol minimize sederhana
    if (mode === 'full') {
        return (
            <IconButton
                size="1"
                variant="ghost"
                color="gray"
                onClick={toggleMode}
                className={cn(
                    'text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white',
                    className,
                )}
                aria-label="Minimize sidebar"
            >
                <Icon icon="heroicons:arrows-pointing-in" className="h-5 w-5" />
            </IconButton>
        );
    }

    // Mode 'icon': Tombol expand dengan logo dan tooltip
    return (
        <Tooltip.Provider delayDuration={100}>
            <Tooltip.Root>
                <Tooltip.Trigger asChild>
                    <button
                        onClick={toggleMode}
                        className={cn(
                            'flex items-center justify-center rounded-lg bg-gray-800 p-1.5 dark:bg-gray-700',
                            className,
                        )}
                        aria-label="Expand sidebar"
                    >
                        <Icon
                            icon="heroicons:squares-2x2-solid"
                            className="h-5 w-5 text-white"
                        />
                    </button>
                </Tooltip.Trigger>
                <Tooltip.Portal>
                    <Tooltip.Content
                        side="right"
                        align="center"
                        sideOffset={8}
                        className="z-[60] rounded-md border bg-white px-2 py-1 text-xs shadow-lg dark:border-gray-700 dark:bg-gray-800"
                    >
                        Expand Sidebar
                    </Tooltip.Content>
                </Tooltip.Portal>
            </Tooltip.Root>
        </Tooltip.Provider>
    );
}
