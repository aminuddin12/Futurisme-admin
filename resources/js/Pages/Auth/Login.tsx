// resources/js/Pages/Auth/Login.tsx
import Checkbox from '@/Components/UI/Checkbox';
import InputError from '@/Components/UI/InputError';
import InputLabel from '@/Components/UI/InputLabel';
import GuestLayout from '@/Layouts/GuestLayout';
import { Icon } from '@iconify/react';
import { Head, Link, useForm } from '@inertiajs/react';
import { Flex, Heading, Text } from '@radix-ui/themes';
import { FormEventHandler, useEffect } from 'react';

// Impor komponen UI kustom kita
import ButtonPrimary from '@/Components/UI/ButtonPrimary'; // Asumsi ini ada
import ButtonSecondary from '@/Components/UI/ButtonSecondary'; // Asumsi ini ada
import TextInput from '@/Components/UI/TextInput';

export default function Login({
    status,
    canResetPassword,
}: {
    status?: string;
    canResetPassword?: boolean;
}) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
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
        post(route('login'));
    };

    // Komponen Logo Fxology (agar tidak impor ApplicationLogo)
    const FxologyLogo = ({ className = '' }: { className?: string }) => (
        <Link href="/" className={`text-4xl font-bold text-white ${className}`}>
            Fx
            <span className="text-emerald-400">o</span>logy
        </Link>
    );

    return (
        <GuestLayout>
            <Head title="Sign in" />

            {/* Wrapper utama untuk 2 kolom */}
            <main className="flex min-h-screen items-center justify-center bg-white dark:bg-gray-900">
                <div className="w-full max-w-5xl overflow-hidden rounded-lg shadow-2xl md:grid md:grid-cols-2">
                    {/* Kolom Kiri (Gambar) */}
                    <div className="hidden bg-gray-900 p-12 md:flex md:flex-col md:justify-between">
                        <div>
                            <FxologyLogo />
                            <Heading
                                as="h1"
                                size="8"
                                className="mt-12 !font-bold text-white"
                            >
                                Sign in to your Account
                            </Heading>
                            <Text
                                as="p"
                                size="3"
                                className="mt-4 text-gray-400"
                            >
                                Welcome back! Please enter your details.
                            </Text>
                        </div>
                        {/* Tombol Social Media di Kiri Bawah */}
                        <Flex direction="column" gap="4">
                            <ButtonSecondary
                                size="3"
                                variant="surface"
                                className="!w-full !bg-white/10 !text-white hover:!bg-white/20"
                            >
                                <Icon icon="mdi:google" className="h-5 w-5" />
                                Sign in with Google
                            </ButtonSecondary>
                            <ButtonSecondary
                                size="3"
                                variant="surface"
                                className="!w-full !bg-white/10 !text-white hover:!bg-white/20"
                            >
                                <Icon icon="mdi:apple" className="h-5 w-5" />
                                Sign in with Apple
                            </ButtonSecondary>
                            <ButtonSecondary
                                size="3"
                                variant="surface"
                                className="!w-full !bg-white/10 !text-white hover:!bg-white/20"
                            >
                                <Icon icon="mdi:facebook" className="h-5 w-5" />
                                Sign in with Facebook
                            </ButtonSecondary>
                        </Flex>
                    </div>

                    {/* Kolom Kanan (Form) */}
                    <div className="flex flex-col justify-center bg-white p-8 dark:bg-gray-800 md:p-12">
                        <Heading
                            as="h2"
                            size="7"
                            className="!font-semibold text-gray-900 dark:text-white"
                        >
                            Sign in
                        </Heading>
                        <Text
                            as="p"
                            size="3"
                            className="mt-2 text-gray-500 dark:text-gray-400"
                        >
                            Welcome back! Please enter your details.
                        </Text>

                        {status && (
                            <div className="mb-4 text-sm font-medium text-green-600">
                                {status}
                            </div>
                        )}

                        <form onSubmit={submit} className="mt-8 space-y-6">
                            {/* Email */}
                            <div>
                                <InputLabel htmlFor="email">Email</InputLabel>
                                <TextInput
                                    id="email"
                                    type="email"
                                    name="email"
                                    value={data.email}
                                    className="mt-1 block w-full"
                                    autoComplete="username"
                                    isFocused={true}
                                    onChange={(e) =>
                                        setData('email', e.target.value)
                                    }
                                    required
                                    size="3"
                                />
                                <InputError
                                    message={errors.email}
                                    className="mt-2"
                                />
                            </div>

                            {/* Password */}
                            <div>
                                <InputLabel htmlFor="password">Password</InputLabel>
                                <TextInput
                                    id="password"
                                    type="password"
                                    name="password"
                                    value={data.password}
                                    className="mt-1 block w-full"
                                    autoComplete="current-password"
                                    onChange={(e) =>
                                        setData('password', e.target.value)
                                    }
                                    required
                                    size="3"
                                />
                                <InputError
                                    message={errors.password}
                                    className="mt-2"
                                />
                            </div>

                            {/* Remember Me & Forgot Password */}
                            <div className="flex items-center justify-between">
                                <label className="flex items-center">
                                    <Checkbox
                                        name="remember"
                                        checked={data.remember}
                                        onChange={(e) =>
                                            setData(
                                                'remember',
                                                e.target.checked,
                                            )
                                        }
                                    />
                                    <span className="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                        Remember for 30 days
                                    </span>
                                </label>
                                {canResetPassword && (
                                    <Link
                                        href={route('password.request')}
                                        className="text-sm font-medium text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300"
                                    >
                                        Forgot password
                                    </Link>
                                )}
                            </div>

                            {/* Tombol Aksi */}
                            <Flex direction="column" gap="4">
                                <ButtonPrimary
                                    size="3"
                                    className="!w-full !justify-center"
                                    disabled={processing}
                                    color="gray" // Sesuai gambar (dark button)
                                    highContrast
                                >
                                    Sign in
                                </ButtonPrimary>

                                <ButtonSecondary
                                    size="3"
                                    className="!w-full !justify-center"
                                    variant="outline"
                                    color="gray"
                                    disabled={processing}
                                >
                                    <Icon
                                        icon="mdi:google"
                                        className="h-5 w-5"
                                    />
                                    Sign in with Google
                                </ButtonSecondary>
                            </Flex>

                            {/* Link Sign up */}
                            <Text
                                as="p"
                                size="2"
                                className="mt-6 text-center text-gray-500 dark:text-gray-400"
                            >
                                Don't have an account?{' '}
                                <Link
                                    href={route('register')}
                                    className="font-medium text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300"
                                >
                                    Sign up
                                </Link>
                            </Text>
                        </form>
                    </div>
                </div>
            </main>
        </GuestLayout>
    );
}
