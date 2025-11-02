<?php

namespace Database\Seeders;

use App\Models\WebConfig;
use Illuminate\Database\Seeder;

class WebConfigDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Konfigurasi untuk data form, tidak terkait langsung dengan struktur menu
        $configs = [
            [
                'name' => 'site_logo',
                'function' => 'identity',
                'value' => ['path' => '/images/default-logo.svg', 'display_name' => 'Site Logo'],
            ],
            [
                'name' => 'sitename',
                'function' => 'identity',
                'value' => ['value' => 'Futurisme Admin', 'display_name' => 'Site Name'],
            ],
            [
                'name' => 'site_url',
                'function' => 'general',
                'value' => ['url' => config('app.url', 'http://localhost'), 'display_name' => 'Site URL'],
            ],
            [
                'name' => 'site_locale',
                'function' => 'regional',
                'value' => ['code' => 'id', 'options' => ['id', 'en'], 'display_name' => 'Site Locale'],
            ],
            [
                'name' => 'site_timezone',
                'function' => 'regional',
                'value' => ['zone' => config('app.timezone', 'UTC'), 'display_name' => 'Site Timezone'],
            ],
            [
                'name' => 'site_status',
                'function' => 'maintenance',
                'value' => ['status' => 'live', 'options' => ['live', 'maintenance'], 'display_name' => 'Site Status'],
            ],
        ];

        foreach ($configs as $config) {
            WebConfig::updateOrCreate(
                ['name' => $config['name']],
                $config
            );
        }
    }
}
