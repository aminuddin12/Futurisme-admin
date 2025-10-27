import ListItem from '@/Components/UI/ListItem';
import { SidebarData } from '@/Pages/Profile/Partials/SidebarListMenu'; // Import type/data

interface SidebarProps {
    menuData: SidebarData[];
    activeMenuKey: string;
    setActiveMenuKey: (key: string) => void;
}

export default function Sidebar({
    menuData,
    activeMenuKey,
    setActiveMenuKey,
}: SidebarProps) {
    return (
        <nav className="space-y-6">
            {menuData.map((group) => (
                <div key={group.groupKey}>
                    <h3 className="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                        {group.groupLabel}
                    </h3>
                    <ul className="space-y-1">
                        {group.items.map((item) => (
                            <ListItem
                                key={item.key}
                                label={item.label}
                                isActive={activeMenuKey === item.key}
                                onClick={() => setActiveMenuKey(item.key)}
                            />
                        ))}
                    </ul>
                </div>
            ))}
        </nav>
    );
}
