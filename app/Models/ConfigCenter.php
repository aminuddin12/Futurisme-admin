<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage; // ✅ tambahkan ini

class ConfigCenter extends Model
{
    use SoftDeletes;

    protected $table = 'config_center';

    protected $fillable = [
        'parent_id',
        'group',
        'function',
        'key',
        'value',
        'type',
        'media_disk',
        'media_path',
        'status',
        'is_encrypted',
        'description',
        'order',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_encrypted' => 'boolean',
        'order' => 'integer',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function getValueAttribute($value)
    {
        if ($this->is_encrypted && $value) {
            try {
                return Crypt::decryptString($value);
            } catch (\Exception $e) {
                return null;
            }
        }

        if ($this->type === 'json' && !empty($value)) {
            return json_decode($value, true);
        }

        return $value;
    }

    public function setValueAttribute($value)
    {
        if ($this->is_encrypted && $value) {
            $this->attributes['value'] = Crypt::encryptString($value);
        } elseif (is_array($value) || is_object($value)) {
            $this->attributes['value'] = json_encode($value);
            $this->attributes['type'] = 'json';
        } else {
            $this->attributes['value'] = $value;
        }
    }

    public function scopeGroup($query, string $group)
    {
        return $query->where('group', $group);
    }

    public function scopeFunction($query, string $function)
    {
        return $query->where('function', $function);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }


    /**
     * Get full URL of stored media file.
     *
     * @return string|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getMediaUrlAttribute()
    {
        if ($this->media_path && $this->media_disk) {
            try {
                $disk = Storage::disk($this->media_disk);

                /** @var \Illuminate\Contracts\Filesystem\Filesystem|\Illuminate\Contracts\Filesystem\Cloud $disk */
                if (method_exists($disk, 'url')) {
                    return $disk->url($this->media_path);
                }

                // fallback manual jika disk local
                return asset('storage/' . $this->media_path);
            } catch (\Exception $e) {
                return null;
            }
        }

        return null;
    }

    protected $hidden = [
        'is_encrypted',
        'deleted_at',
    ];
}
