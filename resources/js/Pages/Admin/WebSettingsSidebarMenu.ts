export interface WebSettingsSidebarItem {
    key: string;
    label: string;
    icon: string;
}

export interface WebSettingsSidebarItemGroup {
    title: string;
    items: WebSettingsSidebarItem[];
}

export const webSettingsMenuData: WebSettingsSidebarItemGroup[] = [
    {
        title: 'Configuration',
        items: [
            {
                key: 'general',
                label: 'General',
                icon: 'heroicons:cog-6-tooth',
            },
            {
                key: 'seo',
                label: 'SEO',
                icon: 'heroicons:magnifying-glass-circle',
            },
            {
                key: 'api-keys',
                label: 'API Keys',
                icon: 'heroicons:key',
            },
        ],
    },
    {
        title: 'Advanced',
        items: [
            {
                key: 'maintenance',
                label: 'Maintenance Mode',
                icon: 'heroicons:wrench-screwdriver',
            },
        ],
    },
];
