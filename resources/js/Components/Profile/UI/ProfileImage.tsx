import { Icon } from '@iconify/react';
import * as Avatar from '@radix-ui/react-avatar';
import * as Dialog from '@radix-ui/react-dialog';
import React, { useState } from 'react';

/**
 * Interface defining the properties for the ProfileImage component.
 */
interface ProfileImageProps {
    /** The user object containing name and optional profileImageUrl. */
    user: {
        name: string;
        profileImageUrl?: string | null;
    };
    /** Size class for the avatar (width and height) e.g., 'w-24 h-24'. Defaults to 'w-20 h-20'. */
    size?: string;
    /** Optional function to handle image upload logic. */
    onImageUpload?: (file: File) => void;
    className?: string; // Allow additional styling
}

/**
 * Helper function to get initials from a name.
 */
const getInitials = (name: string): string => {
    const words = name?.split(' ').filter(Boolean) || [];
    if (words.length === 0) return '?';
    const firstInitial = words[0][0];
    const lastInitial = words.length > 1 ? words[words.length - 1][0] : '';
    return `${firstInitial}${lastInitial}`.toUpperCase();
};

/**
 * A reusable component using Radix UI to display a user's profile image or initials,
 * with an edit button triggering an upload dialog.
 */
export default function ProfileImage({
    user,
    size = 'w-20 h-20', // Default size
    onImageUpload,
    className = '',
}: ProfileImageProps) {
    const initials = getInitials(user?.name || '');
    const [selectedFile, setSelectedFile] = useState<File | null>(null); // State for preview or immediate upload

    // Handle file selection from input
    const handleFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const file = event.target.files?.[0];
        if (file) {
            setSelectedFile(file); // Simpan file untuk preview atau upload nanti
            if (onImageUpload) {
                onImageUpload(file); // Panggil handler jika ada
            }
            // Anda mungkin ingin menutup dialog di sini atau setelah upload berhasil
            // tergantung alur kerja Anda.
        }
        // Reset input agar bisa memilih file yang sama lagi jika perlu
        event.target.value = '';
    };

    return (
        <Dialog.Root>
            <div className={`relative inline-block ${className}`}>
                {/* Radix Avatar */}
                <Avatar.Root
                    className={`inline-flex select-none items-center justify-center overflow-hidden rounded-full bg-gray-200 align-middle dark:bg-gray-700 ${size}`}
                >
                    <Avatar.Image
                        className="h-full w-full object-cover"
                        src={user?.profileImageUrl || undefined} // Berikan undefined jika null
                        alt={user?.name || 'Profile picture'}
                    />
                    <Avatar.Fallback
                        className="flex h-full w-full items-center justify-center text-xl font-semibold text-gray-600 dark:text-gray-300"
                        delayMs={600} // Tunda fallback agar tidak berkedip saat gambar cepat dimuat
                    >
                        {initials}
                    </Avatar.Fallback>
                </Avatar.Root>

                {/* Tombol Edit (Dialog Trigger) */}
                <Dialog.Trigger asChild>
                    <button
                        type="button"
                        className="absolute bottom-0 right-0 rounded-full bg-gray-700 p-1.5 text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-gray-300 dark:focus:ring-gray-400 dark:focus:ring-offset-gray-800"
                        aria-label="Edit profile picture"
                    ></button>
                    <Icon icon="mdi-light:home" />
                </Dialog.Trigger>
            </div>

            {/* Konten Dialog */}
            <Dialog.Portal>
                <Dialog.Overlay className="data-[state=open]:animate-overlayShow fixed inset-0 bg-black/50" />
                <Dialog.Content className="data-[state=open]:animate-contentShow fixed left-1/2 top-1/2 w-[90vw] max-w-md -translate-x-1/2 -translate-y-1/2 rounded-lg bg-white p-6 shadow-lg focus:outline-none dark:bg-gray-800">
                    <Dialog.Title className="text-lg font-medium text-gray-900 dark:text-white">
                        Unggah Foto Profil Baru
                    </Dialog.Title>
                    <Dialog.Description className="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Pilih file gambar dari perangkat Anda (JPG, PNG, GIF).
                    </Dialog.Description>

                    <div className="mt-5">
                        <input
                            type="file"
                            accept="image/png, image/jpeg, image/gif"
                            onChange={handleFileChange}
                            className="block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900/50 dark:file:text-indigo-300 dark:hover:file:bg-indigo-900"
                        />
                        {/* Optional: Tambahkan preview gambar jika selectedFile ada */}
                        {selectedFile && (
                            <div className="mt-4">
                                <p className="text-xs text-gray-500">
                                    Preview:
                                </p>
                                <img
                                    src={URL.createObjectURL(selectedFile)}
                                    alt="Preview"
                                    className="mt-2 h-20 w-20 rounded-full object-cover"
                                />
                            </div>
                        )}
                    </div>

                    <div className="mt-6 flex justify-end gap-3">
                        <Dialog.Close asChild>
                            <button
                                type="button"
                                className="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600"
                            >
                                Batal
                            </button>
                        </Dialog.Close>
                        {/* Anda bisa menambahkan tombol "Unggah" di sini jika onImageUpload tidak langsung mengunggah */}
                    </div>

                    <Dialog.Close asChild>
                        <button
                            className="absolute right-4 top-4 rounded-full p-1 text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:text-gray-400 dark:hover:bg-gray-700"
                            aria-label="Close"
                        >
                            <Icon icon="mdi-light:home" />
                        </button>
                    </Dialog.Close>
                </Dialog.Content>
            </Dialog.Portal>
        </Dialog.Root>
    );
}
