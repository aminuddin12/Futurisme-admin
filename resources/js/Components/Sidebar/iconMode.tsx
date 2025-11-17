import { usePage } from '@inertiajs/react'; // <-- Ditambahkan usePage
import { Flex, Separator } from '@radix-ui/themes';
import React from 'react';

import Trigger from './Trigger'; // <-- PERBAIKAN PATH (sebelumnya ../Sidebar/Trigger)
import IconMenu from './UI/IconMenu';
// Impor juga tipe MenuItem, asumsikan diekspor dari ListMenuItem
import { PageProps } from '../../types/page'; // <-- Ditambahkan PageProps
import { MenuGroup, MenuItem } from './UI/ListMenuItem';

// --- BLOK DATA DUMMY DIHAPUS ---
// const menuData: MenuGroup[] = [ ...data statis... ];
// --- AKHIR BLOK DATA DUMMY ---

export default function IconMode() {
    // --- TAMBAHAN BARU ---
    // Mengambil sidebarMenu dari props Inertia
    const { sidebarMenu } = usePage<PageProps>().props;
    // Menetapkan data dinamis ke variabel menuData, tambahkan fallback array kosong
    // Kita paksakan tipenya sebagai MenuGroup[] karena kita tahu datanya cocok
    const menuData: MenuGroup[] = (sidebarMenu as MenuGroup[]) || [];
    // --- AKHIR TAMBAHAN ---

    return (
        <Flex direction="column" className="h-full w-[72px]">
            {' '}
            {/* Lebar icon mode */}
            {/* Header: Trigger untuk expand */}
            <Flex
                align="center"
                justify="center"
                className="h-[65px] flex-shrink-0"
            >
                <Trigger />
            </Flex>
            <Separator className="dark:!bg-gray-700" />
            {/* Navigasi */}
            <div className="no-scrollbar flex-1 overflow-y-auto">
                <nav className="mt-4 flex flex-col justify-between">
                    <Flex
                        direction="column"
                        align="center"
                        gap="1"
                        className="px-2"
                    >
                        {/* Filter(Boolean) ditambahkan untuk keamanan */}
                        {menuData.filter(Boolean).map((group, index) => (
                            <React.Fragment key={group.key}>
                                {/* --- LOGIKA PERBAIKAN DI SINI --- */}

                                {/* 1. Jika ini adalah GRUP (punya 'items') */}
                                {group.items && group.items.length > 0 && (
                                    <>
                                        {/* Tampilkan separator HANYA jika bukan grup pertama */}
                                        {index > 0 && (
                                            <Separator className="mx-2 my-2 dark:!bg-gray-700" />
                                        )}
                                        {/* Render semua item di dalam grup */}
                                        {group.items
                                            .filter(Boolean)
                                            .map((item) => (
                                                <IconMenu
                                                    key={item.key}
                                                    item={item as MenuItem}
                                                />
                                            ))}
                                    </>
                                )}

                                {/* 2. Jika ini adalah LINK LANGSUNG (punya 'href') */}
                                {group.href && (
                                    <IconMenu item={group as MenuItem} />
                                )}

                                {/* --- AKHIR LOGIKA PERBAIKAN --- */}
                            </React.Fragment>
                        ))}
                    </Flex>
                </nav>
            </div>
        </Flex>
    );
}
