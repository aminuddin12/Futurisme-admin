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
        $configs = [
            // --- Function: identity ---
            [
                'name' => 'site_logo',
                'function' => 'identity',
                'value' => ['path' => '/images/default-logo.svg', 'display_name' => 'Site Logo'],
            ],
            [
                'name' => 'site_favicon',
                'function' => 'identity',
                'value' => ['path' => '/favicon.ico', 'display_name' => 'Site Favicon'],
            ],
            [
                'name' => 'sitename',
                'function' => 'identity',
                'value' => ['value' => 'Futurisme Admin', 'display_name' => 'Site Name'],
            ],
            [
                'name' => 'site_url',
                'function' => 'identity',
                'value' => ['url' => config('app.url', 'http://localhost'), 'display_name' => 'Site URL'],
            ],

            // --- Function: theme ---
            [
                'name' => 'primary_color',
                'function' => 'theme',
                'value' => ['hex' => '#4F46E5', 'display_name' => 'Primary Color'],
            ],
            [
                'name' => 'secondary_color',
                'function' => 'theme',
                'value' => ['hex' => '#D946EF', 'display_name' => 'Secondary Color'],
            ],

            // --- Function: localization ---
            [
                'name' => 'site_locale',
                'function' => 'localization',
                'value' => ['code' => 'id', 'options' => ['id', 'en'], 'display_name' => 'Site Locale'],
            ],
            [
                'name' => 'site_timezone',
                'function' => 'localization',
                'value' => ['zone' => config('app.timezone', 'UTC'), 'display_name' => 'Site Timezone'],
            ],

            // --- Function: mail ---
            [
                'name' => 'mail_driver',
                'function' => 'mail',
                'value' => ['driver' => env('MAIL_MAILER', 'smtp'), 'display_name' => 'Mail Driver'],
            ],
            [
                'name' => 'mail_host',
                'function' => 'mail',
                'value' => ['host' => env('MAIL_HOST', 'smtp.mailgun.org'), 'display_name' => 'SMTP Host'],
            ],
            [
                'name' => 'mail_port',
                'function' => 'mail',
                'value' => ['port' => env('MAIL_PORT', 587), 'display_name' => 'SMTP Port'],
            ],
            [
                'name' => 'mail_from_address',
                'function' => 'mail',
                'value' => ['address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'), 'display_name' => 'Mail From Address'],
            ],

            // --- Function: social ---
            [
                'name' => 'social_facebook',
                'function' => 'social',
                'value' => ['url' => 'https://facebook.com', 'display_name' => 'Facebook URL'],
            ],
            [
                'name' => 'social_twitter',
                'function' => 'social',
                'value' => ['url' => 'https://twitter.com', 'display_name' => 'Twitter URL'],
            ],

            // --- Function: maintenance ---
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
