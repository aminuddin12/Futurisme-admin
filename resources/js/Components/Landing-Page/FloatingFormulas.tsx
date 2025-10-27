// resources/js/Components/Landing-Page/FloatingFormulas.tsx

import { motion } from 'framer-motion';
import { useEffect, useState } from 'react';

// --- Bagian 1: Hook Kustom untuk Efek Mengetik ---
/**
 * Hook kustom untuk efek mengetik.
 * @param fullText - Teks lengkap yang akan diketik.
 * @param speed - Kecepatan mengetik (ms per karakter).
 * @param initialDelay - Waktu tunggu sebelum mulai mengetik.
 */
function useTypingEffect(fullText: string, speed = 50, initialDelay = 1000) {
    const [displayedText, setDisplayedText] = useState('');

    useEffect(() => {
        // Acak waktu tunggu agar tidak semua mulai bersamaan
        const startDelay = Math.random() * initialDelay + 500;

        const typingTimer = setTimeout(() => {
            let i = 0;
            // Timer untuk mengetik
            const intervalId = setInterval(() => {
                setDisplayedText(fullText.substring(0, i + 1));
                i++;
                if (i === fullText.length) {
                    clearInterval(intervalId);
                    // Timer untuk menghapus teks setelah selesai
                    setTimeout(() => {
                        setDisplayedText('');
                    }, 3000); // Tunggu 3 detik sebelum menghapus
                }
            }, speed);

            return () => clearInterval(intervalId);
        }, startDelay);

        return () => clearTimeout(typingTimer);
    }, [fullText, speed, initialDelay]); // Akan me-restart jika text berubah

    return displayedText;
}

// --- Bagian 2: Komponen Teks Mengetik ---
/**
 * Komponen yang merender teks dengan efek mengetik dan kursor.
 */
function TypingText({ fullText }: { fullText: string }) {
    const displayedText = useTypingEffect(fullText, 75);

    return (
        <span>
            {displayedText}
            {/* Kursor Berkedip */}
            <motion.span
                animate={{ opacity: [0, 1, 0] }}
                transition={{ duration: 1, repeat: Infinity }}
                className="ml-0.5 inline-block h-4 w-px translate-y-0.5 bg-current"
                aria-hidden="true"
            />
        </span>
    );
}

// --- Bagian 3: Data Animasi Bervariasi ---
const mathAndCodeItems = [
    {
        id: 1,
        text: '(12+12)',
        type: 'float', // Hanya float
        style: { top: '15%', left: '10%', fontSize: '1.5rem' }, // text-2xl
        animate: { y: [0, -15, 0] },
        transition: { duration: 8, repeat: Infinity, ease: 'easeInOut' },
    },
    {
        id: 2,
        text: 'const x = 10;',
        type: 'type', // Efek mengetik
        style: { top: '30%', left: '20%', fontSize: '1.125rem' }, // text-lg
        animate: { y: [0, 10, 0] }, // Tetap float
        transition: { duration: 10, repeat: Infinity, ease: 'easeInOut' },
    },
    {
        id: 3,
        text: 'F(x) = ∫f(x)dx',
        type: 'fade', // Fade in/out
        style: { top: '50%', left: '5%', fontSize: '1.875rem' }, // text-3xl
        animate: { opacity: [0.1, 0.7, 0.1], y: [0, -5, 0] },
        transition: { duration: 7, repeat: Infinity, ease: 'easeInOut' },
    },
    {
        id: 4,
        text: 'useEffect()',
        type: 'color', // Ganti warna
        style: { top: '65%', left: '15%', fontSize: '1.25rem' }, // text-xl
        animate: {
            y: [0, -12, 0],
            color: [
                'rgba(255, 255, 255, 0.1)',
                'rgba(52, 211, 153, 0.4)', // emerald
                'rgba(255, 255, 255, 0.1)',
                'rgba(96, 165, 250, 0.4)', // blue
                'rgba(255, 255, 255, 0.1)',
            ],
        },
        transition: { duration: 10, repeat: Infinity, ease: 'easeInOut' },
    },
    {
        id: 5,
        text: '12',
        type: 'fade-fast',
        style: { top: '20%', right: '10%', fontSize: '2.25rem' }, // text-4xl
        animate: { opacity: [0.1, 0.5, 0.1] },
        transition: { duration: 4, repeat: Infinity, ease: 'linear' },
    },
    {
        id: 6,
        text: 'SELECT * FROM users;',
        type: 'type', // Efek mengetik
        style: { top: '45%', right: '15%', fontSize: '1.5rem' }, // text-2xl
        animate: { y: [0, 15, 0] }, // Tetap float
        transition: { duration: 11, repeat: Infinity, ease: 'easeInOut' },
    },
    {
        id: 7,
        text: 'Math.random()',
        type: 'color-fade',
        style: { top: '60%', right: '25%', fontSize: '1.125rem' }, // text-lg
        animate: {
            opacity: [0.1, 0.6, 0.1],
            color: [
                'rgba(248, 113, 113, 0.4)', // red
                'rgba(255, 255, 255, 0.1)',
                'rgba(167, 139, 250, 0.4)', // violet
            ],
        },
        transition: { duration: 8, repeat: Infinity, ease: 'linear' },
    },
    {
        id: 8,
        text: 'Σ(n=1, k)',
        type: 'float-fade',
        style: { top: '75%', right: '10%', fontSize: '1.875rem' }, // text-3xl
        animate: { y: [0, -20, 0], opacity: [0.6, 0.1, 0.6] },
        transition: { duration: 12, repeat: Infinity, ease: 'easeInOut' },
    },
];

// --- Bagian 4: Komponen Utama ---
export default function FloatingFormulas() {
    return (
        <>
            {mathAndCodeItems.map((item) => (
                <motion.div
                    key={item.id}
                    className="absolute z-10 font-mono text-black/10 dark:text-white/10"
                    style={{ ...item.style }}
                    animate={item.animate}
                    transition={item.transition}
                >
                    {/* Render konten berdasarkan tipe */}
                    {item.type === 'type' ? (
                        <TypingText fullText={item.text} />
                    ) : (
                        item.text
                    )}
                </motion.div>
            ))}
        </>
    );
}
