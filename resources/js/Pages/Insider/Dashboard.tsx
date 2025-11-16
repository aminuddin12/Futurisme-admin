import AdminLayout from '@/Layouts/AdminLayout';
import { cn } from '@/lib/utils';
import { Head, PageProps as InertiaPageProps, Link } from '@inertiajs/react';
import { Badge, Box, Card, Flex, Heading, Table } from '@radix-ui/themes';

// Tipe untuk data paginasi dari Laravel
interface PaginatedData<T> {
    data: T[];
    links: {
        url: string | null;
        label: string;
        active: boolean;
    }[];
    current_page: number;
    last_page: number;
    total: number;
}

// Tipe untuk Role dan Permission
interface Role {
    id: number;
    name: string;
    guard_name: string;
    created_at: string;
}

interface Permission {
    id: number;
    name: string;
    guard_name: string;
    created_at: string;
}

// Tipe untuk props halaman ini
interface DashboardPageProps extends InertiaPageProps {
    userRoles: string[];
    allRoles: PaginatedData<Role>;
    allPermissions: PaginatedData<Permission>;
}

// Komponen Paginasi
const Pagination = ({ links }: { links: PaginatedData<any>['links'] }) => (
    <Flex align="center" gap="2" mt="4">
        {links.map((link, index) => (
            <Link
                key={index}
                href={link.url || '#'}
                className={cn(
                    'rounded px-3 py-1.5 text-sm',
                    !link.url && 'cursor-not-allowed text-gray-400',
                    link.active
                        ? 'bg-emerald-500 text-white'
                        : 'bg-gray-200 text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600',
                )}
                dangerouslySetInnerHTML={{ __html: link.label }}
                preserveScroll
            />
        ))}
    </Flex>
);

export default function Dashboard({
    userRoles,
    allRoles,
    allPermissions,
}: DashboardPageProps) {
    return (
        <>
            <Head title="Dashboard" />
            <div className="space-y-6 p-4 md:p-6">
                {/* Info Role Pengguna */}
                <Card>
                    <Heading as="h2" size="4" mb="2">
                        Your Roles
                    </Heading>
                    <Flex gap="2" wrap="wrap">
                        {userRoles.map((role) => (
                            <Badge key={role} color="emerald" size="2">
                                {role}
                            </Badge>
                        ))}
                    </Flex>
                </Card>

                <Flex direction={{ initial: 'column', lg: 'row' }} gap="6">
                    {/* Tabel Semua Role */}
                    <Box className="flex-1">
                        <Heading as="h2" size="6" mb="4">
                            All System Roles ({allRoles.total})
                        </Heading>
                        <Table.Root variant="surface">
                            <Table.Header>
                                <Table.Row>
                                    <Table.ColumnHeaderCell>
                                        ID
                                    </Table.ColumnHeaderCell>
                                    <Table.ColumnHeaderCell>
                                        Name
                                    </Table.ColumnHeaderCell>
                                    <Table.ColumnHeaderCell>
                                        Guard
                                    </Table.ColumnHeaderCell>
                                </Table.Row>
                            </Table.Header>
                            <Table.Body>
                                {allRoles.data.map((role) => (
                                    <Table.Row key={role.id}>
                                        <Table.Cell>{role.id}</Table.Cell>
                                        <Table.Cell weight="bold">
                                            {role.name}
                                        </Table.Cell>
                                        <Table.Cell>
                                            {role.guard_name}
                                        </Table.Cell>
                                    </Table.Row>
                                ))}
                            </Table.Body>
                        </Table.Root>
                        <Pagination links={allRoles.links} />
                    </Box>

                    {/* Tabel Semua Permission */}
                    <Box className="flex-1">
                        <Heading as="h2" size="6" mb="4">
                            All System Permissions ({allPermissions.total})
                        </Heading>
                        <Table.Root variant="surface">
                            <Table.Header>
                                <Table.Row>
                                    <Table.ColumnHeaderCell>
                                        ID
                                    </Table.ColumnHeaderCell>
                                    <Table.ColumnHeaderCell>
                                        Name
                                    </Table.ColumnHeaderCell>
                                    <Table.ColumnHeaderCell>
                                        Guard
                                    </Table.ColumnHeaderCell>
                                </Table.Row>
                            </Table.Header>
                            <Table.Body>
                                {allPermissions.data.map((permission) => (
                                    <Table.Row key={permission.id}>
                                        <Table.Cell>{permission.id}</Table.Cell>
                                        <Table.Cell weight="bold">
                                            {permission.name}
                                        </Table.Cell>
                                        <Table.Cell>
                                            {permission.guard_name}
                                        </Table.Cell>
                                    </Table.Row>
                                ))}
                            </Table.Body>
                        </Table.Root>
                        <Pagination links={allPermissions.links} />
                    </Box>
                </Flex>
            </div>
        </>
    );
}

Dashboard.layout = (page: React.ReactNode) => <AdminLayout>{page}</AdminLayout>;
