import AdminLayout from '@/Layouts/AdminLayout';
import { FormField } from '@/components/FormField';
import { Division, Insider, PageProps, Position, Profile } from '@/types';
import { Head, useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

interface ProfileSettingsProps extends PageProps {
    insider: Insider;
    profile: Profile;
    positions: Position[];
    divisions: Division[];
}

export default function ProfileSettings({
    insider,
    profile,
    positions,
    divisions,
}: ProfileSettingsProps) {
    const { data, setData, put, processing, errors } = useForm({
        first_name: profile.first_name || '',
        last_name: profile.last_name || '',
        email: insider.email || '',
        username: insider.username || '',
        position_id: profile.position_id || '',
        division_id: profile.division_id || '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        put(route('admin.profile.settings.update'));
    };

    return (
        <AdminLayout>
            <Head title="Profile Settings" />

            <div className="mx-auto max-w-2xl p-4 sm:p-6 lg:p-8">
                <form onSubmit={submit}>
                    <FormField
                        label="First Name"
                        id="first_name"
                        type="text"
                        value={data.first_name}
                        onChange={(e) => setData('first_name', e.target.value)}
                        error={errors.first_name}
                    />

                    <FormField
                        label="Last Name"
                        id="last_name"
                        type="text"
                        value={data.last_name}
                        onChange={(e) => setData('last_name', e.target.value)}
                        error={errors.last_name}
                    />

                    <FormField
                        label="Email"
                        id="email"
                        type="email"
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                        error={errors.email}
                    />

                    <FormField
                        label="Username"
                        id="username"
                        type="text"
                        value={data.username}
                        onChange={(e) => setData('username', e.target.value)}
                        error={errors.username}
                    />

                    <div className="mt-4">
                        <label
                            htmlFor="position_id"
                            className="block text-sm font-medium text-gray-700"
                        >
                            Position
                        </label>
                        <select
                            id="position_id"
                            className="mt-1 block w-full"
                            value={data.position_id}
                            onChange={(e) =>
                                setData('position_id', e.target.value)
                            }
                        >
                            {positions.map((position) => (
                                <option key={position.id} value={position.id}>
                                    {position.position_name}
                                </option>
                            ))}
                        </select>
                        {errors.position_id && (
                            <p className="mt-2 text-sm text-red-600">
                                {errors.position_id}
                            </p>
                        )}
                    </div>

                    <div className="mt-4">
                        <label
                            htmlFor="division_id"
                            className="block text-sm font-medium text-gray-700"
                        >
                            Division
                        </label>
                        <select
                            id="division_id"
                            className="mt-1 block w-full"
                            value={data.division_id}
                            onChange={(e) =>
                                setData('division_id', e.target.value)
                            }
                        >
                            {divisions.map((division) => (
                                <option key={division.id} value={division.id}>
                                    {division.division_name}
                                </option>
                            ))}
                        </select>
                        {errors.division_id && (
                            <p className="mt-2 text-sm text-red-600">
                                {errors.division_id}
                            </p>
                        )}
                    </div>

                    <div className="mt-4 flex items-center justify-end">
                        <button
                            type="submit"
                            className="ms-4"
                            disabled={processing}
                        >
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </AdminLayout>
    );
}
