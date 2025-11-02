import { createContext, ReactNode, useContext, useEffect, useState } from 'react';

export type SidebarMode = 'icon' | 'full' | 'mobile';

interface SidebarContextType {
    mode: SidebarMode;
    setMode: (mode: SidebarMode) => void;
    toggleMode: () => void; // Toggle antara 'icon' dan 'full'
    expandedGroups: string[];
    toggleGroup: (groupKey: string) => void;
    expandedMenus: string[];
    toggleMenu: (menuKey: string) => void;
}

const SidebarContext = createContext<SidebarContextType | undefined>(undefined);

export function SidebarProvider({ children }: { children: ReactNode }) {
    // 1. Baca state dari localStorage saat inisialisasi
    const [mode, setMode] = useState<SidebarMode>(() => {
        if (typeof window === 'undefined') return 'full';
        const savedMode = localStorage.getItem('sidebarMode') as SidebarMode;
        return savedMode && ['full', 'icon', 'mobile'].includes(savedMode)
            ? savedMode
            : 'full';
    });

    const [expandedGroups, setExpandedGroups] = useState<string[]>(() => {
        if (typeof window === 'undefined') return ['group-menu'];
        const saved = localStorage.getItem('sidebarExpandedGroups');
        return saved ? JSON.parse(saved) : ['group-menu'];
    });

    const [expandedMenus, setExpandedMenus] = useState<string[]>(() => {
        if (typeof window === 'undefined') return [];
        const saved = localStorage.getItem('sidebarExpandedMenus');
        return saved ? JSON.parse(saved) : [];
    });

    // 2. Simpan state ke localStorage setiap kali ada perubahan
    useEffect(() => {
        if (typeof window !== 'undefined') {
            localStorage.setItem('sidebarMode', mode);
        }
    }, [mode]);

    useEffect(() => {
        if (typeof window !== 'undefined') {
            localStorage.setItem(
                'sidebarExpandedGroups',
                JSON.stringify(expandedGroups),
            );
        }
    }, [expandedGroups]);

    useEffect(() => {
        if (typeof window !== 'undefined') {
            localStorage.setItem(
                'sidebarExpandedMenus',
                JSON.stringify(expandedMenus),
            );
        }
    }, [expandedMenus]);

    const toggleMode = () => {
        setMode((prev) => (prev === 'icon' ? 'full' : 'icon'));
    };

    const toggleGroup = (groupKey: string) => {
        setExpandedGroups((prev) => prev.includes(groupKey) ? prev.filter((k) => k !== groupKey) : [...prev, groupKey]);
    };

    const toggleMenu = (menuKey: string) => {
        setExpandedMenus((prev) => prev.includes(menuKey) ? prev.filter((k) => k !== menuKey) : [...prev, menuKey]);
    };

    return (
        <SidebarContext.Provider
            value={{
                mode,
                setMode,
                toggleMode,
                expandedGroups,
                toggleGroup,
                expandedMenus,
                toggleMenu,
            }}
        >
            {children}
        </SidebarContext.Provider>
    );
}

export function useSidebar() {
    const context = useContext(SidebarContext);
    if (context === undefined) {
        throw new Error('useSidebar must be used within a SidebarProvider');
    }
    return context;
}
