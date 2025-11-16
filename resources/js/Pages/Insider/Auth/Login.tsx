import Checkbox from '@/Components/UI/Checkbox';
import InputError from '@/Components/UI/InputError';
import InputLabel from '@/Components/UI/InputLabel';
import PrimaryButton from '@/Components/UI/PrimaryButton';
import SecondaryButton from '@/Components/UI/SecondaryButton';
import TextInput from '@/Components/UI/TextInput';
import GInsiderLayout from '@/Layouts/G-InsiderLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { AtSign, Lock, LogIn } from 'lucide-react'; // Menggunakan lucide-react untuk ikon
import React, { FormEventHandler, useEffect } from 'react';

// Definisikan ikon Apple (SVG sederhana)
const AppleIcon = (props: React.SVGProps<SVGSVGElement>) => (
    <svg
        xmlns="http://www.w3.org/2000/svg"
        width="20"
        height="20"
        viewBox="0 0 24 24"
        fill="currentColor"
        {...props}
    >
        <path d="M17.433 16.636C17.41 16.64 16.7 16.89 16.085 16.89C15.47 16.89 15.018 16.669 14.364 16.669C13.71 16.669 13.197 16.89 12.64 16.89C12.083 16.89 11.608 16.648 11.03 16.648C10.452 16.648 9.922 16.89 9.38 16.89C8.784 16.89 8.169 16.618 7.581 16.618C6.398 16.618 5.41 17.119 4.706 17.823C3.654 18.88 3.12 20.218 3.12 21.697C3.12 21.75 3.12 21.804 3.12 21.857C3.12 21.911 3.12 21.964 3.12 22C3.805 22.011 4.316 21.986 4.904 21.986C5.568 21.986 6.136 21.796 6.78 21.796C7.424 21.796 7.916 22.011 8.57 22.011C9.224 22.011 9.874 21.774 10.452 21.774C11.03 21.774 11.511 22.011 12.18 22.011C12.849 22.011 13.379 21.796 14.022 21.796C14.666 21.796 15.212 21.986 15.79 21.986C16.368 21.986 16.925 22.011 17.61 22C17.61 21.986 17.61 21.943 17.61 21.9C17.61 20.35 17.062 18.98 16.037 17.91C15.31 17.16 14.34 16.669 13.335 16.669C12.788 16.669 12.28 16.86 11.83 16.86C11.38 16.86 11.03 16.618 10.376 16.618C9.721 16.618 9.09 16.89 8.512 16.89C7.933 16.89 7.424 16.669 6.88 16.669C6.336 16.669 5.861 16.89 5.314 16.89C4.767 16.89 4.237 16.648 3.659 16.648C3.081 16.648 2.502 16.89 1.946 16.89C1.389 16.89 0.832 16.648 0.275 16.648C0.24 16.643 0.206 16.636 0.17 16.636C0.132 16.623 0.088 16.589 0.05 16.544C-0.038 16.425 -0.004 16.234 0.121 16.07C0.458 15.54 0.949 14.836 1.348 14.289C1.86 13.562 2.372 12.835 2.724 12.23C3.518 10.841 3.917 9.53 3.917 8.169C3.917 6.47 3.057 5.093 1.768 4.148C1.706 4.103 1.66 4.048 1.642 3.982C1.625 3.917 1.625 3.84 1.642 3.775C1.66 3.709 1.706 3.655 1.768 3.61C1.83 3.565 1.907 3.543 1.984 3.543C2.061 3.543 2.126 3.554 2.17 3.576C2.215 3.599 2.26 3.632 2.298 3.677C3.333 4.86 4.028 6.362 4.028 8.019C4.028 9.286 3.677 10.434 2.982 11.511C2.937 11.577 2.893 11.642 2.858 11.719C2.822 11.796 2.787 11.873 2.752 11.95C2.627 12.23 2.447 12.59 2.226 12.961C1.946 13.436 1.642 13.927 1.372 14.397C1.354 14.42 1.336 14.43 1.325 14.441C1.314 14.452 1.303 14.463 1.291 14.474C1.28 14.485 1.28 14.496 1.28 14.496C1.28 14.496 1.28 14.507 1.28 14.507C1.415 14.507 2.011 14.496 2.626 14.496C3.241 14.496 3.785 14.733 4.382 14.733C4.978 14.733 5.49 14.496 6.068 14.496C6.647 14.496 7.156 14.733 7.734 14.733C8.313 14.733 8.943 14.496 9.574 14.496C10.204 14.496 10.748 14.733 11.326 14.733C11.905 14.733 12.427 14.496 13.006 14.496C1s0.596 0.237 1.23 0.237C14.864 14.733 15.341 14.496 15.937 14.496C16.533 14.496 17.112 14.733 17.727 14.733C18.342 14.733 18.843 14.496 19.46 14.496C20.075 14.496 20.536 14.733 21.058 14.733C21.492 14.733 21.84 14.656 22.152 14.474C22.215 14.43 22.28 14.375 22.336 14.309C22.391 14.243 22.42 14.166 22.42 14.078C22.42 13.98 22.391 13.893 22.336 13.827C22.28 13.761 22.215 13.707 22.138 13.662C21.826 13.48 21.468 13.403 21.058 13.403C20.536 13.403 20.075 13.64 19.46 13.64C18.843 13.64 18.342 13.403 17.727 13.403C17.112 13.403 16.533 13.64 15.937 13.64C15.341 13.64 14.864 13.403 14.233 13.403C13.603 13.403 13.006 13.64 12.427 13.64C11.849 13.64 11.326 13.403 10.748 13.403C10.17 13.403 9.64 13.64 9.006 13.64C8.375 13.64 7.788 13.403 7.156 13.403C6.526 13.403 5.996 13.64 5.365 13.64C4.735 13.64 4.223 13.403 3.65 13.403C3.072 13.403 2.525 13.64 1.981 13.64C1.884 13.64 1.787 13.63 1.701 13.607C1.614 13.585 1.538 13.552 1.472 13.507C1.406 13.462 1.348 13.403 1.303 13.332C1.258 13.26 1.225 13.184 1.202 13.096C1.179 13.008 1.168 12.91 1.168 12.802C1.168 12.018 1.424 11.354 1.884 10.853C2.458 10.22 3.161 9.878 3.917 9.878C4.735 9.878 5.449 10.282 6.006 10.999C6.6 11.75 6.942 12.63 6.904 13.651C6.866 14.637 6.082 15.54 5.093 16.092C5.068 16.103 5.045 16.114 5.023 16.125C5.001 16.136 4.989 16.147 4.978 16.147C4.966 16.147 4.955 16.147 4.955 16.147C4.943 16.147 4.943 16.147 4.943 16.147C5.49 16.147 6.02 16.378 6.563 16.378C7.107 16.378 7.609 16.147 8.169 16.147C8.729 16.147 9.27 16.378 9.874 16.378C10.479 16.378 11.133 16.147 11.764 16.147C12.394 16.147 12.916 16.378 13.521 16.378C14.126 16.378 14.656 16.147 15.212 16.147C15.768 16.147 16.298 16.378 16.89 16.378C17.062 16.378 17.234 16.367 17.433 16.636Z" />
        <path d="M12.64 5.861C12.877 5.077 13.068 4.257 13.237 3.414C13.254 3.326 13.28 3.249 13.315 3.183C13.349 3.117 13.394 3.063 13.449 3.018C13.504 2.973 13.57 2.939 13.647 2.917C13.724 2.895 13.801 2.884 13.878 2.884C13.955 2.884 14.032 2.895 14.109 2.917C14.186 2.939 14.251 2.973 14.306 3.018C14.361 3.063 14.406 3.117 14.441 3.183C14.475 3.249 14.501 3.326 14.518 3.414C14.687 4.257 14.878 5.077 15.115 5.861C15.126 5.861 15.137 5.861 15.148 5.861C15.16 5.861 15.171 5.861 15.171 5.861C15.652 4.237 16.39 2.838 17.433 1.779C17.495 1.724 17.561 1.68 17.627 1.647C17.692 1.614 17.769 1.591 17.846 1.591C17.923 1.591 18 1.602 18.077 1.625C18.154 1.647 18.219 1.68 18.275 1.724C18.33 1.769 18.375 1.823 18.408 1.889C18.442 1.954 18.464 2.031 18.464 2.119C18.464 2.216 18.442 2.313 18.397 2.41C18.352 2.507 18.287 2.604 18.209 2.712C17.166 4.09 16.48 5.568 16.48 7.156C16.48 8.91 17.207 10.434 18.408 11.511C18.47 11.566 18.525 11.62 18.568 11.686C18.613 11.752 18.636 11.829 18.636 11.916C18.636 12.004 18.613 12.081 18.568 12.147C18.525 12.212 18.47 12.267 18.408 12.312C18.347 12.357 18.275 12.39 18.209 12.413C18.143 12.435 18.066 12.446 17.989 12.446C17.912 12.446 17.835 12.435 17.769 12.413C17.703 12.39 17.638 12.357 17.583 12.312C17.528 12.267 17.483 12.212 17.449 12.147C17.415 12.081 17.393 12.004 17.393 11.916C17.393 11.829 17.415 11.752 17.449 11.686C16.528 10.748 16.037 9.541 16.037 8.169C16.037 6.84 15.546 5.719 14.722 4.882C14.656 4.816 14.591 4.761 14.529 4.717C14.468 4.672 14.397 4.639 14.319 4.616C14.242 4.593 14.155 4.582 14.058 4.582C13.961 4.582 13.874 4.593 13.797 4.616C13.719 4.639 13.647 4.672 13.582 4.717C13.516 4.761 13.451 4.816 13.385 4.882C12.561 5.719 12.07 6.84 12.07 8.169C12.07 9.541 11.579 10.748 10.658 11.686C10.623 11.752 10.601 11.829 10.601 11.916C10.601 12.004 10.623 12.081 10.658 12.147C10.702 12.212 10.757 12.267 10.812 12.312C10.867 12.357 10.933 12.39 11.009 12.413C11.086 12.435 11.163 12.446 11.24 12.446C11.317 12.446 11.394 12.435 11.471 12.413C11.548 12.39 11.614 12.357 11.669 12.312C11.724 12.267 11.769 12.212 11.803 12.147C11.837 12.081 11.859 12.004 11.859 11.916C11.859 11.829 11.837 11.752 11.803 11.686C12.724 10.434 13.158 8.91 13.158 7.156C13.158 5.568 12.877 4.09 11.835 2.712C11.757 2.604 11.691 2.507 11.647 2.41C11.602 2.313 11.58 2.216 11.58 2.119C11.58 2.031 11.602 1.954 11.636 1.889C11.67 1.823 11.715 1.769 11.77 1.724C11.825 1.68 11.891 1.647 11.968 1.625C12.045 1.602 12.122 1.591 12.199 1.591C12.276 1.591 12.353 1.602 12.43 1.625C12.507 1.647 12.572 1.68 12.628 1.724C13.67 2.838 14.408 4.237 14.889 5.861C14.889 5.861 14.9 5.861 14.9 5.861C14.911 5.861 14.922 5.861 14.922 5.861C14.685 5.077 14.494 4.257 14.325 3.414C14.308 3.326 14.282 3.249 14.248 3.183C14.214 3.117 14.169 3.063 14.114 3.018C14.059 2.973 13.993 2.939 13.916 2.917C13.839 2.895 13.762 2.884 13.685 2.884C13.608 2.884 13.531 2.895 13.454 2.917C13.377 2.939 13.311 2.973 13.256 3.018C13.201 3.063 13.156 3.117 13.122 3.183C13.088 3.249 13.062 3.326 13.045 3.414C12.876 4.257 12.685 5.077 12.448 5.861H12.64Z" />
    </svg>
);

export default function Login({ status }: { status?: string }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        credential: '', // DIUBAH DARI 'email'
        password: '',
        remember: false,
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        // Gunakan route 'insider.login' yang ada di routes/Insider/auth.php
        post(route('insider.login'));
    };

    return (
        <GInsiderLayout
            type="form-with-image"
            imageSrc="https://images.unsplash.com/photo-1529539795054-3c162a4afc7e?q=80&w=1974&auto=format=fitcrop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            imageAlt="Ilustrasi login futuristik"
        >
            <Head title="Insider Log In" />

            {status && (
                <div className="mb-4 text-sm font-medium text-green-600">
                    {status}
                </div>
            )}

            <h2 className="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                Welcome back Insider 👋
            </h2>
            <p className="mt-2 text-gray-600 dark:text-gray-300">
                Please enter your details to sign in.
            </p>

            {/* Tombol Socialite (Contoh Apple) */}
            <div className="my-6">
                <SecondaryButton className="w-full justify-center">
                    <AppleIcon className="mr-2" />
                    Log In with Apple
                </SecondaryButton>
            </div>

            {/* Pemisah "OR" */}
            <div className="relative my-6">
                <div
                    className="absolute inset-0 flex items-center"
                    aria-hidden="true"
                >
                    <div className="w-full border-t border-gray-300 dark:border-gray-600" />
                </div>
                <div className="relative flex justify-center">
                    <span className="bg-white px-2 text-sm text-gray-500 dark:bg-gray-800 dark:text-gray-400">
                        or
                    </span>
                </div>
            </div>

            {/* Form Login Utama */}
            <form onSubmit={submit} className="space-y-6">
                {/* PERUBAHAN DI SINI: Credential */}
                <div>
                    <InputLabel htmlFor="credential" value="Credential" />
                    <div className="mt-2 flex items-center space-x-2">
                        <TextInput
                            id="credential"
                            type="text"
                            name="credential"
                            value={data.credential}
                            className="mt-1 block w-full flex-1" // Dihapus pl-10
                            autoComplete="username"
                            isFocused={true}
                            onChange={(e) =>
                                setData('credential', e.target.value)
                            }
                            required
                            placeholder="Enter your email or username"
                        />
                        {/* Ikon dipindah ke sini (di luar input) */}
                        <span className="rounded-md bg-gray-100 p-2.5 text-gray-400 dark:bg-gray-700 dark:text-gray-300">
                            <AtSign className="h-5 w-5" aria-hidden="true" />
                        </span>
                    </div>
                    <InputError message={errors.credential} className="mt-2" />
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
                            autoComplete="current-password"
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

                {/* Remember Me & Forgot Password */}
                <div className="flex items-center justify-between">
                    <label className="flex items-center">
                        <Checkbox
                            name="remember"
                            checked={data.remember}
                            onChange={(e) =>
                                setData('remember', e.target.checked)
                            }
                        />
                        <span className="ml-2 text-sm text-gray-600 dark:text-gray-300">
                            Remember for 30 days
                        </span>
                    </label>

                    <Link
                        href={route('insider.password.request')} // Sesuaikan dengan route Anda
                        className="text-sm font-medium text-orange-600 hover:text-orange-500"
                    >
                        Forgot password?
                    </Link>
                </div>

                {/* Tombol Submit */}
                <div className="!mt-8">
                    <PrimaryButton
                        className="w-full justify-center py-3"
                        disabled={processing}
                    >
                        <LogIn className="mr-2 h-5 w-5" />
                        Log In
                    </PrimaryButton>
                </div>
            </form>

            {/* Link ke Register */}
            <p className="mt-8 text-center text-sm text-gray-600 dark:text-gray-300">
                Don't have an account?{' '}
                <Link
                    href={route('insider.register')} // Sesuaikan dengan route Anda
                    className="font-medium text-orange-600 hover:text-orange-500"
                >
                    Sign Up
                </Link>
            </p>
        </GInsiderLayout>
    );
}
