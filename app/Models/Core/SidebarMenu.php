<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class SidebarMenu extends Model
{
    use HasFactory;

    protected $table = 'sidebar_menus';

    protected $fillable = [
        'parent_id',
        'key',
        'label',
        'title',
        'icon',
        'icon_filled',
        'href',
        'route_name',
        'badge',
        'permissions',
        'guard_name',
        'order',
    ];

    /**
     * Mengubah JSON menjadi array saat diakses.
     */
    protected $casts = [
        'badge' => 'array',
        'permissions' => 'array',
    ];

    /**
     * Relasi ke parent (untuk submenu).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(SidebarMenu::class, 'parent_id');
    }

    /**
     * Relasi ke children (untuk grup menu).
     */
    public function children(): HasMany
    {
        return $this->hasMany(SidebarMenu::class, 'parent_id');
    }

    /**
     * Scope untuk mengambil menu level atas (grup).
     */
    public function scopeTopLevel(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope untuk mengambil menu berdasarkan guard.
     */
    public function scopeForGuard(Builder $query, string $guardName): Builder
    {
        return $query->where('guard_name', $guardName);
    }
}
