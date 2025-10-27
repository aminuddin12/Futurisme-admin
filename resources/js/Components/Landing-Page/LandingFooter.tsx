// resources/js/Components/Landing-Page/LandingFooter.tsx

import { Link } from '@inertiajs/react';
import { Button, Flex, Heading, Text } from '@radix-ui/themes';

// Data tautan tetap sama
const footerLinks = [
    {
        title: 'Produk',
        links: [
            { name: 'Aplikasi', href: '#' },
            { name: 'Workflows', href: '#' },
            { name: 'Database', href: '#' },
            { name: 'Mobile', href: '#' },
        ],
    },
    {
        title: 'Solusi',
        links: [
            { name: 'AI Apps', href: '#' },
            { name: 'Aplikasi Internal', href: '#' },
            { name: 'Integrasi', href: '#' },
            { name: 'Self-hosting', href: '#' },
        ],
    },
    {
        title: 'Sumber Daya',
        links: [
            { name: 'Blog', href: '#' },
            { name: 'Laporan', href: '#' },
            { name: 'Studi Kasus', href: '#' },
        ],
    },
    {
        title: 'Developers',
        links: [
            { name: 'Dokumentasi', href: '#' },
            { name: 'Changelog', href: '#' },
            { name: 'Status', href: '#' },
            { name: 'Jaringan Developer', href: '#' },
        ],
    },
    {
        title: 'Perusahaan',
        links: [
            { name: 'Tentang Kami', href: '#' },
            { name: 'Karier', href: '#' },
            { name: 'Partner', href: '#' },
        ],
    },
];

export default function LandingFooter() {
    return (
        <footer className="z-40 w-full p-8">
            {/* <div className="z-100 absolute inset-0 opacity-50">
                <FooterBackground
                    className="h-full w-full object-cover"
                    preserveAspectRatio="xMidYMid slice"
                />
                <div className="absolute inset-0 bg-black opacity-0 mix-blend-multiply dark:opacity-50" />
            </div> */}
            <div className="mx-auto max-w-7xl">
                {/* 2. Bagian Atas: Tautan dan Tombol Aksi */}
                <div className="flex flex-col justify-between gap-12 pb-24 pt-16 lg:flex-row">
                    {/* Kolom Tautan */}
                    <div className="grid grid-cols-2 gap-8 sm:grid-cols-3 lg:grid-cols-5">
                        {footerLinks.map((column) => (
                            <div
                                key={column.title}
                                className="flex flex-col gap-3"
                            >
                                <Heading
                                    as="h3"
                                    size="2"
                                    className="mb-1 font-medium uppercase text-gray-500 dark:text-gray-400"
                                >
                                    {column.title}
                                </Heading>
                                {column.links.map((link) => (
                                    <Link
                                        key={link.name}
                                        href={link.href}
                                        className="text-base text-black transition-colors hover:text-emerald-500 dark:text-white dark:hover:text-emerald-400"
                                    >
                                        {link.name}
                                    </Link>
                                ))}
                            </div>
                        ))}
                    </div>

                    {/* 3. Kolom Aksi (Hanya Tombol) */}
                    <div className="flex shrink-0 flex-col items-start gap-4">
                        <Button
                            size="3"
                            highContrast
                            className="!w-full !bg-black !text-white lg:!w-auto dark:!bg-white dark:!text-black"
                        >
                            Mulai Gratis
                        </Button>
                        <Button
                            size="3"
                            variant="outline"
                            color="gray"
                            className="!w-full lg:!w-auto"
                        >
                            Jadwalkan Demo
                        </Button>
                    </div>
                </div>

                {/* 4. Bagian Tengah: Logo Besar dan Tautan Legal (Struktur Baru) */}
                <div className="flex flex-col justify-between gap-8 py-16 md:flex-row md:items-end">
                    {/* Logo Besar */}
                    <Link
                        href="/"
                        className="text-8xl font-bold text-black dark:text-white"
                    >
                        Fx
                        <span className="text-emerald-500 dark:text-emerald-400">
                            o
                        </span>
                        logy
                    </Link>

                    {/* Tautan Legal dipindah ke sini */}
                    <Flex
                        direction="column"
                        gap="3"
                        className="items-start md:items-end"
                    >
                        <Link
                            href="#"
                            className="text-base text-gray-600 hover:text-black dark:text-gray-400 dark:hover:text-white"
                        >
                            Syarat Layanan
                        </Link>
                        <Link
                            href="#"
                            className="text-base text-gray-600 hover:text-black dark:text-gray-400 dark:hover:text-white"
                        >
                            Kebijakan Privasi
                        </Link>
                        <Link
                            href="#"
                            className="text-base text-gray-600 hover:text-black dark:text-gray-400 dark:hover:text-white"
                        >
                            Keamanan
                        </Link>
                    </Flex>
                </div>

                {/* 5. Bagian Bawah: Copyright (Dipisah) */}
                <div className="flex justify-end pt-8">
                    <Text size="2" className="text-gray-500">
                        © Fxology 2025
                    </Text>
                </div>
            </div>
        </footer>
    );
}
