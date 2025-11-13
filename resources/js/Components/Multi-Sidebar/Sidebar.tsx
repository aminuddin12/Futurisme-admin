// resources/js/Components/Profile/Sidebar.tsx
import { ProfileSidebarItemGroup } from '@/Pages/Profile/Partials/SidebarListMenu'; // Impor tipe data
import { Flex, Separator, Text } from '@radix-ui/themes';
import ProfileListItem from './ListItem'; // Ganti nama impor

interface SidebarProps {
    menuGroups: ProfileSidebarItemGroup[]; // Terima grup menu
    activeMenuKey: string;
    setActiveMenuKey: (key: string) => void;
}

export default function Sidebar({
    menuGroups,
    activeMenuKey,
    setActiveMenuKey,
}: SidebarProps) {
    return (
        <Flex
            direction="column"
            gap="1"
            className="w-80px sticky top-4 h-fit flex-shrink-0 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800"
        >
            {/* PERBAIKAN:
              Tambahkan tanda tanya (?) setelah menuGroups.
              Ini berarti "Jika menuGroups ada (tidak undefined), jalankan .map().
              Jika tidak, jangan lakukan apa-apa (dan tidak akan crash)."
            */}
            {menuGroups?.map((group, groupIndex) => (
                <div key={group.title}>
                    {groupIndex > 0 && (
                        <Separator my="3" className="dark:!bg-gray-700" />
                    )}
                    <Text
                        size="1"
                        weight="medium"
                        mb="2"
                        className="px-2 py-2 uppercase tracking-wider text-gray-500 dark:text-gray-400"
                    >
                        {group.title}
                    </Text>
                    {/* Kita juga tambahkan '?' di sini untuk keamanan ekstra */}
                    {group.items?.map((item) => (
                        <ProfileListItem
                            key={item.key}
                            icon={item.icon}
                            label={item.label}
                            isActive={item.key === activeMenuKey}
                            onClick={() => setActiveMenuKey(item.key)}
                        />
                    ))}
                </div>
            ))}
        </Flex>
    );
}
