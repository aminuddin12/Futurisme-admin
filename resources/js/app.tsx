import '../css/app.css';
import './bootstrap';

import '@radix-ui/themes/styles.css';

import { createInertiaApp } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createRoot, hydrateRoot } from 'react-dom/client';

import { Theme } from '@radix-ui/themes';

import { ThemeProvider, useTheme } from '@/Context/ThemeContext';
import { ReactNode } from 'react';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

function RadixThemeWrapper({ children }: { children: ReactNode }) {
    const { theme } = useTheme();

    // Map our "system" theme to Radix's accepted "inherit" value and narrow the type.
    const appearance =
        theme === 'system'
            ? 'inherit'
            : (theme as 'light' | 'dark' | 'inherit');
    return (
        <Theme
            // 3. Hubungkan state tema kita ke prop `appearance` Radix
            appearance={appearance}
            // Anda bisa tambahkan props Radix lainnya di sini
            // accentColor="blue"
            // grayColor="slate"
        >
            {children}
        </Theme>
    );
}

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.tsx`,
            import.meta.glob('./Pages/**/*.tsx'),
        ),
    setup({ el, App, props }) {
        if (import.meta.env.SSR) {
            hydrateRoot(el, <App {...props} />);
            return;
        }

        createRoot(el).render(
            <ThemeProvider storageKey="futurisme-theme">
                {/* 5. Gunakan Wrapper baru kita */}
                <RadixThemeWrapper>
                    <App {...props} />
                </RadixThemeWrapper>
            </ThemeProvider>,
        );
    },
    progress: {
        color: '#4B5563',
    },
});
