<?php

namespace App\Models\Insider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wage extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'insider_id',
        'period',
        'basic_salary',
        'allowance',
        'salary_deduction',
        'total_salary',
        'status',
    ];

    /**
     * Get the insider that owns the wage.
     */
    public function insider()
    {
        return $this->belongsTo(Insider::class);
    }
}
