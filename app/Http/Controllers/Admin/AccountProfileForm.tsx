import { Division, Insider, PageProps, Position, Profile } from '@/types';
import { usePage } from '@inertiajs/react';
import React from 'react';
import UpdateProfileForm from './UpdateProfileForm';

interface AccountProfileProps {
    insider: Insider;
    profile: Profile;
    positions: Position[];
    divisions: Division[];
}

export default function AccountProfileForm() {
    const {
        props: { insider, profile, positions, divisions },
    } = usePage<PageProps<AccountProfileProps>>();

    return (
        <div className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <UpdateProfileForm
                insider={insider}
                profile={profile}
                positions={positions}
                divisions={divisions}
            />
        </div>
    );
}
