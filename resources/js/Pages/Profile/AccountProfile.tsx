// resources/js/Pages/Profile/AccountProfile.tsx

import React, { useState } from 'react';
import { Head, usePage } from '@inertiajs/react';
import AdminLayout from '@/Layouts/AdminLayout'; // Gunakan layout admin Anda
import { Flex, Heading } from '@radix-ui/themes';
import ProfileSidebar, { ProfileSidebarItem } from '@/Components/Profile/Sidebar'; // Impor Sidebar
import ProfileWindow from '@/Components/Profile/ProfileWindow'; // Impor Window

// Definisikan item sidebar di sini
const sidebarItems: ProfileSidebarItem[] = [
    { id: 'account', label: 'Account', icon: 'heroicons:user-circle' },
    // { id: 'personal', label: 'Personal Info', icon: 'heroicons:identification' },
    // { id: 'address', label: 'Address', icon: 'heroicons:map-pin' },
    { id: 'social', label: 'Social Media', icon: 'heroicons:share' },
    { id: 'history', label: 'Account History', icon: 'heroicons:clock'},
    { id: 'password', label: 'Password', icon: 'heroicons:key'},
    // Item 'Delete Account' ditambahkan langsung di Sidebar.tsx
];

export default function AccountProfile() {
    const { props } = usePage();
    const user = props.auth?.user; // Ambil data user
    const pageTitle = props.pageTitle || "Profile Settings"; // Ambil judul

    // State untuk melacak item aktif
    const [activeItemId, setActiveItemId] = useState<string>(sidebarItems[0]?.id || 'account');

    return (
        <>
            <Head title={pageTitle} />
            {/* Hapus Heading H1 dari sini, karena sudah di layout */}

            {/* Layout Utama Halaman Profil */}
            <Flex gap="6" align="start" className='p-4 m-4'> {/* Beri jarak antar sidebar dan window */}
                <ProfileSidebar
                    items={sidebarItems}
                    activeItemId={activeItemId}
                    onItemClick={setActiveItemId} // Update state saat item diklik
                />
                <ProfileWindow
                    activeItemId={activeItemId}
                    user={user} // Kirim data user ke window
                />
            </Flex>
        </>
    );
}

// Gunakan AdminLayout
AccountProfile.layout = (page: React.ReactNode) => <AdminLayout>{page}</AdminLayout>;
