<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;
use App\Models\ConfigCenter;

class ConfigCenterHelper
{
    public static function get($key, $default = null)
    {
        $config = ConfigCenter::where('key', $key)
            ->where('status', 'active')
            ->first();

        if (! $config) {
            return $default;
        }

        $value = $config->value;

        if ($config->is_encrypted) {
            try {
                $value = Crypt::decryptString($value);
            } catch (\Exception $e) {
                return $default;
            }
        }

        return self::parseValue($value, $config->type);
    }

    public static function set($key, $value, $encrypt = false, $type = 'text')
    {
        $config = ConfigCenter::firstOrNew(['key' => $key]);

        $config->value = $encrypt ? Crypt::encryptString($value) : $value;
        $config->is_encrypted = $encrypt;
        $config->type = $type;
        $config->status = 'active';
        $config->save();

        return $config;
    }

    private static function parseValue($value, $type)
    {
        return match ($type) {
            'json' => json_decode($value, true),
            'boolean' => (bool) $value,
            default => $value,
        };
    }
}
