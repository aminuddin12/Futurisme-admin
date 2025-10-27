// resources/js/Context/ThemeContext.tsx

import {
    createContext,
    ReactNode,
    useContext,
    useEffect,
    useState,
} from 'react';

// Tipe untuk tema
type Theme = 'light' | 'dark' | 'system';
// Tipe untuk state provider
type ThemeProviderState = {
    theme: Theme;
    setTheme: (theme: Theme) => void;
};

const initialState: ThemeProviderState = {
    theme: 'system',
    setTheme: () => null,
};

// 1. Buat Context
const ThemeProviderContext = createContext<ThemeProviderState>(initialState);

// 2. Buat Provider Component
export function ThemeProvider({
    children,
    defaultTheme = 'system',
    storageKey = 'vite-ui-theme',
}: {
    children: ReactNode;
    defaultTheme?: Theme;
    storageKey?: string;
}) {
    const [theme, setTheme] = useState<Theme>(
        () => (localStorage.getItem(storageKey) as Theme) || defaultTheme,
    );

    useEffect(() => {
        const root = window.document.documentElement;
        root.classList.remove('light', 'dark');

        if (theme === 'system') {
            // Cek tema sistem operasi
            const systemTheme = window.matchMedia(
                '(prefers-color-scheme: dark)',
            ).matches
                ? 'dark'
                : 'light';

            root.classList.add(systemTheme);
            return;
        }

        // Terapkan tema (light atau dark) ke <html>
        root.classList.add(theme);
    }, [theme]);

    const value = {
        theme,
        setTheme: (newTheme: Theme) => {
            // Simpan pilihan ke localStorage
            localStorage.setItem(storageKey, newTheme);
            setTheme(newTheme);
        },
    };

    return (
        <ThemeProviderContext.Provider value={value}>
            {children}
        </ThemeProviderContext.Provider>
    );
}

// 3. Buat hook kustom untuk menggunakan context
export const useTheme = () => {
    const context = useContext(ThemeProviderContext);
    if (context === undefined) {
        throw new Error('useTheme must be used within a ThemeProvider');
    }
    return context;
};
