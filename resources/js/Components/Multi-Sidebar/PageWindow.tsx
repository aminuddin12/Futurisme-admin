// resources/js/Components/Profile/PageWindow.tsx
import { sidebarMenuData } from '@/Pages/Profile/Partials/SidebarListMenu'; // Impor data & tipe
import { User } from '@/types';
import { Flex } from '@radix-ui/themes';
import Main from './Main';
import Sidebar from './Sidebar';

interface PageWindowProps {
    activeMenuKey: string;
    setActiveMenuKey: (key: string) => void;
    user: User;
}

export default function PageWindow({
    activeMenuKey,
    setActiveMenuKey,
    user,
}: PageWindowProps) {
    return (
        <Flex gap="6" align="start" className="flex w-full px-6 py-4">
            {' '}
            {/* Layout utama: Sidebar | Main */}
            <Sidebar
                menuGroups={sidebarMenuData} // Kirim data menu
                activeMenuKey={activeMenuKey}
                setActiveMenuKey={setActiveMenuKey}
            />
            <Main activeMenuKey={activeMenuKey} user={user} />
        </Flex>
    );
}
