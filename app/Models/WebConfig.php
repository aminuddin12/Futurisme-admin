<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'function',
        'name',
        'value',
        'order',
    ];

    protected $casts = [
        'value' => 'array', // Otomatis cast kolom 'value' dari/ke JSON
    ];

    /**
     * Relasi ke parent (untuk item turunan).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(WebConfig::class, 'parent_id');
    }

    /**
     * Relasi ke children (untuk item utama).
     */
    public function children(): HasMany
    {
        return $this->hasMany(WebConfig::class, 'parent_id');
    }
}
