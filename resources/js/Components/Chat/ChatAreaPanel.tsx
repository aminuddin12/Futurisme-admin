// resources/js/Components/Chat/Ui/ChatAreaPanel.tsx

import { ChatContact } from '@/Components/Chat/Ui/ChatListItem';
import ChatMessage, { Message } from '@/Components/Chat/Ui/ChatMessage';
import MessageInput from '@/Components/Chat/Ui/MessageInput';
import TypingIndicator from '@/Components/Chat/Ui/TypingIndicator'; // Impor TypingIndicator
import { Card, ScrollArea } from '@radix-ui/themes'; // Impor Flex
import { useEffect, useRef } from 'react'; // Impor useState
import ChatHeader from './ChatHeader';

interface ChatAreaPanelProps {
    selectedContact: ChatContact | null;
    messages: Message[];
    onSendMessage: (messageText: string) => void;
    currentUserId: number | string;
    isContactTyping: boolean; // Tambah prop untuk status mengetik
}

export default function ChatAreaPanel({
    selectedContact,
    messages,
    onSendMessage,
    currentUserId,
    isContactTyping,
}: ChatAreaPanelProps) {
    const scrollAreaRef = useRef<HTMLDivElement>(null);
    const messagesEndRef = useRef<HTMLDivElement>(null); // Ref untuk elemen terakhir

    // Auto scroll ke bawah saat ada pesan baru atau typing indicator muncul
    useEffect(() => {
        if (messagesEndRef.current) {
            messagesEndRef.current.scrollIntoView({ behavior: 'smooth' });
        }
    }, [messages, isContactTyping]); // Trigger saat array messages atau isContactTyping berubah

    return (
        <Card className="!m-0 flex h-full flex-1 flex-col overflow-hidden !rounded-lg border border-gray-200 !shadow-md dark:border-gray-700">
            {/* Header Chat */}
            <ChatHeader contact={selectedContact} />

            {/* Pesan */}
            <ScrollArea ref={scrollAreaRef} className="flex-1 p-4">
                <div className="space-y-4">
                    {messages.map((msg) => (
                        <ChatMessage
                            key={msg.id}
                            message={{
                                ...msg,
                                isMe: msg.senderId === currentUserId,
                            }}
                        />
                    ))}
                    {/* Tampilkan TypingIndicator jika kontak sedang mengetik */}
                    {isContactTyping && selectedContact && (
                        <TypingIndicator
                            senderAvatar={selectedContact.avatar}
                            senderName={selectedContact.name}
                        />
                    )}
                    <div ref={messagesEndRef} />{' '}
                    {/* Elemen kosong untuk scroll target */}
                </div>
            </ScrollArea>

            {/* Input Pesan */}
            {selectedContact && <MessageInput onSendMessage={onSendMessage} />}
        </Card>
    );
}
