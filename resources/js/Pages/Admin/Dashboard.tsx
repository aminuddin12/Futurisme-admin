// resources/js/Pages/Admin/Dashboard.tsx

import AdminLayout from '@/Layouts/AdminLayout'; // Import layout
import { Head } from '@inertiajs/react';
import { Text } from '@radix-ui/themes';
import React from 'react';

export default function Dashboard() {
    const pageTitle = 'Dashboard';
    return (
        // Layout akan otomatis ditambahkan oleh Inertia
        <>
            <Head title={pageTitle} />
            <div className="p-6">
                <Text>Selamat datang di panel admin!</Text>
                {/* Tambahkan komponen dashboard lainnya di sini */}
            </div>
        </>
    );
}

// Beritahu Inertia untuk menggunakan AdminLayout untuk halaman ini
Dashboard.layout = (page: React.ReactNode) => <AdminLayout>{page}</AdminLayout>;
