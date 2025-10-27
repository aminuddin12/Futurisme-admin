// resources/js/Components/Landing-Page/LandingHeader.tsx

import { Icon } from '@iconify/react';
import { Link } from '@inertiajs/react';
import { Button } from '@radix-ui/themes';

import ThemeSwitcher from '@/Components/ThemeSwitcher';

export default function LandingHeader() {
    const navItems = [
        { name: 'Home', href: '#', active: true },
        { name: 'How It Works', href: '#', active: false },
        { name: 'Programs', href: '#', active: false },
        { name: 'Support', href: '#', active: false },
        { name: 'Careers', href: '#', active: false },
        { name: 'Become a Partner', href: '#', active: false },
    ];

    return (
        <header className="absolute left-0 top-0 z-50 w-full p-4">
            <nav className="mx-auto flex max-w-7xl items-center justify-between p-2">
                {/* Kiri: Logo & Nav Links */}
                <div className="flex items-center gap-8">
                    <Link
                        href="/"
                        // 2. Modifikasi text color
                        className="text-2xl font-bold text-black dark:text-white"
                    >
                        Fx
                        <span className="text-emerald-400">o</span>logy
                    </Link>
                    <div
                        // 3. Modifikasi background & nav links
                        className="hidden items-center gap-1 rounded-full bg-gray-200/50 p-1 backdrop-blur-sm lg:flex dark:bg-gray-800/50"
                    >
                        {navItems.map((item) => (
                            <Link
                                key={item.name}
                                href={item.href}
                                className={`rounded-full px-4 py-1.5 text-sm transition-colors ${
                                    item.active
                                        ? 'bg-emerald-600/30 text-emerald-900 dark:text-white' // modifikasi active
                                        : 'text-gray-700 hover:text-black dark:text-gray-300 dark:hover:text-white' // modifikasi inactive
                                } `}
                            >
                                {item.name}
                            </Link>
                        ))}
                    </div>
                </div>

                {/* Kanan: Actions */}
                <div className="flex items-center gap-4">
                    <Link
                        href={route('login')}
                        // 4. Modifikasi text color
                        className="hidden text-sm text-gray-700 hover:text-black lg:block dark:text-gray-300 dark:hover:text-white"
                    >
                        Login / Register
                    </Link>
                    <Button
                        variant="ghost"
                        color="gray"
                        className="hidden lg:flex"
                    >
                        <Icon icon="ph:globe" />
                        <span className="text-sm">English</span>
                        <Icon icon="ph:caret-down" />
                    </Button>

                    {/* 5. Tambahkan ThemeSwitcher di sini */}
                    <ThemeSwitcher />

                    <Button
                        highContrast
                        className="hidden !bg-black !text-white sm:flex dark:!bg-white dark:!text-black" // Modifikasi tombol
                    >
                        Start a challenge
                        <Icon icon="heroicons:arrow-right-solid" />
                    </Button>
                    <Button variant="outline" color="gray" className="text-sm">
                        Free trial
                    </Button>
                </div>
            </nav>
        </header>
    );
}
