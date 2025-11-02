import { createContext, ReactNode, useContext, useState } from 'react';

type BackgroundTheme = 'nebula' | 'aurora';

type BackgroundThemeProviderState = {
    backgroundTheme: BackgroundTheme;
    setBackgroundTheme: (theme: BackgroundTheme) => void;
};

const initialState: BackgroundThemeProviderState = {
    backgroundTheme: 'nebula',
    setTheme: () => null,
};

const BackgroundThemeProviderContext =
    createContext<BackgroundThemeProviderState>(initialState);

export function BackgroundThemeProvider({
    children,
    defaultTheme = 'nebula',
    storageKey = 'futurisme-background-theme',
}: {
    children: ReactNode;
    defaultTheme?: BackgroundTheme;
    storageKey?: string;
}) {
    const [backgroundTheme, setBackgroundTheme] = useState<BackgroundTheme>(
        () =>
            (localStorage.getItem(storageKey) as BackgroundTheme) ||
            defaultTheme,
    );

    const value = {
        backgroundTheme,
        setBackgroundTheme: (theme: BackgroundTheme) => {
            localStorage.setItem(storageKey, theme);
            setBackgroundTheme(theme);
        },
    };

    return (
        <BackgroundThemeProviderContext.Provider value={value}>
            {children}
        </BackgroundThemeProviderContext.Provider>
    );
}

export const useBackgroundTheme = () => {
    const context = useContext(BackgroundThemeProviderContext);
    if (context === undefined) {
        throw new Error(
            'useBackgroundTheme must be used within a BackgroundThemeProvider',
        );
    }
    return context;
};
