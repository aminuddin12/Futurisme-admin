// resources/js/Components/Chat/Ui/ChatListPanel.tsx
import { Icon } from '@iconify/react';
import {
    Box,
    Card,
    Flex,
    IconButton,
    ScrollArea,
    Separator,
    Text,
    TextField,
} from '@radix-ui/themes';
import ChatListItem, { ChatContact } from './Ui/ChatListItem'; // Impor item & interface

interface ChatListPanelProps {
    contacts: ChatContact[];
    onSelectContact: (contactId: number | string) => void;
    currentUserId?: number | string; // ID user yang sedang login (opsional)
}

export default function ChatListPanel({
    contacts,
    onSelectContact,
    currentUserId,
}: ChatListPanelProps) {
    // Filter kontak aktif (jika perlu)
    const activeContactId = contacts.find((c) => c.active)?.id;

    return (
        // Gunakan Card agar styling konsisten, tambahkan border
        <Card className="!m-0 mr-4 flex h-full w-[300px] flex-col !rounded-lg border border-gray-200 !shadow-md dark:border-gray-700">
            {' '}
            {/* Fix width & height */}
            {/* Header List */}
            <Flex justify="between" align="center" p="4">
                <Text
                    weight="bold"
                    size="4"
                    className="text-gray-800 dark:text-gray-100"
                >
                    Recent Messages
                </Text>
                <IconButton variant="ghost" color="gray" size="2">
                    <Icon
                        icon="heroicons:ellipsis-horizontal-solid"
                        className="h-5 w-5"
                    />
                </IconButton>
            </Flex>
            {/* Search */}
            <Box px="4" pb="3">
                {' '}
                {/* Sesuaikan padding */}
                <TextField.Root size="2" placeholder="Search Team Member...">
                    <TextField.Slot>
                        <Icon
                            icon="heroicons:magnifying-glass-solid"
                            className="h-4 w-4 text-gray-400"
                        />
                    </TextField.Slot>
                </TextField.Root>
            </Box>
            <Separator className="dark:!bg-gray-700" />
            {/* List Kontak */}
            <ScrollArea className="flex-1 px-2 py-2">
                {' '}
                {/* Sesuaikan padding */}
                {contacts
                    // .filter(contact => contact.id !== currentUserId) // Opsional: Sembunyikan diri sendiri
                    .map((contact) => (
                        <ChatListItem
                            key={contact.id}
                            contact={{
                                ...contact,
                                active: contact.id === activeContactId,
                            }} // Set active prop
                            onClick={onSelectContact}
                        />
                    ))}
            </ScrollArea>
        </Card>
    );
}
