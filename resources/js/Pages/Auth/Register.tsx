// resources/js/Pages/Auth/Register.tsx
import InputError from '@/Components/UI/InputError';
import InputLabel from '@/Components/UI/InputLabel';
import GuestLayout from '@/Layouts/GuestLayout';
import { Icon } from '@iconify/react';
import { Head, Link, useForm } from '@inertiajs/react';
import { Flex, Heading, Text } from '@radix-ui/themes';
import { FormEventHandler, useEffect } from 'react';

// Impor komponen UI kustom kita
import ButtonPrimary from '@/Components/UI/ButtonPrimary';
import ButtonSecondary from '@/Components/UI/ButtonSecondary';
import TextInput from '@/Components/UI/TextInput';

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
        post(route('register'));
    };

    // Komponen Logo Fxology
    const FxologyLogo = ({ className = '' }: { className?: string }) => (
        <Link href="/" className={`text-4xl font-bold text-white ${className}`}>
            Fx
            <span className="text-emerald-400">o</span>logy
        </Link>
    );

    return (
        <GuestLayout>
            <Head title="Sign up" />

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
                                Create your Account
                            </Heading>
                            <Text
                                as="p"
                                size="3"
                                className="mt-4 text-gray-400"
                            >
                                Get started by creating your account today.
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
                                Sign up with Google
                            </ButtonSecondary>
                            <ButtonSecondary
                                size="3"
                                variant="surface"
                                className="!w-full !bg-white/10 !text-white hover:!bg-white/20"
                            >
                                <Icon icon="mdi:apple" className="h-5 w-5" />
                                Sign up with Apple
                            </ButtonSecondary>
                            <ButtonSecondary
                                size="3"
                                variant="surface"
                                className="!w-full !bg-white/10 !text-white hover:!bg-white/20"
                            >
                                <Icon icon="mdi:facebook" className="h-5 w-5" />
                                Sign up with Facebook
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
                            Sign up
                        </Heading>
                        <Text
                            as="p"
                            size="3"
                            className="mt-2 text-gray-500 dark:text-gray-400"
                        >
                            Create an account to get started.
                        </Text>

                        <form onSubmit={submit} className="mt-8 space-y-6">
                            {/* Name */}
                            <div>
                                <InputLabel htmlFor="name" value="Name" />
                                <TextInput
                                    id="name"
                                    name="name"
                                    value={data.name}
                                    rootClassName="mt-1 block w-full"
                                    autoComplete="name"
                                    isFocused={true}
                                    onChange={(e) =>
                                        setData('name', e.target.value)
                                    }
                                    required
                                    size="3"
                                />
                                <InputError
                                    message={errors.name}
                                    className="mt-2"
                                />
                            </div>

                            {/* Email */}
                            <div>
                                <InputLabel htmlFor="email" value="Email" />
                                <TextInput
                                    id="email"
                                    type="email"
                                    name="email"
                                    value={data.email}
                                    rootClassName="mt-1 block w-full"
                                    autoComplete="username"
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
                                <InputLabel htmlFor="password">
                                    Password
                                </InputLabel>
                                <TextInput
                                    id="password"
                                    type="password"
                                    name="password"
                                    value={data.password}
                                    rootClassName="mt-1 block w-full"
                                    autoComplete="new-password"
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

                            {/* Confirm Password */}
                            <div>
                                <InputLabel htmlFor="password_confirmation">
                                    Confirm Password
                                </InputLabel>
                                <TextInput
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    value={data.password_confirmation}
                                    rootClassName="mt-1 block w-full"
                                    autoComplete="new-password"
                                    onChange={(e) =>
                                        setData(
                                            'password_confirmation',
                                            e.target.value,
                                        )
                                    }
                                    required
                                    size="3"
                                />
                                <InputError
                                    message={errors.password_confirmation}
                                    className="mt-2"
                                />
                            </div>

                            {/* Tombol Aksi */}
                            <Flex direction="column" gap="4" className="pt-2">
                                <ButtonPrimary
                                    size="3"
                                    className="!w-full !justify-center"
                                    disabled={processing}
                                    color="gray" // Sesuai gambar (dark button)
                                    highContrast
                                >
                                    Sign up
                                </ButtonPrimary>
                            </Flex>

                            {/* Link Sign in */}
                            <Text
                                as="p"
                                size="2"
                                className="mt-6 text-center text-gray-500 dark:text-gray-400"
                            >
                                Already have an account?{' '}
                                <Link
                                    href={route('login')}
                                    className="font-medium text-emerald-600 hover:text-emerald-500 dark:text-emerald-400 dark:hover:text-emerald-300"
                                >
                                    Sign in
                                </Link>
                            </Text>
                        </form>
                    </div>
                </div>
            </main>
        </GuestLayout>
    );
}
