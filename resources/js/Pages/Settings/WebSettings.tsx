import AdminLayout from '@/Layouts/AdminLayout';
import { WebSettingsProps } from '@/types/page';
import { Head } from '@inertiajs/react';
import React, { useState } from 'react';

import PageWindow from '@/Components/Multi-Sidebar/PageWindow';
import GeneralSettingsForm from './Partials/GeneralSettingsForm';
import MaintenanceSettingsForm from './Partials/MaintenanceSettingsForm';

export default function WebSettings({
    settings,
    menuGroups,
}: WebSettingsProps) {
    const [activeMenuKey, setActiveMenuKey] = useState<string>('general');

    const renderMainContent = () => {
        switch (activeMenuKey) {
            case 'general':
                return <GeneralSettingsForm settings={settings} />;
            case 'maintenance':
                return <MaintenanceSettingsForm settings={settings} />;
            default:
                return <GeneralSettingsForm settings={settings} />;
        }
    };

    return (
        <>
            <Head title="Web Settings" />
            <PageWindow
                activeMenuKey={activeMenuKey}
                setActiveMenuKey={setActiveMenuKey}
                menuGroups={menuGroups}
            >
                {renderMainContent()}
            </PageWindow>
        </>
    );
}

WebSettings.layout = (page: React.ReactNode) => (
    <AdminLayout>{page}</AdminLayout>
);
