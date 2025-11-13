<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class UserIdentity extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'profile_img',
        'phoneRegionale',
        'phoneNumber',
        'social_login',
        'status',
        'verified',
        // 'uIdentification' diisi oleh server
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'social_login' => 'array',
            'verified' => 'boolean',
        ];
    }

    /**
     * Boot the model.
     * Implementasi Catatan Penting 1:
     * Otomatis membuat uIdentification 12 digit unik saat data baru dibuat.
     */
    protected static function booted(): void
    {
        static::creating(function (UserIdentity $model) {
            if (empty($model->uIdentification)) {
                $model->uIdentification = self::generateUniqueIdentification();
            }
        });
    }

    /**
     * Helper untuk generate uIdentification unik.
     */
    private static function generateUniqueIdentification(): string
    {
        do {
            // Generates a 12-character random string (A-Z, a-z, 0-9)
            $uIdentification = Str::random(12);
        } while (self::where('uIdentification', $uIdentification)->exists());

        return $uIdentification;
    }

    // --- Implementasi Catatan 2 (Relasi via Server Function) ---
    // Tidak ada relasi `password()` di sini.
    // Anda akan mengambil password dari controller/service, e.g.:
    // $latestPassword = UserPasswd::where('uIdentification', $this->uIdentification)
    //                                ->where('status', 'newPass')
    //                                ->first();
}
