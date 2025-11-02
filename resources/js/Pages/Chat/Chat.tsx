// resources/js/Pages/Admin/Chat.tsx

import AdminLayout, { PageProps } from '@/Layouts/AdminLayout';
import { Head, useForm, usePage } from '@inertiajs/react';
import { Flex } from '@radix-ui/themes';
import React, { useEffect, useMemo, useState } from 'react';

// Impor komponen UI Chat
import ChatAreaPanel from '@/Components/Chat/ChatAreaPanel';
import ChatListPanel from '@/Components/Chat/ChatListPanel';

// Impor tipe data
import { ChatContact } from '@/Components/Chat/Ui/ChatListItem';
import { Message } from '@/Components/Chat/Ui/ChatMessage';

// Tipe untuk props yang diterima dari controller
interface ChatPageProps {
    contacts: ChatContact[];
    messages: Record<string | number, Message[]>;
    pageTitle?: string;
}

export default function Chat() {
    const {
        props: {
            contacts: initialContacts,
            messages: initialMessages,
            pageTitle = 'Messages',
            auth,
        },
    } = usePage<PageProps & ChatPageProps>();

    const currentUserId = auth.user.id;

    // --- State Management ---
    const [contacts, setContacts] = useState(initialContacts || []);
    const [selectedContactId, setSelectedContactId] = useState<
        number | string | null
    >(null);
    // Pesan dari props akan menjadi sumber kebenaran awal
    const [messages, setMessages] = useState(initialMessages || {});

    // Gunakan useForm untuk menangani pengiriman pesan
    const { data, setData, post, reset, processing } = useForm({ message: '' });

    // Update state jika props dari server berubah
    useEffect(() => {
        setContacts(initialContacts || []);
        setMessages(initialMessages || {});
    }, [initialContacts, initialMessages]);

    // Fungsi untuk memilih kontak
    const handleSelectContact = (contactId: number | string) => {
        setSelectedContactId(contactId);
    };

    // Fungsi untuk mengirim pesan, sekarang terhubung ke backend
    const handleSendMessage = (messageText: string) => {
        if (!selectedContactId) return;

        // Panggil post dengan data dan options sebagai argumen terpisah
        post(route('chat.store'), {
            data: {
                message: messageText,
                receiver_id: selectedContactId,
            },
            onSuccess: () => reset('message'),
            preserveScroll: true, // Opsi harus berada di objek terpisah
        });
    };

    // Gunakan useMemo untuk optimasi
    const { selectedContact, currentMessages } = useMemo(() => {
        const contact =
            contacts.find((c) => c.id === selectedContactId) || null;
        const messageList = selectedContactId
            ? messages[selectedContactId] || []
            : [];
        return { selectedContact: contact, currentMessages: messageList };
    }, [selectedContactId, contacts, messages]);

    return (
        <>
            <Head title={pageTitle} />
            <div className="bg-gray-100 px-4 py-4 dark:bg-gray-900">
                <Flex
                    // Tinggi dihitung dari viewport - tinggi header - (padding atas + padding bawah main layout)
                    className="h-[calc(100vh-65px-3rem)] gap-4"
                    align="stretch" // Pastikan panel mengisi tinggi
                >
                    <ChatListPanel
                        contacts={contacts}
                        onSelectContact={handleSelectContact}
                        currentUserId={currentUserId}
                    />
                    <ChatAreaPanel
                        selectedContact={selectedContact}
                        messages={currentMessages}
                        onSendMessage={handleSendMessage}
                        currentUserId={currentUserId}
                        isContactTyping={false} // TODO: Implement typing indicator
                    />
                </Flex>
            </div>
        </>
    );
}

Chat.layout = (page: React.ReactNode) => <AdminLayout>{page}</AdminLayout>;
