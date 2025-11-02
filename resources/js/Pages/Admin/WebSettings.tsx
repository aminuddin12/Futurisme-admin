import AdminLayout from '@/Layouts/AdminLayout';
import { Head } from '@inertiajs/react';
import React, { useState } from 'react';

import PageWindow from '@/Components/Multi-Sidebar/PageWindow';
import {
    webSettingsMenuData,
    WebSettingsSidebarItemGroup,
} from './WebSettingsSidebarMenu';

// Impor form-form untuk Web Settings
import CustomForm from '@/Pages/Profile/Partials/CustomForm'; // Bisa digunakan kembali
import GeneralSettingsForm from './GeneralSettingsForm';
import SeoSettingsForm from './SeoSettingsForm';

export default function WebSettings() {
    const [activeMenuKey, setActiveMenuKey] = useState<string>('general');

    const renderMainContent = () => {
        switch (activeMenuKey) {
            case 'general':
                return <GeneralSettingsForm />;
            case 'seo':
                return <SeoSettingsForm />;
            case 'api-keys':
                return (
                    <CustomForm
                        title="API Keys"
                        description="Manage API keys for third-party integrations."
                    />
                );
            case 'maintenance':
                return (
                    <CustomForm
                        title="Maintenance Mode"
                        description="Enable or disable maintenance mode for the website."
                    />
                );
            default:
                return <GeneralSettingsForm />;
        }
    };

    return (
        <>
            <Head title="Web Settings" />
            <PageWindow
                activeMenuKey={activeMenuKey}
                setActiveMenuKey={setActiveMenuKey}
                menuGroups={
                    webSettingsMenuData as WebSettingsSidebarItemGroup[]
                }
            >
                {renderMainContent()}
            </PageWindow>
        </>
    );
}

WebSettings.layout = (page: React.ReactNode) => (
    <AdminLayout>{page}</AdminLayout>
);
