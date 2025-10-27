// resources/js/Components/Chat/Ui/ChatListItem.tsx
import { Avatar, Badge, Box, Flex, Text } from '@radix-ui/themes';

// Interface untuk data kontak
export interface ChatContact {
    id: number | string;
    name: string;
    lastMessage: string;
    time: string;
    avatar?: string;
    online?: boolean;
    unread?: number;
    typing?: boolean;
    active?: boolean;
}

interface ChatListItemProps {
    contact: ChatContact;
    onClick: (contactId: number | string) => void; // Fungsi saat item diklik
}

export default function ChatListItem({ contact, onClick }: ChatListItemProps) {
    return (
        <Flex
            gap="3"
            align="center"
            p="2" // Kurangi padding
            className={`mx-2 cursor-pointer rounded-md ${
                // Tambah margin horizontal
                contact.active
                    ? 'bg-emerald-100 dark:bg-emerald-900/50'
                    : 'hover:bg-gray-100 dark:hover:bg-gray-700'
            }`}
            onClick={() => onClick(contact.id)}
        >
            <div className="relative flex-shrink-0">
                <Avatar
                    fallback={contact.name.charAt(0).toUpperCase()}
                    radius="full"
                    size="3"
                    src={contact.avatar} // Tambahkan src jika ada
                />
                {contact.online && (
                    <span className="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-white dark:ring-gray-800"></span>
                )}
            </div>
            <Box className="min-w-0 flex-1">
                <Text
                    size="2"
                    weight="medium"
                    className="block truncate text-gray-800 dark:text-gray-100"
                >
                    {contact.name}
                </Text>
                <Text
                    size="1"
                    className={`block truncate ${
                        contact.typing
                            ? 'italic text-emerald-600 dark:text-emerald-400'
                            : 'text-gray-500 dark:text-gray-400'
                    }`}
                >
                    {contact.lastMessage}
                </Text>
            </Box>
            <Flex
                direction="column"
                align="end"
                gap="1"
                className="ml-auto flex-shrink-0 pl-1"
            >
                {' '}
                {/* Tambah ml-auto & pl-1 */}
                <Text size="1" color="gray" className="whitespace-nowrap">
                    {contact.time}
                </Text>
                {contact.unread && contact.unread > 0 ? (
                    <Badge
                        color="green"
                        radius="full"
                        className="flex h-[18px] min-w-[18px] items-center justify-center"
                    >
                        {' '}
                        {/* Styling badge */}
                        {contact.unread}
                    </Badge>
                ) : (
                    <div className="h-[18px]"></div>
                )}{' '}
                {/* Placeholder agar align rata */}
            </Flex>
        </Flex>
    );
}
