// resources/js/Components/Profile/Main.tsx
import { Flex } from '@radix-ui/themes';

// Impor form/konten dari Partials
import AccountDeleteForm from '@/Pages/Profile/Partials/AccountDeleteForm';
import CustomForm from '@/Pages/Profile/Partials/CustomForm'; // Placeholder untuk form lain
import PublicProfileForm from '@/Pages/Profile/Partials/PublicProfileForm';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm';
// ... impor form lainnya

import { User } from '@/types';

interface MainProps {
    activeMenuKey: string;
    user: User; // Data user
}

export default function Main({ activeMenuKey, user }: MainProps) {
    const renderContent = () => {
        switch (activeMenuKey) {
            case 'public-profile':
                return <PublicProfileForm user={user} />;
            case 'password-auth':
                return <UpdatePasswordForm />;
            case 'delete-account': // Sesuaikan key dengan SidebarListMenu
                return <AccountDeleteForm />;
            // Tambahkan case untuk key lainnya
            case 'notification':
                return (
                    <CustomForm
                        title="Notifications"
                        description="Manage your notification preferences."
                    />
                );
            case 'appearance':
                return (
                    <CustomForm
                        title="Appearance"
                        description="Customize the look and feel."
                    />
                );
            // ... case lainnya
            default:
                // Tampilkan Public Profile sebagai default jika key tidak cocok
                return <PublicProfileForm user={user} />;
        }
    };

    return (
        <Flex direction="column" gap="6" className="flex-1">
            {renderContent()}
        </Flex>
    );
}
