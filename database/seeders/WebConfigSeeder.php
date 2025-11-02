<?php

namespace Database\Seeders;

use App\Models\WebConfig;
use Illuminate\Database\Seeder;

class WebConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama untuk memastikan konsistensi
        WebConfig::truncate();

        // 1. Grup Induk untuk semua Pengaturan Situs (sebagai namespace)
        $siteSettingsRoot = WebConfig::updateOrCreate(
            ['name' => 'site_settings_root'],
            [
                'function' => 'root_group',
                'value' => ['display_name' => 'Website Settings'],
                'order' => 1,
            ]
        );

        // 2. Grup Menu Sidebar Pertama: "Configuration"
        $configurationGroup = WebConfig::updateOrCreate(
            ['name' => 'configuration_group'],
            [
                'parent_id' => $siteSettingsRoot->id,
                'function' => 'sidebar_group',
                'value' => ['display_name' => 'Configuration'], // Ini akan menjadi judul grup
                'order' => 1,
            ]
        );

        // 3. Item Menu di bawah "Configuration"
        WebConfig::updateOrCreate(
            ['name' => 'general'], // Ini akan menjadi 'key' untuk menu
            [
                'parent_id' => $configurationGroup->id,
                'function' => 'sidebar_item',
                'value' => [
                    'display_name' => 'General', // Ini adalah 'label'
                    'icon' => 'heroicons:cog-6-tooth', // Ini adalah 'icon'
                ],
                'order' => 1,
            ]
        );

        // 4. Grup Menu Sidebar Kedua: "Advanced"
        $advancedGroup = WebConfig::updateOrCreate(
            ['name' => 'advanced_group'],
            [
                'parent_id' => $siteSettingsRoot->id,
                'function' => 'sidebar_group',
                'value' => ['display_name' => 'Advanced'],
                'order' => 2,
            ]
        );

        // 5. Item Menu di bawah "Advanced"
        WebConfig::updateOrCreate(
            ['name' => 'maintenance'],
            [
                'parent_id' => $advancedGroup->id,
                'function' => 'sidebar_item',
                'value' => [
                    'display_name' => 'Maintenance Mode',
                    'icon' => 'heroicons:wrench-screwdriver',
                ],
                'order' => 1,
            ]
        );

        // Jalankan seeder untuk data form (yang sudah ada sebelumnya)
        // Ini dipisahkan agar lebih rapi
        $this->call(WebConfigDataSeeder::class);
    }
}
