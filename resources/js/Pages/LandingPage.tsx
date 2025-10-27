// resources/js/Pages/LandingPage.tsx

import { Head } from '@inertiajs/react';
import { useScroll } from 'framer-motion';

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
    return (
        <>
            <Head title="No Time Limit Prop Firm - Fxology" />

            {/* 1. Modifikasi wrapper utama */}
            <div className="relative flex min-h-screen flex-col overflow-hidden bg-white text-gray-900 dark:bg-[#080A08] dark:text-gray-200">
                {/* 2. HAPUS div Nebula dan <FloatingFormulas /> dari sini */}
                <Nebula scrollYProgress={scrollYProgress} />
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
