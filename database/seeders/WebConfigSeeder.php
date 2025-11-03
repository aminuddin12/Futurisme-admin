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
        // WebConfig::truncate(); // Nonaktifkan truncate agar tidak menghapus data lain saat re-seed

        // 1. Grup Induk untuk semua Pengaturan Situs (sebagai namespace)
        $siteSettingsRoot = WebConfig::updateOrCreate(
            ['name' => 'site_settings_root'],
            [
                'function' => 'root_group',
                'value' => ['display_name' => 'Site Settings Root'],
                'order' => 1,
            ]
        );

        // --- GRUP 1: GENERAL ---
        $generalGroup = WebConfig::updateOrCreate(
            ['name' => 'settings_group_general'],
            [
                'parent_id' => $siteSettingsRoot->id,
                'function' => 'sidebar_group',
                'value' => ['display_name' => 'General'],
                'order' => 1,
            ]
        );

        // Item di bawah General
        WebConfig::updateOrCreate(
            ['name' => 'identity'],
            [
                'parent_id' => $generalGroup->id,
                'function' => 'sidebar_item',
                'value' => [
                    'display_name' => 'Identity',
                    'icon' => 'heroicons:identification',
                ],
                'order' => 1,
            ]
        );

        // --- GRUP 2: APPEARANCE ---
        $appearanceGroup = WebConfig::updateOrCreate(
            ['name' => 'settings_group_appearance'],
            [
                'parent_id' => $siteSettingsRoot->id,
                'function' => 'sidebar_group',
                'value' => ['display_name' => 'Appearance'],
                'order' => 2,
            ]
        );

        // Item di bawah Appearance
        WebConfig::updateOrCreate(
            ['name' => 'theme'],
            [
                'parent_id' => $appearanceGroup->id,
                'function' => 'sidebar_item',
                'value' => [
                    'display_name' => 'Theme',
                    'icon' => 'heroicons:paint-brush',
                ],
                'order' => 1,
            ]
        );

        // --- GRUP 3: REGIONAL ---
        $regionalGroup = WebConfig::updateOrCreate(
            ['name' => 'settings_group_regional'],
            [
                'parent_id' => $siteSettingsRoot->id,
                'function' => 'sidebar_group',
                'value' => ['display_name' => 'Regional'],
                'order' => 3,
            ]
        );

        // Item di bawah Regional
        WebConfig::updateOrCreate(
            ['name' => 'localization'],
            [
                'parent_id' => $regionalGroup->id,
                'function' => 'sidebar_item',
                'value' => [
                    'display_name' => 'Localization',
                    'icon' => 'heroicons:language',
                ],
                'order' => 1,
            ]
        );

        // --- GRUP 4: INTEGRATIONS ---
        $integrationsGroup = WebConfig::updateOrCreate(
            ['name' => 'settings_group_integrations'],
            [
                'parent_id' => $siteSettingsRoot->id,
                'function' => 'sidebar_group',
                'value' => ['display_name' => 'Integrations'],
                'order' => 4,
            ]
        );

        // Item di bawah Integrations
        WebConfig::updateOrCreate(['name' => 'mail', 'parent_id' => $integrationsGroup->id, 'function' => 'sidebar_item', 'value' => ['display_name' => 'Mail', 'icon' => 'heroicons:envelope'], 'order' => 1]);
        WebConfig::updateOrCreate(['name' => 'social', 'parent_id' => $integrationsGroup->id, 'function' => 'sidebar_item', 'value' => ['display_name' => 'Social Media', 'icon' => 'heroicons:share'], 'order' => 2]);

        // --- GRUP 5: ADVANCED ---
        $advancedGroup = WebConfig::updateOrCreate(
            ['name' => 'settings_group_advanced'],
            [
                'parent_id' => $siteSettingsRoot->id,
                'function' => 'sidebar_group',
                'value' => ['display_name' => 'Advanced'],
                'order' => 5,
            ]
        );

        // Item di bawah Advanced
        WebConfig::updateOrCreate(
            ['name' => 'maintenance'],
            [
                'parent_id' => $advancedGroup->id,
                'function' => 'sidebar_item',
                'value' => ['display_name' => 'Maintenance', 'icon' => 'heroicons:wrench-screwdriver'],
                'order' => 1,
            ]
        );

        // Jalankan seeder untuk data form (yang sudah ada sebelumnya)
        // Ini dipisahkan agar lebih rapi
        $this->call(WebConfigDataSeeder::class);
    }
}
