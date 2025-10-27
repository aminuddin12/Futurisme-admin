import BoxItem from '@/Components/Profile/BoxItem';
import ProfileImage from '@/Components/Profile/UI/ProfileImage';
import ButtonPrimary from '@/Components/UI/ButtonPrimary';
import InputError from '@/Components/UI/InputError';
import InputLabel from '@/Components/UI/InputLabel';
import TextInput from '@/Components/UI/TextInput';
import { useForm, usePage } from '@inertiajs/react';
import React from 'react';
// import AdminBadge from '@/components/Badge/AdminBadge'; // Contoh

export default function PublicProfileForm({ user }) {
    const { props } = usePage();
    const currentUser = props.auth?.user; // Asumsi data user ada di props.auth

    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            name: currentUser?.name || '',
            email: currentUser?.email || '',
            // Tambahkan field lain jika perlu, misal username
        });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        patch(route('profile.update')); // Sesuaikan nama route jika berbeda
    };

    const handleImageUpload = (file: File) => {
        // Implementasi logika upload foto profil di sini
        // Biasanya menggunakan `router.post` dari Inertia dengan FormData
        console.log('Upload file:', file);
    };

    return (
        <BoxItem
            title="Public Profile Information"
            description="Update your account's profile information and email address."
        >
            <form onSubmit={submit} className="mt-6 space-y-6">
                {/* Profile Image Section */}
                <div>
                    <InputLabel htmlFor="photo" value="Photo" />
                    <div className="mt-2 flex items-center gap-x-3">
                        <ProfileImage
                            user={currentUser}
                            size="w-24 h-24"
                            onImageUpload={handleImageUpload}
                        />
                        {/* Tombol Hapus Foto bisa ditambahkan di sini */}
                    </div>
                </div>

                <div>
                    <InputLabel htmlFor="name" value="Name" />
                    <TextInput
                        id="name"
                        className="mt-1 block w-full"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                        autoComplete="name"
                    />
                    <InputError className="mt-2" message={errors.name} />
                </div>

                <div>
                    <InputLabel htmlFor="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        className="mt-1 block w-full"
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                        required
                        autoComplete="username"
                    />
                    <InputError className="mt-2" message={errors.email} />

                    {/* Jika ada fitur verifikasi email */}
                    {/* {mustVerifyEmail && user.email_verified_at === null && ( ... )} */}
                </div>

                {/* Tambahkan field lain di sini jika perlu */}

                <div className="flex items-center gap-4">
                    <ButtonPrimary disabled={processing}>Save</ButtonPrimary>
                    {recentlySuccessful && (
                        <p className="text-sm text-gray-600 dark:text-gray-400">
                            Saved.
                        </p>
                    )}
                </div>
            </form>
        </BoxItem>
    );
}
