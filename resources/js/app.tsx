import '../css/app.css';
import '../css/style.css';
import './bootstrap';

import '@radix-ui/themes/styles.css';

import { addCollection } from '@iconify/react';
import { createInertiaApp } from '@inertiajs/react';
import { Theme } from '@radix-ui/themes';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ReactNode } from 'react';
import { createRoot, hydrateRoot } from 'react-dom/client';

import { BackgroundThemeProvider } from '@/Context/BackgroundThemeContext';
import { ThemeProvider, useTheme } from '@/Context/ThemeContext';

import iconBundle from './icon-bundle.json';

if (Array.isArray(iconBundle)) {
    iconBundle.forEach((bundle: any) => {
        addCollection(bundle);
    });
} else {
    addCollection(iconBundle as any);
}
// ---------------------------

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

function RadixThemeWrapper({ children }: { children: ReactNode }) {
    const { theme } = useTheme();

    const appearance =
        theme === 'system'
            ? 'inherit'
            : (theme as 'light' | 'dark' | 'inherit');
    return <Theme appearance={appearance}>{children}</Theme>;
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
                <BackgroundThemeProvider>
                    <RadixThemeWrapper>
                        <App {...props} />
                    </RadixThemeWrapper>
                </BackgroundThemeProvider>
            </ThemeProvider>,
        );
    },
    progress: {
        color: '#ff1d1dff',
    },
});
