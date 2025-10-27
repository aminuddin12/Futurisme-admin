export interface SidebarItem {
    key: string;
    label: string;
    icon?: string; // Optional: Icon name (e.g., from heroicons)
}

export interface SidebarData {
    groupKey: string;
    groupLabel: string;
    items: SidebarItem[];
}

export const sidebarMenuData: SidebarData[] = [
    {
        groupKey: 'account',
        groupLabel: 'Account',
        items: [
            { key: 'public-profile', label: 'Public Profile' },
            { key: 'notification', label: 'Notification' },
            { key: 'appearance', label: 'Appearance' },
            { key: 'accessibility', label: 'Accessibility' },
        ],
    },
    {
        groupKey: 'access',
        groupLabel: 'Access',
        items: [
            { key: 'email-username', label: 'Email & Username' },
            { key: 'verification', label: 'Verification' },
            { key: 'payment', label: 'Payment' },
            { key: 'organization', label: 'Organization' },
        ],
    },
    {
        groupKey: 'security',
        groupLabel: 'Security',
        items: [
            { key: 'password-auth', label: 'Password & Authentication' },
            { key: 'token-key', label: 'Token & Key' },
            { key: 'recovery', label: 'Recovery' },
            { key: 'session', label: 'Session' },
        ],
    },
];
