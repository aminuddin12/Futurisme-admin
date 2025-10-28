import { Config } from 'ziggy-js';

export interface User {
    twitter_url: string;
    linkedin_url: string;
    postal_code: string;
    city: string;
    street: string;
    created_at(created_at: string): import('react').ReactNode;
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
    ziggy: Config & { location: string };
};
