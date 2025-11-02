// resources/js/Pages/LandingPage.tsx

import Aurora from '@/Components/Aurora';
import { useBackgroundTheme } from '@/Context/BackgroundThemeContext';
import { Head } from '@inertiajs/react';
import { useMotionValue, useScroll } from 'framer-motion';

// Impor komponen-komponen yang sudah di-refactor
import BankingServicesSection from '@/Components/Landing-Page/BankingServicesSection';
import CookieBanner from '@/Components/Landing-Page/CookieBanner';
import HeroSection from '@/Components/Landing-Page/HeroSection';
import HowItWorksSection from '@/Components/Landing-Page/HowItWorksSection';
import LandingFooter from '@/Components/Landing-Page/LandingFooter';
import LandingHeader from '@/Components/Landing-Page/LandingHeader';
import MissionSection from '@/Components/Landing-Page/MissionSection';
import ServicesSection from '@/Components/Landing-Page/ServicesSection';
import Nebula from '@/Components/Nebula';

export default function LandingPage() {
    const { scrollYProgress } = useScroll();
    const { backgroundTheme } = useBackgroundTheme();
    const mouseX = useMotionValue(0);
    const mouseY = useMotionValue(0);

    function handleMouseMove(
        event: React.MouseEvent<HTMLDivElement, MouseEvent>,
    ) {
        const { clientX, clientY, currentTarget } = event;
        const { left, top, width, height } =
            currentTarget.getBoundingClientRect();
        mouseX.set(clientX - left - width / 2);
        mouseY.set(clientY - top - height / 2);
    }

    return (
        <>
            <Head title="No Time Limit Prop Firm - Fxology" />

            <div
                onMouseMove={handleMouseMove}
                className="relative flex min-h-screen flex-col overflow-hidden bg-white text-gray-900 dark:bg-[#080A08] dark:text-gray-200"
            >
                {backgroundTheme === 'nebula' ? (
                    <Nebula
                        scrollYProgress={scrollYProgress}
                        mouseX={mouseX}
                        mouseY={mouseY}
                    />
                ) : (
                    <Aurora scrollYProgress={scrollYProgress} mouseX={mouseX} mouseY={mouseY} />
                )}
                <LandingHeader />

                {/* 3. Gunakan tag <main> untuk konten utama */}
                <main className="relative z-10">
                    <HeroSection />
                    <BankingServicesSection />
                    <ServicesSection />
                    <HowItWorksSection />
                    <MissionSection />
                </main>

                <LandingFooter />
                <CookieBanner />
            </div>
        </>
    );
}
