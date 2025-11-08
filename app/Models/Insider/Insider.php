<?php

namespace App\Models\Insider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Insider extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The guard name for this model.
     *
     * @var string
     */
    protected $guard = 'insider';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
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

    /**
     * Get the profile associated with the insider.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the wages for the insider.
     */
    public function wages()
    {
        return $this->hasMany(Wage::class);
    }

    /**
     * Get the attendances for the insider.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get the leaves for the insider.
     */
    public function leaves()
    {
        return $this->hasMany(Leave::class);
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
}
