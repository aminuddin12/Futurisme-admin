import InputError from '@/Components/UI/InputError';
import InputLabel from '@/Components/UI/InputLabel';
import PrimaryButton from '@/Components/UI/PrimaryButton';
import TextInput from '@/Components/UI/TextInput';
import GInsiderLayout from '@/Layouts/G-InsiderLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import { ArrowLeft, AtSign } from 'lucide-react';
import { FormEventHandler } from 'react';

export default function ForgotPassword({ status }: { status?: string }) {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        post(route('insider.password.email'));
    };

    return (
        <GInsiderLayout
            type="form-with-image"
            imageSrc="https://images.unsplash.com/photo-1559526324-c1f275fbfa32?q=80&w=1974&auto=format&fit=crop&ixlib-rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            imageAlt="Ilustrasi Lupa Password"
        >
            <Head title="Forgot Password" />

            <h2 className="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">
                Forgot Password?
            </h2>
            <p className="mt-2 text-gray-600 dark:text-gray-300">
                No problem. Just enter your email and we'll send you a reset
                link.
            </p>

            {status && (
                <div className="mb-4 mt-6 text-sm font-medium text-green-600 dark:text-green-400">
                    {status}
                </div>
            )}

            <form onSubmit={submit} className="mt-8 space-y-6">
                {/* PERUBAHAN DI SINI: Email */}
                <div>
                    <InputLabel htmlFor="email" value="Email" />
                    <div className="mt-2 flex items-center space-x-2">
                        <TextInput
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className="mt-1 block w-full flex-1" // Dihapus pl-10
                            isFocused={true}
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

                <div className="!mt-8">
                    <PrimaryButton
                        className="w-full justify-center py-3"
                        disabled={processing}
                    >
                        Email Password Reset Link
                    </PrimaryButton>
                </div>
            </form>

            <p className="mt-8 text-center text-sm text-gray-600 dark:text-gray-300">
                <Link
                    href={route('insider.login')}
                    className="inline-flex items-center justify-center font-medium text-orange-600 hover:text-orange-500"
                >
                    <ArrowLeft className="mr-1 h-4 w-4" />
                    Back to Log In
                </Link>
            </p>
        </GInsiderLayout>
    );
}
