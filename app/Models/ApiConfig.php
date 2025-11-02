<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiConfig extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'api_configs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'function',
        'name',
        'value',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'value' => 'array',
    ];

    /**
     * Get the parent for the config.
     */
    public function parent()
    {
        return $this->belongsTo(ApiConfig::class, 'parent_id');
    }

    /**
     * Get the children for the config.
     */
    public function children()
    {
        return $this->hasMany(ApiConfig::class, 'parent_id');
    }
}
