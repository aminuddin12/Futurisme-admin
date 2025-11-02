import FormField from '@/Components/FormField';
import TextInput from '@/Components/UI/TextInput';
import { Division, Insider, Position, Profile } from '@/types';
import { useForm } from '@inertiajs/react';
import { FormEventHandler } from 'react';

interface UpdateProfileFormProps {
    insider: Insider;
    profile: Profile;
    positions: Position[];
    divisions: Division[];
}

export default function UpdateProfileForm({
    insider = {} as Insider,
    profile = {} as Profile,
    positions = [],
    divisions = [],
}: UpdateProfileFormProps) {
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
        <section>
            <header>
                <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Profile Information
                </h2>
                <p className="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Update your account's profile information and email address.
                </p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <FormField label="First Name" error={errors.first_name}>
                    <TextInput
                        id="first_name"
                        type="text"
                        value={data.first_name}
                        onChange={(e) => setData('first_name', e.target.value)}
                    />
                </FormField>

                <FormField label="Last Name" error={errors.last_name}>
                    <TextInput
                        id="last_name"
                        type="text"
                        value={data.last_name}
                        onChange={(e) => setData('last_name', e.target.value)}
                    />
                </FormField>

                <FormField label="Email" error={errors.email}>
                    <TextInput
                        id="email"
                        type="email"
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                    />
                </FormField>

                <FormField label="Username" error={errors.username}>
                    <TextInput
                        id="username"
                        type="text"
                        value={data.username}
                        onChange={(e) => setData('username', e.target.value)}
                    />
                </FormField>

                <div>
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
                        onChange={(e) => setData('position_id', e.target.value)}
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

                <div>
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
                        onChange={(e) => setData('division_id', e.target.value)}
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

                <div className="flex items-center gap-4">
                    <button type="submit" disabled={processing}>
                        Save
                    </button>
                </div>
            </form>
        </section>
    );
}
