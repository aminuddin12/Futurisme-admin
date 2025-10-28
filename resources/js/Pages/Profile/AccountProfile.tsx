// resources/js/Pages/Profile/AccountProfile.tsx

import PageWindow from '@/Components/Multi-Sidebar/PageWindow'; // Impor Window Layout Profil
import AdminLayout from '@/Layouts/AdminLayout'; // Gunakan layout admin Anda
import { Head, usePage } from '@inertiajs/react';
import React, { useState } from 'react';
import { sidebarMenuData } from './Partials/SidebarListMenu'; // Impor data menu

export default function AccountProfile() {
    const { props } = usePage();
    const user = props.auth?.user; // Ambil data user
    const pageTitle = props.pageTitle || 'Profile Settings'; // Ambil judul

    // State untuk melacak item aktif, default ke item pertama
    const [activeMenuKey, setActiveMenuKey] = useState<string>(
        sidebarMenuData[0]?.items[0]?.key ?? 'public-profile',
    );

    return (
        <>
            <Head title={pageTitle} />
            {/* ProfileWindow sekarang menjadi layout utama halaman ini */}
            <PageWindow
                activeMenuKey={activeMenuKey}
                setActiveMenuKey={setActiveMenuKey}
                user={user}
            />
        </>
    );
}

// Gunakan AdminLayout
AccountProfile.layout = (page: React.ReactNode) => (
    <AdminLayout>{page}</AdminLayout>
);
