import React from 'react';

interface MainProps {
    children: React.ReactNode;
}

export default function Main({ children }: MainProps) {
    return <div className="space-y-6">{children}</div>;
}
