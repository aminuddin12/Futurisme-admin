import { useEffect, useState } from 'react';

interface ClientOnlyDateProps {
    dateString: string | undefined;
    options: Intl.DateTimeFormatOptions;
    placeholder?: string;
}

/**
 * A component that formats and renders a date only on the client-side
 * to prevent server-client hydration mismatch due to timezones.
 */
export default function ClientOnlyDate({
    dateString,
    options,
    placeholder = '...',
}: ClientOnlyDateProps) {
    const [formattedDate, setFormattedDate] = useState<string | null>(null);

    useEffect(() => {
        setFormattedDate(
            dateString
                ? new Date(dateString).toLocaleDateString('en-US', options)
                : 'Not available',
        );
    }, [dateString, options]);

    return <>{formattedDate === null ? placeholder : formattedDate}</>;
}
