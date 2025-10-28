// resources/js/Components/Profile/Sidebar.tsx
import { ProfileSidebarItemGroup } from '@/Pages/Profile/Partials/SidebarListMenu'; // Impor tipe data
import { Flex, Separator, Text } from '@radix-ui/themes';
import ProfileListItem from './ListItem'; // Ganti nama impor

interface ProfileSidebarProps {
    menuGroups: ProfileSidebarItemGroup[]; // Terima grup menu
    activeMenuKey: string;
    setActiveMenuKey: (key: string) => void;
}

export default function ProfileSidebar({
    menuGroups,
    activeMenuKey,
    setActiveMenuKey,
}: ProfileSidebarProps) {
    return (
        <Flex
            direction="column"
            gap="1"
            className="sticky top-4 h-fit w-auto flex-shrink-0 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800"
        >
            {menuGroups.map((group, groupIndex) => (
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
                    {group.items.map((item) => (
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
