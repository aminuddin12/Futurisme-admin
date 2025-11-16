import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';
import React, { PropsWithChildren } from 'react';

// Tentukan tipe prop untuk layout
interface GInsiderLayoutProps {
    /**
     * Tipe layout yang akan ditampilkan.
     * 'form-with-image' untuk layout 2 kolom (Login, Register)
     * 'form-only' untuk layout 1 kolom terpusat (Forgot Password, Reset Password)
     */
    type: 'form-with-image' | 'form-only';

    /**
     * Sumber gambar (path) yang akan ditampilkan di sisi kanan.
     * Hanya digunakan jika type = 'form-with-image'.
     * Contoh: '/images/insider-login-art.jpg'
     */
    imageSrc?: string;

    /**
     * Teks alt untuk gambar.
     */
    imageAlt?: string;
}

/**
 * G-InsiderLayout adalah komponen layout standar untuk semua halaman
 * autentikasi Insider (Login, Register, Forgot Password, dll).
 *
 * @param {PropsWithChildren<GInsiderLayoutProps>} props
 * @param {React.ReactNode} props.children - Konten form (halaman) yang akan di-render.
 * @param {'form-with-image' | 'form-only'} props.type - Tipe layout yang dipilih.
 * @param {string} [props.imageSrc] - Sumber path gambar (opsional).
 * @param {string} [props.imageAlt] - Teks alt gambar (opsional).
 */
export default function GInsiderLayout({
    type,
    imageSrc = 'https://placehold.co/1000x1200/FFEDD5/F97316?text=Image+Placeholder', // Placeholder default
    imageAlt = 'Ilustrasi Autentikasi',
    children,
}: PropsWithChildren<GInsiderLayoutProps>) {
    // --- Layout 1: Hanya Form (Untuk Lupa Password, Reset Password) ---
    if (type === 'form-only') {
        return (
            <div className="flex min-h-screen flex-col items-center justify-center bg-gray-100 p-4 dark:bg-gray-900 sm:py-12">
                {/* Logo di atas form */}
                <div className="mb-6">
                    <Link href="/">
                        <ApplicationLogo className="h-16 w-auto text-gray-700 dark:text-gray-300" />
                    </Link>
                </div>

                {/* Kontainer Form */}
                <div className="w-full max-w-md overflow-hidden rounded-2xl bg-white p-8 shadow-xl dark:bg-gray-800 sm:p-10">
                    {children}
                </div>
            </div>
        );
    }

    // --- Layout 2: Form dengan Gambar (Untuk Login, Register) ---
    return (
        <div className="flex min-h-screen items-center justify-center bg-gray-100 p-4 dark:bg-gray-900">
            {/* Kontainer Utama */}
            <div className="flex w-full max-w-5xl overflow-hidden rounded-2xl bg-white shadow-xl dark:bg-gray-800">
                {/* Bagian Kiri: Form (Konten 'children') */}
                <div className="w-full p-8 lg:w-1/2 lg:p-12">
                    {/* Logo di dalam form */}
                    <div className="mb-8">
                        <Link href="/">
                            <ApplicationLogo className="h-12 w-auto text-gray-700 dark:text-gray-300" />
                        </Link>
                    </div>
                    {children}
                </div>

                {/* Bagian Kanan: Gambar Ilustrasi */}
                <div className="relative hidden w-1/2 bg-orange-100 lg:block">
                    <img
                        src={imageSrc}
                        alt={imageAlt}
                        className="h-full w-full object-cover"
                    />
                    {/* Anda bisa menambahkan overlay atau teks di atas gambar di sini jika perlu */}
                </div>
            </div>
        </div>
    );
}
