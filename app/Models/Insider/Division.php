<?php

namespace App\Models\Insider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'divisions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'division_name',
        'description',
        'image_url',
    ];

    /**
     * Get the profiles for the division.
     */
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
