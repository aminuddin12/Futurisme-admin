// resources/js/Components/Profile/UI/ProfileImage.tsx

import { User } from '@/types'; // Import User type if you have it defined
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
import React, { useState } from 'react';

interface ProfileImageProps {
    // Tipe user mengizinkan null atau undefined
    user: User | null | undefined;
}

export default function ProfileImage({ user }: ProfileImageProps) {
    const [isDialogOpen, setDialogOpen] = useState(false);
    const [previewImage, setPreviewImage] = useState<string | null>(null);
    const { data, setData, post, processing, errors, reset } = useForm({
        avatar: null as File | null,
    });

    const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0];
        if (file) {
            setData('avatar', file);
            setPreviewImage(URL.createObjectURL(file));
        } else {
            setData('avatar', null);
            setPreviewImage(null);
        }
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        if (data.avatar) {
            post(route('profile.update_avatar'), {
                preserveScroll: true,
                onSuccess: () => {
                    setDialogOpen(false);
                    setPreviewImage(null);
                    reset();
                },
                onError: (formErrors) => {
                    console.error('Avatar update failed:', formErrors);
                },
            });
        }
    };

    const handleCloseDialog = () => {
        if (isDialogOpen) {
            setDialogOpen(false);
            setPreviewImage(null);
            reset();
        }
    };

    const handleOpenChange = (open: boolean) => {
        if (!open) {
            handleCloseDialog();
        }
        setDialogOpen(open);
    };

    // --- PERBAIKAN DI SINI ---
    // Gunakan optional chaining (?.) dan berikan fallback default
    const userName = user?.name || 'User'; // Fallback name
    const userInitial = userName?.charAt(0).toUpperCase() || 'U'; // Fallback initial
    const userAvatarUrl = user?.avatar_url
        ? `/storage/${user.avatar_url}`
        : undefined; // Fallback avatar URL

    return (
        <Box className="relative inline-block">
            {/* Avatar Pengguna */}
            <Avatar
                radius="full"
                size="7"
                // Gunakan fallback yang sudah aman
                fallback={userInitial}
                // Gunakan URL yang sudah aman
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
                            {/* Preview Gambar */}
                            <Flex justify="center" align="center" mb="3">
                                <Avatar
                                    radius="full"
                                    size="7"
                                    // Gunakan preview atau URL saat ini (sudah aman)
                                    src={previewImage || userAvatarUrl}
                                    // Gunakan fallback yang sudah aman
                                    fallback={userInitial} // <-- BARIS 92 (sekarang aman)
                                    className="border-2 border-dashed border-gray-300 bg-gray-50 dark:border-gray-600 dark:bg-gray-700"
                                />
                            </Flex>

                            {/* Input File */}
                            <input
                                id="avatarInput"
                                type="file"
                                accept="image/png, image/jpeg, image/webp"
                                onChange={handleFileChange}
                                className="block w-full cursor-pointer text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100 dark:text-gray-400 dark:file:bg-blue-900/50 dark:file:text-blue-300 dark:hover:file:bg-blue-800/50"
                            />
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
