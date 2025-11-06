<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    use HasFactory;

    protected $table = 'user_sessions';

    protected $fillable = [
        'uIdentification',
        'ip_address',
        'user_agent',
        'device_id',
        'device_fingerprint',
        'os_name',
        'app_key',
        'app_version',
        'type',
        'payload',
        'location',
        'status',
        'last_activity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'last_activity' => 'datetime',
        ];
    }
}
