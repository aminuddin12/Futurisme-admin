// resources/js/Components/Landing-Page/Nebula.tsx

import { motion, MotionValue, useTransform } from 'framer-motion';

// Tentukan interface untuk props yang akan kita terima (scrollYProgress)
interface NebulaProps {
    scrollYProgress: MotionValue<number>;
}

// Definisikan keyframes scroll: [Awal, Section 1, Section 2, Section 3, Akhir]
const keyframes = [0, 0.25, 0.5, 0.75, 1];

/**
 * Komponen Blob individual
 * Masing-masing blob memiliki animasi warna, skala, dan bentuk (border-radius) sendiri
 */
function Blob({
    scrollYProgress,
    colors,
    scales,
    borderRadii,
    opacities,
    initialPosition,
}: {
    scrollYProgress: MotionValue<number>;
    colors: string[];
    scales: number[];
    borderRadii: string[];
    opacities: number[];
    initialPosition: { top: string; left: string };
}) {
    const backgroundColor = useTransform(scrollYProgress, keyframes, colors);
    const scale = useTransform(scrollYProgress, keyframes, scales);
    const borderRadius = useTransform(scrollYProgress, keyframes, borderRadii);
    const opacity = useTransform(scrollYProgress, keyframes, opacities);

    return (
        <motion.div
            className="absolute [filter:blur(100px)]"
            style={{
                top: initialPosition.top,
                left: initialPosition.left,
                height: '300px',
                width: '300px',
                backgroundColor,
                scale,
                borderRadius,
                opacity,
            }}
        />
    );
}

/**
 * Komponen Nebula Utama
 * Container ini akan menggerakkan semua blob di dalamnya melintasi halaman
 */
export default function Nebula({ scrollYProgress }: NebulaProps) {
    // 1. ANIMASI POSISI CONTAINER (menggerakkan seluruh grup)
    // Atas -> Kanan Atas -> Kiri Tengah -> Kanan Tengah -> Bawah Tengah
    const top = useTransform(scrollYProgress, keyframes, [
        '25%',
        '30%',
        '50%',
        '75%',
        '90%',
    ]);
    const left = useTransform(scrollYProgress, keyframes, [
        '50%',
        '80%',
        '20%',
        '80%',
        '50%',
    ]);

    // 2. DEFINISI UNTUK MASING-MASING BLOB
    const blob1 = {
        colors: [
            'rgba(52, 211, 153, 0.3)', // Hijau
            'rgba(59, 130, 246, 0.3)', // Biru
            'rgba(168, 85, 247, 0.3)', // Ungu
            'rgba(236, 72, 153, 0.3)', // Pink
            'rgba(52, 211, 153, 0.3)', // Hijau
        ],
        scales: [1, 1.2, 0.8, 1.5, 1],
        borderRadii: [
            '50%',
            '30% 70% 70% 30%',
            '60% 40% 30% 70%',
            '40% 60% 60% 40%',
            '50%',
        ],
        opacities: [0.6, 0.8, 0.7, 0.9, 0.6],
        initialPosition: { top: '0', left: '0' },
    };

    const blob2 = {
        colors: [
            'rgba(245, 158, 11, 0.2)', // Kuning
            'rgba(236, 72, 153, 0.2)', // Pink
            'rgba(52, 211, 153, 0.2)', // Hijau
            'rgba(59, 130, 246, 0.2)', // Biru
            'rgba(245, 158, 11, 0.2)', // Kuning
        ],
        scales: [1.2, 0.8, 1.5, 1, 1.2],
        borderRadii: [
            '40% 60% 60% 40%',
            '50%',
            '30% 70% 70% 30%',
            '60% 40% 30% 70%',
            '40% 60% 60% 40%',
        ],
        opacities: [0.5, 0.7, 0.6, 0.8, 0.5],
        initialPosition: { top: '30%', left: '30%' }, // Posisi offset dari blob 1
    };

    return (
        <motion.div
            className="absolute z-0 h-[500px] w-[500px] -translate-x-1/2 -translate-y-1/2"
            style={{
                top,
                left,
            }}
        >
            <Blob scrollYProgress={scrollYProgress} {...blob1} />
            <Blob scrollYProgress={scrollYProgress} {...blob2} />
        </motion.div>
    );
}
