import InputError from '@/Components/UI/InputError';
import InputLabel from '@/Components/UI/InputLabel';
import PrimaryButton from '@/Components/UI/PrimaryButton';
import TextInput from '@/Components/UI/TextInput';
import GInsiderLayout from '@/Layouts/G-InsiderLayout';
import { Head, useForm } from '@inertiajs/react';
import { AtSign, Lock } from 'lucide-react';
import { FormEventHandler, useEffect } from 'react';

export default function ResetPassword({
    token,
    email,
}: {
    token: string;
    email: string;
}) {
    const { data, setData, post, processing, errors, reset } = useForm({
        token: token,
        email: email,
        password: '', // Ini adalah 'new-password'
        password_confirmation: '', // Ini adalah 'retype-password'
    });

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('insider.password.store'));
    };

    return (
        <GInsiderLayout
            type="form-with-image"
            imageSrc="https://images.unsplash.com/photo-1509822929063-6b6cfc9b42f2?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            imageAlt="Ilustrasi Reset Password"
        >
            <Head title="Reset Password" />

            <h2 className="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                Set Your New Password
            </h2>
            <p className="mt-2 text-gray-600 dark:text-gray-300">
                Enter your new password below. Make sure it's secure.
            </p>

            <form onSubmit={submit} className="mt-8 space-y-6">
                {/* PERUBAHAN DI SINI: Email (Read-only) */}
                <div>
                    <InputLabel htmlFor="email" value="Email" />
                    <div className="mt-2 flex items-center space-x-2">
                        <TextInput
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className="mt-1 block w-full flex-1 text-gray-500 dark:text-gray-400" // Dihapus pl-10
                            autoComplete="username"
                            onChange={(e) => setData('email', e.target.value)}
                            required
                            placeholder="Enter your email"
                            disabled // Email tidak boleh diubah
                        />
                        {/* Ikon dipindah ke sini (di luar input) */}
                        <span className="rounded-md bg-gray-100 p-2.5 text-gray-400 dark:bg-gray-700 dark:text-gray-300">
                            <AtSign className="h-5 w-5" aria-hidden="true" />
                        </span>
                    </div>
                    <InputError message={errors.email} className="mt-2" />
                </div>

                {/* PERUBAHAN DI SINI: New Password */}
                <div className="mt-4">
                    <InputLabel htmlFor="password" value="New Password" />
                    <div className="mt-2 flex items-center space-x-2">
                        <TextInput
                            id="password"
                            type="password"
                            name="password"
                            value={data.password}
                            className="mt-1 block w-full flex-1" // Dihapus pl-10
                            autoComplete="new-password"
                            isFocused={true}
                            onChange={(e) =>
                                setData('password', e.target.value)
                            }
                            required
                            placeholder="••••••••"
                        />
                        {/* Ikon dipindah ke sini (di luar input) */}
                        <span className="rounded-md bg-gray-100 p-2.5 text-gray-400 dark:bg-gray-700 dark:text-gray-300">
                            <Lock className="h-5 w-5" aria-hidden="true" />
                        </span>
                    </div>
                    <InputError message={errors.password} className="mt-2" />
                </div>

                {/* PERUBAHAN DI SINI: Retype New Password */}
                <div className="mt-4">
                    <InputLabel
                        htmlFor="password_confirmation"
                        value="Retype New Password"
                    />
                    <div className="mt-2 flex items-center space-x-2">
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            value={data.password_confirmation}
                            className="mt-1 block w-full flex-1" // Dihapus pl-10
                            autoComplete="new-password"
                            onChange={(e) =>
                                setData('password_confirmation', e.target.value)
                            }
                            required
                            placeholder="••••••••"
                        />
                        {/* Ikon dipindah ke sini (di luar input) */}
                        <span className="rounded-md bg-gray-100 p-2.5 text-gray-400 dark:bg-gray-700 dark:text-gray-300">
                            <Lock className="h-5 w-5" aria-hidden="true" />
                        </span>
                    </div>
                    <InputError
                        message={errors.password_confirmation}
                        className="mt-2"
                    />
                </div>

                <div className="!mt-8">
                    <PrimaryButton
                        className="w-full justify-center py-3"
                        disabled={processing}
                    >
                        Reset Password
                    </PrimaryButton>
                </div>
            </form>
        </GInsiderLayout>
    );
}
