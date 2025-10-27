// resources/js/Components/Profile/ProfileWindow.tsx
import React from 'react';
import { Box, Card } from '@radix-ui/themes';

// UI Components
import AccountUser from './UI/AccountUser';
//import AccountPersonalInformation from './UI/AccountPersonalInformation';
//import AccountAddress from './UI/AccountAddress';
import AccountSocialMedia from './UI/AccountSocialMedia';

// Partials Components (nantinya dari pages/Profile/Partials)
// Ganti impor ini saat Anda membuat komponen Partials
// const AccountUpdateProfileForm = () => <AccountPersonalInformation user={null} />; // Placeholder
const AccountHistoryList = () => <Box p="4"><p>Account History Placeholder</p></Box>; // Placeholder
const AccountUpdatePasswordForm = () => <Box p="4"><p>Update Password Placeholder</p></Box>; // Placeholder
const AccountDeleteForm = () => <Box p="4"><p>Delete Account Placeholder</p></Box>; // Placeholder


interface ProfileWindowProps {
    activeItemId: string;
    user: any; // Data user
}

export default function ProfileWindow({ activeItemId, user }: ProfileWindowProps) {
    const renderContent = () => {
        switch (activeItemId) {
            case 'account':
                return <AccountUser user={user} />;
            // case 'personal':
            //     return <AccountUpdateProfileForm />; // Atau tampilkan Form
            // case 'address':
            //     return <AccountAddress />; // Atau form update alamat
            case 'social':
                return <AccountSocialMedia />; // Atau form update social media
            case 'history':
                return <AccountHistoryList />;
            case 'password':
                return <AccountUpdatePasswordForm />;
            case 'delete':
                return <AccountDeleteForm />;
            default:
                return <AccountUser user={user} />; // Default ke Account
        }
    };

    return (
        <Card className="flex-1 !m-0 !rounded-lg !shadow-sm border border-gray-200 dark:border-gray-700 p-4 m-4">
            <Box p="6"> {/* Beri padding di dalam Card */}
                 {renderContent()}
            </Box>
        </Card>
    );
}
