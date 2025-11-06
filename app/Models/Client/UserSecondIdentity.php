<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSecondIdentity extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_second_identities';

    protected $fillable = [
        'uIdentification',
        'type',
        'value',
        'status',
    ];
}
