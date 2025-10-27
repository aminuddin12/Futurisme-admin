// resources/js/Pages/Admin/Chat.tsx

import AdminLayout from '@/Layouts/AdminLayout';
import { Head, usePage } from '@inertiajs/react';
import { Flex } from '@radix-ui/themes';
import React, { useState } from 'react'; // Impor useState

// Impor komponen UI Chat
import ChatAreaPanel from '@/Components/Chat/ChatAreaPanel';
import ChatListPanel from '@/Components/Chat/ChatListPanel';

// Impor interface (opsional, bisa juga didefinisikan di sini)
import { ChatContact } from '@/Components/Chat/Ui/ChatListItem';
import { Message } from '@/Components/Chat/Ui/ChatMessage';

// --- CONTOH DATA (Ganti dengan data dari props atau state management) ---
const initialContacts: ChatContact[] = [
    {
        id: 1,
        name: 'Robert Fox',
        lastMessage: 'Sir, Any update from client?',
        time: '11:27',
        avatar: '',
        online: false,
        unread: 2,
    },
    {
        id: 2,
        name: 'Leslie Alexander',
        lastMessage: 'Hello sir, Optimization has been...',
        time: '10:50',
        avatar: '',
        online: true,
        unread: 3,
    },
    {
        id: 3,
        name: 'Jacob Jones',
        lastMessage: 'Need to discuss on ZeCoin...',
        time: '10:15',
        avatar: '',
        online: true,
        unread: 0,
        active: false,
    }, // Awalnya tidak ada yg aktif
    {
        id: 4,
        name: 'Brooklyn Simmons',
        lastMessage: 'Hello Brooklyn, How are we...',
        time: '11:14',
        avatar: '',
        online: false,
        unread: 0,
    },
    {
        id: 5,
        name: 'Eleanor Pena',
        lastMessage: 'Let me know if we have missed...',
        time: '11:14',
        avatar: '',
        online: false,
        unread: 0,
        typing: false,
    },
    {
        id: 6,
        name: 'Kelemen Krisztina',
        lastMessage: 'Typing...',
        time: '11:14',
        avatar: '',
        online: true,
        unread: 0,
    },
];

const initialMessages: Record<string | number, Message[]> = {
    // Pesan di-grup berdasarkan ID kontak
    1: [], // Robert Fox
    2: [], // Leslie
    3: [
        // Jacob Jones
        {
            id: 'm1',
            senderId: 3,
            text: 'Hey, have you seen the latest changes in the cryptocurrency application project?',
            time: '5 July 2025',
            isMe: false,
        },
        {
            id: 'm2',
            senderId: 99,
            text: 'Yes, I just reviewed the updated document...',
            time: '5 July 2025',
            isMe: true,
        }, // Asumsi user ID 99
        {
            id: 'm3',
            senderId: 3,
            text: "Well, for starters, they've completely revamped...",
            time: '5 July 2025',
            isMe: false,
        },
        {
            id: 'm4',
            senderId: 99,
            text: 'Need to discuss on ZeCoin updates...',
            time: '6 July 10:15',
            isMe: true,
        },
    ],
    4: [], // Brooklyn
    5: [], // Eleanor
    6: [], // Kelemen
};
// --- AKHIR CONTOH DATA ---

export default function Chat() {
    const { props } = usePage();
    const currentUserId = props.auth?.user?.id || 99; // Ambil ID user login (ganti 99 dengan fallback yang sesuai)
    const pageTitle: string =
        typeof props.pageTitle === 'string' ? props.pageTitle : 'Messages';

    // --- State Management Sederhana (Ganti dengan Redux/Zustand jika kompleks) ---
    const [contacts, setContacts] = useState<ChatContact[]>(initialContacts);
    const [selectedContactId, setSelectedContactId] = useState<
        number | string | null
    >(null);
    const [messages, setMessages] =
        useState<Record<string | number, Message[]>>(initialMessages);

    // Fungsi untuk memilih kontak
    const handleSelectContact = (contactId: number | string) => {
        setSelectedContactId(contactId);
        // Tandai kontak sebagai aktif di state contacts
        setContacts((prevContacts) =>
            prevContacts.map((c) => ({
                ...c,
                active: c.id === contactId,
                unread: c.id === contactId ? 0 : c.unread, // Reset unread saat dipilih
            })),
        );
        // Idealnya, di sini Anda fetch pesan untuk kontak yang dipilih jika belum ada
    };

    // Fungsi untuk mengirim pesan (simulasi)
    const handleSendMessage = (messageText: string) => {
        if (!selectedContactId) return;

        const newMessage: Message = {
            id: `m${Date.now()}`, // ID unik sementara
            senderId: currentUserId,
            text: messageText,
            time: new Date().toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
            }),
            isMe: true,
        };

        // Tambahkan pesan baru ke state messages untuk kontak yang dipilih
        setMessages((prevMessages) => ({
            ...prevMessages,
            [selectedContactId]: [
                ...(prevMessages[selectedContactId] || []),
                newMessage,
            ],
        }));

        // TODO: Kirim pesan ke backend di sini
    };

    // Cari data kontak yang sedang dipilih
    const selectedContact =
        contacts.find((c) => c.id === selectedContactId) || null;
    // Ambil pesan untuk kontak yang dipilih
    const currentMessages = selectedContactId
        ? messages[selectedContactId] || []
        : [];
    // --- Akhir State Management ---

    return (
        <>
            <Head title={pageTitle} />
            {/* Hapus Heading h1 dari sini */}
            <div className="px-4 py-4 overflow-y-auto bg-gray-100 dark:bg-gray-900">
                <Flex
                    // Tinggi dihitung dari viewport - tinggi header - (padding atas + padding bawah main layout)
                    className="h-[calc(100vh-65px-3rem)] gap-4" // Tambah gap antar panel
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
                    />
                </Flex>
            </div>
        </>
    );
}

Chat.layout = (page: React.ReactNode) => <AdminLayout>{page}</AdminLayout>;
