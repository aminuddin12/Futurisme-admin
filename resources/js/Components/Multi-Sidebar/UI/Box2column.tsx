// resources/js/Components/Profile/UI/Box2column.tsx
import { cn } from '@/lib/utils';
import { Grid } from '@radix-ui/themes';
import React from 'react';

interface Box2columnProps {
    children: React.ReactNode;
    className?: string;
}

// Komponen grid sederhana 2 kolom responsif
export default function Box2column({ children, className }: Box2columnProps) {
    return (
        <Grid
            columns={{ initial: '1', sm: '2' }}
            gap="4"
            width="auto"
            className={cn(className)}
        >
            {children}
        </Grid>
    );
}
