// resources/js/Components/Chat/Ui/ChatHeader.tsx
import { Icon } from '@iconify/react';
import { Avatar, Box, Flex, IconButton, Text } from '@radix-ui/themes';
import { ChatContact } from './ChatListItem'; // Impor interface

interface ChatHeaderProps {
    contact: ChatContact | null; // Kontak yang sedang dipilih
}

export default function ChatHeader({ contact }: ChatHeaderProps) {
    if (!contact) {
        return (
            // Tampilan jika belum ada chat dipilih
            <Flex
                justify="between"
                align="center"
                p="4"
                className="h-[73px] border-b dark:border-gray-700"
            >
                <Text>Select a conversation</Text>
            </Flex>
        );
    }

    return (
        <Flex
            justify="between"
            align="center"
            p="4"
            className="h-[73px] border-b dark:border-gray-700"
        >
            {' '}
            {/* Samakan tinggi header */}
            <Flex gap="3" align="center">
                <div className="relative">
                    <Avatar
                        fallback={contact.name.charAt(0).toUpperCase()}
                        radius="full"
                        size="3"
                        src={contact.avatar}
                    />
                    {contact.online && (
                        <span className="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-white dark:ring-gray-800"></span>
                    )}
                </div>
                <Box>
                    <Text
                        weight="medium"
                        className="text-gray-800 dark:text-gray-100"
                    >
                        {contact.name}
                    </Text>
                    <Text size="1" color="gray" className="block">
                        {contact.online ? 'Active Now' : 'Offline'}
                    </Text>
                </Box>
            </Flex>
            {/* Tombol Aksi (contoh: Panggilan) */}
            <IconButton variant="ghost" color="gray" size="2">
                <Icon icon="heroicons:phone-solid" className="h-5 w-5" />
            </IconButton>
        </Flex>
    );
}
