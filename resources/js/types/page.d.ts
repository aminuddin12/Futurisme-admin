import { Division, Insider, Position, Profile } from './';
import { User } from './user';

// Definisikan tipe dasar untuk props yang selalu ada dari Inertia/Laravel
export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    pageTitle?: string;
    ziggy: {
        location: string;
        port: number | null;
        query: Record<string, string>;
        url: string;
    };
};

// Definisikan tipe spesifik untuk halaman WebSettings
export interface WebSettingsProps extends PageProps {
    menuGroups: {
        title: string;
        items: {
            key: string;
            label: string;
            icon: string;
        }[];
    }[];
    settings: {
        site_logo?: { path: string; display_name: string };
        sitename?: { value: string; display_name: string };
        site_url?: { url: string; display_name: string };
        site_locale?: {
            code: string;
            options: string[];
            display_name: string;
        };
        site_timezone?: { zone: string; display_name: string };
        site_status?: {
            status: 'live' | 'maintenance';
            options: string[];
            display_name: string;
        };
    };
}

// Definisikan tipe spesifik untuk halaman ProfileSettings
export interface ProfileSettingsProps extends PageProps {
    insider: Insider;
    profile: Profile;
    positions: Position[];
    divisions: Division[];
}
