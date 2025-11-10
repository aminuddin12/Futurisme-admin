<?php

namespace App\Models\Insider;

use App\Models\Insider\Profile;
use App\Helpers\IdentityHelper;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Insider extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $table = 'insiders';

    protected $fillable = [
        'iIdentification',
        'username',
        'email',
        'password',
        // tambahkan kolom lain yang boleh mass assign
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function booted()
    {
        static::creating(function ($insider) {
            if (empty($insider->iIdentification)) {
                // gunakan helpermu — pastikan method ini ada
                $insider->iIdentification = IdentityHelper::generateUniqueUIdentification();
            }

            if (!empty($insider->password) && !\Illuminate\Support\Str::startsWith($insider->password, '$2y$')) {
                // hash password jika belum di-hash
                $insider->password = Hash::make($insider->password);
            }
        });

        static::updating(function ($insider) {
            if (isset($insider->password) && !\Illuminate\Support\Str::startsWith($insider->password, '$2y$')) {
                $insider->password = Hash::make($insider->password);
            }
        });
    }

    /**
     * Get the profile associated with the insider.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class, 'iIdentification', 'iIdentification');
    }

    /**
     * Get the wages for the insider.
     */
    public function wages()
    {
        return $this->hasMany(Wage::class, 'iIdentification', 'iIdentification');
    }

    /**
     * Get the attendances for the insider.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'iIdentification', 'iIdentification');
    }

    /**
     * Get the leaves for the insider.
     */
    public function leaves()
    {
        return $this->hasMany(Leave::class, 'iIdentification', 'iIdentification');
    }

    public function hasPermissionTo($permission): bool
    {
        // Menentukan nama permission, baik dari objek maupun string.
        $permissionName = is_string($permission) ? $permission : $permission->name;

        // Jika nama permission tidak valid, kembalikan false.
        if (empty($permissionName)) {
            return false;
        }

        // Memeriksa apakah ada di antara peran pengguna yang memiliki izin dengan nama yang cocok.
        return $this->roles()->whereHas('permissions', function ($query) use ($permissionName) {
            $query->where('name', $permissionName);
        })->exists();
    }

    public function toPublicArray(): array
    {
        return [
            'id' => $this->id,
            'iIdentification' => $this->iIdentification,
            'username' => $this->username,
            'email' => $this->email,
            'status' => $this->status,
            'role' => $this->role,
            'profile' => $this->relationLoaded('profile') ? $this->profile->toArray() : $this->profile,
        ];
    }
}
