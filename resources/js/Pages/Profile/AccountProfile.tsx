import AdminLayout from '@/Layouts/AdminLayout';
import { Division, Insider, PageProps, Position, Profile } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import React from 'react';
import UpdateProfileForm from './Partials/UpdateProfileForm';

interface AccountProfileProps {
    insider: Insider;
    profile: Profile;
    positions: Position[];
    divisions: Division[];
    pageTitle?: string;
}

export default function AccountProfile() {
    const {
        props: {
            insider,
            profile,
            positions,
            divisions,
            pageTitle = 'Profile Settings',
        },
    } = usePage<PageProps<AccountProfileProps>>();
    return (
        <>
            <Head title={pageTitle} />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <UpdateProfileForm
                            insider={insider}
                            profile={profile}
                            positions={positions}
                            divisions={divisions}
                        />
                    </div>
                </div>
            </div>
        </>
    );
}

AccountProfile.layout = (page: React.ReactNode) => (
    <AdminLayout>{page}</AdminLayout>
);
