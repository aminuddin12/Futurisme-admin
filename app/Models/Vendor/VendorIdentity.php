<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class VendorIdentity extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'vendors';

    protected $fillable = [
        //'vIdentification',
        'company_name',
        'email',
        'contact_person',
        'phone_region',
        'phone_number',
        'website',
        'address',
        'social_links',
        'status',
        'verified',
    ];

    protected function casts(): array
    {
        return [
            'social_links' => 'array',
            'verified' => 'boolean',
        ];
    }

    /**
     * Boot the model.
     * Membuat vIdentification unik otomatis saat record baru dibuat.
     */
    protected static function booted(): void
    {
        static::creating(function (VendorIdentity $model) {
            if (empty($model->vIdentification)) {
                $model->vIdentification = self::generateUniqueIdentification();
            }
        });
    }

    /**
     * Helper untuk generate vIdentification unik.
     */
    private static function generateUniqueIdentification(): string
    {
        do {
            $vIdentification = Str::random(12);
        } while (self::where('vIdentification', $vIdentification)->exists());

        return $vIdentification;
    }
    public function password()
    {
        return $this->hasOne(VendorPasswd::class, 'vIdentification', 'vIdentification');
    }

    // Override method untuk mengambil password
    public function getAuthPassword()
    {
        return $this->password->password_hash ?? null;
    }
}
