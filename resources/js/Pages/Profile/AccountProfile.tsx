import AdminLayout from '@/Layouts/AdminLayout';
import { User } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import React, { useState } from 'react';

import ProfileWindow from '@/Components/Multi-Sidebar/PageWindow';

// Impor semua form yang akan dirender
import AccountDeleteForm from './Partials/AccountDeleteForm';
import AppearanceForm from './Partials/AppearanceForm';
import CustomForm from './Partials/CustomForm';
import PaymentForm from './Partials/PaymentForm';
import { sidebarMenuData } from './Partials/SidebarListMenu';
import PublicProfileForm from './Partials/PublicProfileForm';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';

export default function AccountProfile() {
    const { props } = usePage();
    const user = (props.auth as any).user as User | null | undefined;
    const pageTitle = props.pageTitle || 'Profile Settings';

    const [activeMenuKey, setActiveMenuKey] =
        useState<string>('public-profile');

    const renderMainContent = () => {
        switch (activeMenuKey) {
            case 'public-profile':
                return <PublicProfileForm user={user} />;
            case 'notification':
                return (
                    <CustomForm
                        title="Notification"
                        description="Manage notification preferences."
                    />
                );
            case 'appearance':
                return <AppearanceForm />;
            case 'accessibility':
                return (
                    <CustomForm
                        title="Accessibility"
                        description="Manage accessibility settings."
                    />
                );

            case 'email-username':
                return (
                    <CustomForm
                        title="Email & Username"
                        description="Manage your email and username."
                    />
                );
            case 'verification':
                return (
                    <CustomForm
                        title="Verification"
                        description="Verify your account."
                    />
                );
            case 'payment':
                return <PaymentForm />;
            case 'organization':
                return (
                    <CustomForm
                        title="Organization"
                        description="Manage organization details."
                    />
                );

            case 'password-auth':
                return <UpdatePasswordForm />;
            case 'token-key':
                return (
                    <CustomForm
                        title="Token & Key"
                        description="Manage API tokens and keys."
                    />
                );
            case 'recovery':
                return (
                    <CustomForm
                        title="Recovery"
                        description="Set account recovery options."
                    />
                );
            case 'session':
                return (
                    <CustomForm
                        title="Session"
                        description="Manage your active sessions."
                    />
                );

            case 'delete-account':
                return <AccountDeleteForm />;

            default:
                return <PublicProfileForm user={user} />;
        }
    };

    return (
        <>
            <Head title={pageTitle} />
            <ProfileWindow
                activeMenuKey={activeMenuKey}
                setActiveMenuKey={setActiveMenuKey}
                menuGroups={sidebarMenuData}
            >
                {renderMainContent()}
            </ProfileWindow>
        </>
    );
}

AccountProfile.layout = (page: React.ReactNode) => (
    <AdminLayout>{page}</AdminLayout>
);
