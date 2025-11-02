// resources/js/Pages/Profile/Partials/SidebarListMenu.tsx

export interface ProfileSidebarItem {
    key: string; // ID unik
    label: string;
    icon: string;
}

export interface ProfileSidebarItemGroup {
    title: string;
    items: ProfileSidebarItem[];
}

export const sidebarMenuData: ProfileSidebarItemGroup[] = [
    {
        title: 'Account',
        items: [
            {
                key: 'account-profile',
                label: 'Account Profile',
                icon: 'heroicons:identification',
            },
            {
                key: 'public-profile',
                label: 'Public Profile',
                icon: 'heroicons:user-circle',
            },
            {
                key: 'notification',
                label: 'Notification',
                icon: 'heroicons:bell',
            },
            {
                key: 'appearance',
                label: 'Appearance',
                icon: 'heroicons:swatch',
            },
            {
                key: 'accessibility',
                label: 'Accessibility',
                icon: 'heroicons:command-line',
            }, // Ganti ikon jika perlu
        ],
    },
    {
        title: 'Access',
        items: [
            {
                key: 'email-username',
                label: 'Email & Username',
                icon: 'heroicons:envelope-open',
            },
            {
                key: 'verification',
                label: 'Verification',
                icon: 'heroicons:check-badge',
            },
            { key: 'payment', label: 'Payment', icon: 'heroicons:credit-card' },
            {
                key: 'organization',
                label: 'Organization',
                icon: 'heroicons:building-office-2',
            },
        ],
    },
    {
        title: 'Security',
        items: [
            {
                key: 'password-auth',
                label: 'Password & Authentication',
                icon: 'heroicons:key',
            },
            {
                key: 'token-key',
                label: 'Token & Key',
                icon: 'heroicons:finger-print',
            }, // Ganti ikon jika perlu
            {
                key: 'recovery',
                label: 'Recovery',
                icon: 'heroicons:shield-check',
            },
            {
                key: 'session',
                label: 'Session',
                icon: 'heroicons:computer-desktop',
            },
        ],
    },
    {
        title: 'Danger Zone', // Grup untuk Delete
        items: [
            {
                key: 'delete-account',
                label: 'Delete Account',
                icon: 'heroicons:trash',
            },
        ],
    },
];
