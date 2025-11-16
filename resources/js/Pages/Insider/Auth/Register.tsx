import InputError from '@/Components/UI/InputError';
import InputLabel from '@/Components/UI/InputLabel';
import PrimaryButton from '@/Components/UI/PrimaryButton';
import TextInput from '@/Components/UI/TextInput';
import GInsiderLayout from '@/Layouts/G-InsiderLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { AtSign, Lock, LogIn, User } from 'lucide-react';
import { FormEventHandler, useEffect } from 'react';

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('insider.register'));
    };

    return (
        <GInsiderLayout
            type="form-with-image"
            imageSrc="https://images.unsplash.com/photo-1550745165-9bc0b252726f?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            imageAlt="Ilustrasi pendaftaran"
        >
            <Head title="Insider Sign Up" />

            <h2 className="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                Create your Insider Account
            </h2>
            <p className="mt-2 text-gray-600 dark:text-gray-300">
                Join the team. Please enter your details.
            </p>

            <form onSubmit={submit} className="mt-8 space-y-6">
                {/* PERUBAHAN DI SINI: Name */}
                <div>
                    <InputLabel htmlFor="name" value="Name" />
                    <div className="mt-2 flex items-center space-x-2">
                        <TextInput
                            id="name"
                            name="name"
                            value={data.name}
                            className="mt-1 block w-full flex-1" // Dihapus pl-10
                            autoComplete="name"
                            isFocused={true}
                            onChange={(e) => setData('name', e.target.value)}
                            required
                            placeholder="Enter your full name"
                        />
                        {/* Ikon dipindah ke sini (di luar input) */}
                        <span className="rounded-md bg-gray-100 p-2.5 text-gray-400 dark:bg-gray-700 dark:text-gray-300">
                            <User className="h-5 w-5" aria-hidden="true" />
                        </span>
                    </div>
                    <InputError message={errors.name} className="mt-2" />
                </div>

                {/* PERUBAHAN DI SINI: Email */}
                <div className="mt-4">
                    <InputLabel htmlFor="email" value="Email" />
                    <div className="mt-2 flex items-center space-x-2">
                        <TextInput
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className="mt-1 block w-full flex-1" // Dihapus pl-10
                            autoComplete="username"
                            onChange={(e) => setData('email', e.target.value)}
                            required
                            placeholder="Enter your email"
                        />
                        {/* Ikon dipindah ke sini (di luar input) */}
                        <span className="rounded-md bg-gray-100 p-2.5 text-gray-400 dark:bg-gray-700 dark:text-gray-300">
                            <AtSign className="h-5 w-5" aria-hidden="true" />
                        </span>
                    </div>
                    <InputError message={errors.email} className="mt-2" />
                </div>

                {/* PERUBAHAN DI SINI: Password */}
                <div className="mt-4">
                    <InputLabel htmlFor="password" value="Password" />
                    <div className="mt-2 flex items-center space-x-2">
                        <TextInput
                            id="password"
                            type="password"
                            name="password"
                            value={data.password}
                            className="mt-1 block w-full flex-1" // Dihapus pl-10
                            autoComplete="new-password"
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

                {/* PERUBAHAN DI SINI: Confirm Password */}
                <div className="mt-4">
                    <InputLabel
                        htmlFor="password_confirmation"
                        value="Confirm Password"
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

                {/* Tombol Submit */}
                <div className="!mt-8">
                    <PrimaryButton
                        className="w-full justify-center py-3"
                        disabled={processing}
                    >
                        <LogIn className="mr-2 h-5 w-5" />
                        Sign Up
                    </PrimaryButton>
                </div>
            </form>

            {/* Link ke Login */}
            <p className="mt-8 text-center text-sm text-gray-600 dark:text-gray-300">
                Already have an account?{' '}
                <Link
                    href={route('insider.login')}
                    className="font-medium text-orange-600 hover:text-orange-500"
                >
                    Log In
                </Link>
            </p>
        </GInsiderLayout>
    );
}
