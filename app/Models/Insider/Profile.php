<?php

namespace App\Models\Insider;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_code',
        'insider_id',
        'identity_number',
        'identity_pict',
        'first_name',
        'last_name',
        'country',
        'state',
        'regency',
        'district',
        'sub_district',
        'apartment',
        'building_number',
        'house_number_1',
        'house_number_2',
        'street',
        'additional_address',
        'birth_date',
        'birth_location',
        'gender',
        'face_pict',
        'entry_date',
        'position_id',
        'division_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
        'entry_date' => 'date',
    ];

    /**
     * Get the insider that owns the profile.
     */
    public function insider()
    {
        return $this->belongsTo(Insider::class);
    }

    /**
     * Get the position for the profile.
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    /**
     * Get the division for the profile.
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
