import fs from 'fs/promises';
import path from 'path';
import { getIcons, stringifyJSON } from '@iconify/tools';

// Fungsi untuk mengekstrak nama ikon dari file PHP
async function getIconNamesFromSeeder(filePath) {
    try {
        const content = await fs.readFile(filePath, 'utf-8');
        const iconRegex = /'icon(?:_filled)?'\s*=>\s*'([^']+)'/g;
        const matches = content.matchAll(iconRegex);
        const iconNames = new Set();
        for (const match of matches) {
            iconNames.add(match[1]);
        }
        return Array.from(iconNames);
    } catch (error) {
        console.error(`Error reading or parsing seeder file: ${error.message}`);
        return [];
    }
}

// Fungsi utama untuk membundel ikon
async function bundleIcons() {
    console.log('Starting icon bundling process...');

    const seederPath = path.resolve(process.cwd(), '../database/seeders/SidebarMenuSeeder.php');
    const outputPath = path.resolve(process.cwd(), 'resources/js/icon-bundle.json');

    const iconNames = await getIconNamesFromSeeder(seederPath);

    if (iconNames.length === 0) {
        console.log('No icons found in the seeder file. Exiting.');
        return;
    }

    console.log(`Found ${iconNames.length} unique icons to bundle.`);

    // Mengelompokkan ikon berdasarkan prefix (misalnya, 'tabler', 'heroicons')
    const sortedIcons = {};
    iconNames.forEach(name => {
        const parts = name.split(':');
        if (parts.length !== 2) return;
        const [prefix, icon] = parts;
        if (!sortedIcons[prefix]) {
            sortedIcons[prefix] = [];
        }
        sortedIcons[prefix].push(icon);
    });

    // Mengambil data ikon menggunakan getIcons
    const iconifyJSON = await getIcons(sortedIcons, {
        height: 24, // Atur tinggi default jika perlu
    });

    if (!iconifyJSON) {
        console.error('Failed to retrieve icon data.');
        return;
    }

    // Menyimpan hasil ke file JSON
    await fs.writeFile(outputPath, stringifyJSON(iconifyJSON), 'utf-8');

    console.log(`Successfully bundled ${iconNames.length} icons to ${outputPath}`);
}

bundleIcons();
