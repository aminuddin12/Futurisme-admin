// resources/js/Components/Profile/PageWindow.tsx
import { ProfileSidebarItemGroup } from '@/Pages/Profile/Partials/SidebarListMenu';
import { Flex } from '@radix-ui/themes';
import React from 'react';
import Sidebar from './Sidebar';

interface PageWindowProps {
    activeMenuKey: string;
    setActiveMenuKey: (key: string) => void;
    menuGroups: ProfileSidebarItemGroup[];
    children: React.ReactNode;
}

export default function PageWindow({
    activeMenuKey,
    setActiveMenuKey,
    menuGroups,
    children,
}: PageWindowProps) {
    return (
        <Flex gap="6" align="start" className="flex w-full px-6 py-4">
            <Sidebar
                menuGroups={menuGroups}
                activeMenuKey={activeMenuKey}
                setActiveMenuKey={setActiveMenuKey}
            />
            <div className="flex-1">{children}</div>
        </Flex>
    );
}
