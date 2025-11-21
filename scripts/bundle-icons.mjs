import fs from 'fs/promises';
import path from 'path';

/**
 * Script untuk mem-bundel ikon dari Seeder Laravel ke dalam file JSON.
 * Menggunakan API Iconify (api.iconify.design) via native fetch.
 */

// Path konfigurasi
const seederPath = path.resolve(
    process.cwd(),
    'database/seeders/SidebarMenuSeeder.php',
);
const outputPath = path.resolve(process.cwd(), 'resources/js/icon-bundle.json');

async function getIconNamesFromSeeder(filePath) {
    try {
        const content = await fs.readFile(filePath, 'utf-8');
        // Regex menangkap 'icon' => 'nama:icon' atau 'icon_filled' => 'nama:icon'
        const iconRegex = /'icon(?:_filled)?'\s*=>\s*'([^']+)'/g;
        const matches = content.matchAll(iconRegex);

        const iconNames = new Set();
        for (const match of matches) {
            iconNames.add(match[1]);
        }
        return Array.from(iconNames);
    } catch (error) {
        console.error(`Error reading seeder file: ${error.message}`);
        return [];
    }
}

async function bundleIcons() {
    console.log('🔍  Scanning icons from SidebarMenuSeeder...');

    const iconNames = await getIconNamesFromSeeder(seederPath);

    if (iconNames.length === 0) {
        console.log('⚠️  No icons found in the seeder file.');
        return;
    }

    console.log(
        `📦  Found ${iconNames.length} unique icons. Grouping by prefix...`,
    );

    // 1. Kelompokkan ikon berdasarkan prefix (contoh: 'tabler', 'mdi')
    const iconsByPrefix = {};
    iconNames.forEach((name) => {
        const parts = name.split(':');
        if (parts.length !== 2) return;
        const [prefix, icon] = parts;

        if (!iconsByPrefix[prefix]) {
            iconsByPrefix[prefix] = [];
        }
        iconsByPrefix[prefix].push(icon);
    });

    const bundles = [];

    // 2. Fetch data untuk setiap prefix
    for (const [prefix, icons] of Object.entries(iconsByPrefix)) {
        console.log(
            `⬇️   Fetching ${icons.length} icons for prefix: [${prefix}]...`,
        );

        try {
            // Iconify API mendukung pengambilan partial set dengan parameter ?icons=a,b,c
            const response = await fetch(
                `https://api.iconify.design/${prefix}.json?icons=${icons.join(',')}`,
            );

            if (!response.ok) {
                throw new Error(
                    `Failed to fetch ${prefix}: ${response.statusText}`,
                );
            }

            const data = await response.json();
            bundles.push(data);
        } catch (error) {
            console.error(
                `❌  Error fetching icons for ${prefix}:`,
                error.message,
            );
        }
    }

    // 3. Simpan hasil ke file JSON (sebagai Array of IconifyJSON)
    if (bundles.length > 0) {
        await fs.writeFile(
            outputPath,
            JSON.stringify(bundles, null, 2),
            'utf-8',
        );
        console.log(`✅  Successfully bundled icons to: ${outputPath}`);
    } else {
        console.log('⚠️  No icons were bundled.');
    }
}

bundleIcons();
