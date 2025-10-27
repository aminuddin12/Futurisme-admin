import ProfileWindow from '@/Components/Profile/ProfileWindow';
import { useState } from 'react';
import PublicProfileForm from './Partials/PublicProfileForm';
import { sidebarMenuData } from './Partials/SidebarListMenu'; // Assuming data is defined here
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
// Import other forms as needed

export default function AccountProfile({
    user /* Add other props passed from Laravel if needed */,
}) {
    // State to track the active menu item
    const [activeMenuKey, setActiveMenuKey] = useState('public-profile'); // Default to 'public-profile'

    // Function to render the correct form based on the active key
    const renderMainContent = () => {
        switch (activeMenuKey) {
            case 'public-profile':
                return <PublicProfileForm user={user} />;
            case 'password-auth':
                return <UpdatePasswordForm />;
            // Add cases for other menu keys:
            // case 'notification':
            //     return <NotificationForm />;
            // case 'email-username':
            //     return <EmailUsernameForm />;
            // ... etc.
            default:
                return <div>Select a menu item</div>;
        }
    };

    return (
        <ProfileWindow
            sidebarMenuData={sidebarMenuData}
            activeMenuKey={activeMenuKey}
            setActiveMenuKey={setActiveMenuKey}
        >
            {/* The children prop of ProfileWindow will be the main content */}
            {renderMainContent()}
        </ProfileWindow>
    );
}

// Ensure this page uses your authenticated layout if you have one
// Example (may vary based on your setup):
// AccountProfile.layout = page => <AuthenticatedLayout children={page} />;
