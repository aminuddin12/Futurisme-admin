import Aurora from '@/Components/Aurora';
import Nebula from '@/Components/Nebula';
import FullMode from '@/Components/Sidebar/fullMode';
import IconMode from '@/Components/Sidebar/iconMode';
import MobileMode from '@/Components/Sidebar/mobileMode';
import { SidebarProvider, useSidebar } from '@/Components/Sidebar/ModeChanger';
import { useBackgroundTheme } from '@/Context/BackgroundThemeContext';
import { cn } from '@/lib/utils';
import { useMotionValue, useScroll } from 'framer-motion';
import React, { ReactNode, useEffect, useRef, useState } from 'react';

const useMediaQuery = (query: string) => {
    const [matches, setMatches] = useState(false);
    useEffect(() => {
        const media = window.matchMedia(query);
        const listener = () => setMatches(media.matches);
        listener();
        media.addEventListener('change', listener);
        return () => media.removeEventListener('change', listener);
    }, [query]);
    return matches;
};

const SidebarRenderer = ({ children }: { children: ReactNode }) => {
    const { mode, setMode } = useSidebar();
    const isMobile = useMediaQuery('(max-width: 768px)');
    const { backgroundTheme } = useBackgroundTheme();
    const sidebarRef = useRef<HTMLAsideElement>(null);

    const { scrollYProgress } = useScroll();
    const mouseX = useMotionValue(0);
    const mouseY = useMotionValue(0);

    useEffect(() => {
        if (isMobile) {
            if (mode !== 'mobile') {
                setMode('mobile');
            }
        } else if (mode === 'mobile') {
            setMode('full');
        }
    }, [isMobile, mode, setMode]);

    const handleMouseMoveForBorder = (
        e: React.MouseEvent<HTMLAsideElement>,
    ) => {
        if (sidebarRef.current) {
            const rect = sidebarRef.current.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            sidebarRef.current.style.setProperty('--mouse-x', `${x}px`);
            sidebarRef.current.style.setProperty('--mouse-y', `${y}px`);
        }
    };

    const handleMouseMoveForNebula = (e: React.MouseEvent<HTMLDivElement>) => {
        const { clientX, clientY } = e;
        const { innerWidth, innerHeight } = window;
        mouseX.set((clientX / innerWidth) * 2 - 1);
        mouseY.set((clientY / innerHeight) * 2 - 1);
    };

    return (
        <div
            className="relative flex h-screen overflow-hidden"
            onMouseMove={handleMouseMoveForNebula}
        >
            {backgroundTheme === 'nebula' ? (
                <Nebula
                    scrollYProgress={scrollYProgress}
                    mouseX={mouseX}
                    mouseY={mouseY}
                />
            ) : (
                <Aurora
                    scrollYProgress={scrollYProgress}
                    mouseX={mouseX}
                    mouseY={mouseY}
                />
            )}
            <aside
                ref={sidebarRef}
                onMouseMove={handleMouseMoveForBorder}
                className={cn(
                    'z-40 hidden h-full flex-col transition-all duration-300 ease-in-out md:flex',
                    'glassmorphism animated-border',
                    mode === 'full' ? 'w-60' : 'w-[72px]',
                )}
            >
                {mode === 'full' ? <FullMode /> : <IconMode />}
            </aside>

            <div className="flex flex-1 flex-col overflow-auto">{children}</div>

            {isMobile && <MobileMode />}
        </div>
    );
};

export default function SidebarLayout({ children }: { children: ReactNode }) {
    return (
        <SidebarProvider>
            <SidebarRenderer>{children}</SidebarRenderer>
        </SidebarProvider>
    );
}
