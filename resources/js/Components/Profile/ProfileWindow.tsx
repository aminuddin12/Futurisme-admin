import { SidebarData } from '@/Pages/Profile/Partials/SidebarListMenu'; // Import type
import React from 'react';
import Main from './Main';
import Sidebar from './Sidebar';

interface ProfileWindowProps {
    sidebarMenuData: SidebarData[];
    activeMenuKey: string;
    setActiveMenuKey: (key: string) => void;
    children: React.ReactNode; // Content for the Main area
}

export default function ProfileWindow({
    sidebarMenuData,
    activeMenuKey,
    setActiveMenuKey,
    children,
}: ProfileWindowProps) {
    return (
        // Adjust padding/max-width as needed for your overall layout
        <div className="container mx-auto px-4 py-8 md:py-12">
            <div className="md:flex md:gap-8 lg:gap-12">
                {/* Sidebar */}
                <div className="mb-8 w-full md:mb-0 md:w-1/4 lg:w-1/5">
                    <Sidebar
                        menuData={sidebarMenuData}
                        activeMenuKey={activeMenuKey}
                        setActiveMenuKey={setActiveMenuKey}
                    />
                </div>

                {/* Main Content Area */}
                <div className="w-full md:w-3/4 lg:w-4/5">
                    <Main>{children}</Main>
                </div>
            </div>
        </div>
    );
}
