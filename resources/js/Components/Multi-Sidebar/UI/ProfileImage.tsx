import { User } from '@/types';
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
    const [isDialogOpen, setDialogOpen] = useState(false);
    const [previewImage, setPreviewImage] = useState<string | null>(null);
    const fileInputRef = useRef<HTMLInputElement>(null);

    const { data, setData, post, processing, errors, reset } = useForm({
        avatar: null as File | null,
    });

    useEffect(() => {
        return () => {
            if (previewImage) {
                URL.revokeObjectURL(previewImage);
            }
        };
    }, [previewImage]);

    const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files ? e.target.files[0] : null;

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
        reset('avatar');
        setPreviewImage(null);
        if (fileInputRef.current) {
            fileInputRef.current.value = '';
        }
    };

    const handleOpenChange = (open: boolean) => {
        if (!open) {
            handleCloseDialog();
        }
        setDialogOpen(open);
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(route('profile.update.avatar'), {
            onSuccess: () => {
                handleCloseDialog();
            },
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
            </Box>
        );
    }

    const userName = user.name || 'User';
    const userInitial = userName.charAt(0).toUpperCase() || 'U';
    const userAvatarUrl = user.avatar_url || undefined;

    return (
        <Box className="relative inline-block">
            <Avatar
                radius="full"
                size="7"
                fallback={userInitial}
                src={userAvatarUrl}
                className="shadow-md"
            />

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
                                    fallback={userInitial}
                                    className="border-2 border-dashed border-gray-300 bg-gray-50 dark:border-gray-600 dark:bg-gray-700"
                                />
                            </Flex>
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
                                ref={fileInputRef}
                                className="sr-only"
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
