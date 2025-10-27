import AdminBadge from '@/Components/Badge/AdminBadge';
import BoxItem from '@/Components/Profile/BoxItem';
import ProfileImage from '@/Components/Profile/UI/ProfileImage'; // Assuming you create this
import ActionButton from '@/Components/UI/ActionButton'; // Example Action Button
import InputError from '@/Components/UI/InputError';
import InputLabel from '@/Components/UI/InputLabel';
import PrimaryButton from '@/Components/UI/PrimaryButton';
import TextInput from '@/Components/UI/TextInput';
import { useForm, usePage } from '@inertiajs/react';
import React from 'react';

export default function PublicProfileForm({ user }) {
    // usePage().props gives access to shared data from Laravel
    const { props } = usePage();
    // Assuming auth.user contains the logged-in user details passed via HandleInertiaRequests
    const currentUser = props.auth?.user;

    const { data, setData, patch, errors, processing, recentlySuccessful } =
        useForm({
            name: currentUser?.name || '',
            email: currentUser?.email || '',
            // Add other fields like username, bio, etc.
        });

    const submit = (e: React.FormEvent) => {
        e.preventDefault();
        // Adjust the route as per your Laravel routes
        patch(route('profile.update'), { preserveScroll: true });
    };

    return (
        <>
            {/* Box Public Account */}
            <BoxItem
                title="Public Account"
                actions={
                    <ActionButton onClick={() => alert('Edit Public Account')}>
                        Edit
                    </ActionButton>
                }
            >
                <div className="flex items-center space-x-4">
                    <ProfileImage
                        src={currentUser?.profile_photo_url}
                        alt={currentUser?.name}
                    />
                    <div>
                        <h3 className="text-lg font-medium text-gray-900 dark:text-white">
                            {currentUser?.name}
                        </h3>
                        <p className="text-sm text-gray-500 dark:text-gray-400">
                            {currentUser?.email}
                        </p>
                        <div className="mt-2">
                            {/* Conditionally render badges */}
                            {currentUser?.isAdmin && <AdminBadge />}
                        </div>
                    </div>
                </div>
            </BoxItem>

            {/* Box Status & Quote (Example - Static) */}
            <BoxItem title="Status & Quote">
                <p className="text-gray-600 dark:text-gray-300">
                    Set your status and a quote.
                </p>
                {/* Add inputs for status/quote here */}
            </BoxItem>

            {/* Box Account Detail (Example Form) */}
            <BoxItem title="Account Details">
                <form onSubmit={submit} className="space-y-4">
                    <div>
                        <InputLabel htmlFor="name" value="Name" />
                        <TextInput
                            id="name"
                            className="mt-1 block w-full"
                            value={data.name}
                            onChange={(e) => setData('name', e.target.value)}
                            required
                            autoComplete="name"
                        />
                        <InputError className="mt-2" message={errors.name} />
                    </div>
                    <div>
                        <InputLabel htmlFor="email" value="Email" />
                        <TextInput
                            id="email"
                            type="email"
                            className="mt-1 block w-full cursor-not-allowed bg-gray-100 dark:bg-gray-700"
                            value={data.email}
                            readOnly // Email usually not changeable directly
                        />
                    </div>
                    {/* Add other fields like username, bio, location etc. */}

                    <div className="flex items-center gap-4">
                        <PrimaryButton disabled={processing}>
                            Save
                        </PrimaryButton>
                        {recentlySuccessful && (
                            <p className="text-sm text-gray-600 dark:text-gray-400">
                                Saved.
                            </p>
                        )}
                    </div>
                </form>
            </BoxItem>

            {/* Placeholder for other boxes */}
            <BoxItem title="Address">Address Form Goes Here...</BoxItem>
            <BoxItem title="Social Account">
                Social Media Form Goes Here...
            </BoxItem>
        </>
    );
}
