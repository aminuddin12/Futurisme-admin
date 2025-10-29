// resources/js/Components/Profile/UI/ProfileImage.tsx

import { User } from '@/types'; // Import User type
import { Icon } from '@iconify/react';
import { useForm } from '@inertiajs/react';
import {
    Avatar,
    Box,
    Button,
    Dialog,
    Flex,
    IconButton,
    Text,
} from '@radix-ui/themes';
import React, { useEffect, useRef, useState } from 'react';

interface ProfileImageProps {
    user: User | null | undefined;
}

export default function ProfileImage({ user }: ProfileImageProps) {
    // ... (state dan fungsi handle* tetap sama)
    const [isDialogOpen, setDialogOpen] = useState(false);
    const [previewImage, setPreviewImage] = useState<string | null>(null);
    const fileInputRef = useRef<HTMLInputElement>(null); // Ref for file input

    const { data, setData, post, processing, errors, reset } = useForm({
        avatar: null as File | null,
    });

    // Effect to clean up object URL when previewImage changes or component unmounts
    useEffect(() => {
        return () => {
            if (previewImage) {
                URL.revokeObjectURL(previewImage);
            }
        };
    }, [previewImage]);

    const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files ? e.target.files[0] : null;

        // Revoke previous preview URL if it exists before creating a new one
        if (previewImage) {
            URL.revokeObjectURL(previewImage);
        }

        setData('avatar', file);

        if (file) {
            setPreviewImage(URL.createObjectURL(file));
        } else {
            setPreviewImage(null);
        }
    };

    const handleCloseDialog = () => {
        setDialogOpen(false);
        reset('avatar'); // Reset only the avatar field
        setPreviewImage(null); // Clear preview image
        if (fileInputRef.current) {
            fileInputRef.current.value = ''; // Clear file input value
        }
    };

    const handleOpenChange = (open: boolean) => {
        if (!open) {
            handleCloseDialog(); // If dialog is closing, reset everything
        }
        setDialogOpen(open);
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        // Assuming a route named 'profile.update.avatar' exists in your Inertia.js setup
        post(route('profile.update.avatar'), {
            onSuccess: () => {
                handleCloseDialog(); // Close dialog and reset on success
            },
            // onError is implicitly handled by `errors` object from useForm
            // You could add specific error handling here if needed
        });
    };

    // --- PERBAIKAN LEBIH AMAN ---
    // Jika user belum ada, render placeholder atau null
    if (!user) {
        // Atau render skeleton loading state
        return (
            <Box className="relative inline-block">
                <Avatar
                    radius="full"
                    size="7"
                    fallback="?"
                    className="bg-gray-200 shadow-md dark:bg-gray-700"
                />
                {/* Tombol edit bisa disembunyikan jika user tidak ada */}
            </Box>
        );
    }

    // Jika user ada, lanjutkan seperti biasa
    const userName = user.name || 'User';
    const userInitial = userName.charAt(0).toUpperCase() || 'U';
    // Asumsikan backend mengirimkan URL lengkap.
    // Jika tidak, Anda mungkin perlu menambahkan prefix di sini.
    const userAvatarUrl = user.avatar_url || undefined;

    return (
        <Box className="relative inline-block">
            {/* Avatar Pengguna */}
            <Avatar
                radius="full"
                size="7"
                fallback={userInitial}
                src={userAvatarUrl}
                className="shadow-md"
            />

            {/* Tombol Edit */}
            <IconButton
                size="1"
                radius="full"
                variant="solid"
                color="blue"
                onClick={() => setDialogOpen(true)}
                className="absolute -bottom-1 -right-1 z-10 transition-all hover:brightness-110 active:brightness-90"
            >
                <Icon icon="heroicons:pencil-solid" className="h-3 w-3" />
            </IconButton>

            {/* Dialog */}
            <Dialog.Root open={isDialogOpen} onOpenChange={handleOpenChange}>
                <Dialog.Content style={{ maxWidth: 450 }}>
                    <Dialog.Title>Upload Profile Picture</Dialog.Title>
                    <Dialog.Description size="2" mb="4">
                        Change your profile picture here. Click save when you're
                        done.
                    </Dialog.Description>

                    <form onSubmit={handleSubmit}>
                        <Flex direction="column" gap="3">
                            <Flex justify="center" align="center" mb="3">
                                <Avatar
                                    radius="full"
                                    size="7"
                                    src={previewImage || userAvatarUrl}
                                    fallback={userInitial} // Baris 92 sekarang aman
                                    className="border-2 border-dashed border-gray-300 bg-gray-50 dark:border-gray-600 dark:bg-gray-700"
                                />
                            </Flex>
                            {/* Custom file input trigger */}
                            <Button
                                type="button"
                                variant="soft"
                                onClick={() => fileInputRef.current?.click()}
                            >
                                Choose File
                            </Button>
                            <input
                                id="avatarInput"
                                type="file"
                                accept="image/png, image/jpeg, image/webp"
                                onChange={handleFileChange}
                                ref={fileInputRef} // Attach ref
                                className="sr-only" // Visually hide the actual input
                            />
                            {data.avatar && (
                                <Text size="1" color="gray">
                                    Selected: {data.avatar.name}
                                </Text>
                            )}
                            {errors.avatar && (
                                <Text color="red" size="1">
                                    {errors.avatar}
                                </Text>
                            )}
                        </Flex>
                        <Flex gap="3" mt="4" justify="end">
                            <Dialog.Close>
                                <Button
                                    type="button"
                                    variant="soft"
                                    color="gray"
                                >
                                    Cancel
                                </Button>
                            </Dialog.Close>
                            <Button
                                type="submit"
                                loading={processing}
                                disabled={!data.avatar}
                            >
                                Save
                            </Button>
                        </Flex>
                    </form>
                </Dialog.Content>
            </Dialog.Root>
        </Box>
    );
}
