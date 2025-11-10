<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorDocument extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vendors_documents';

    protected $fillable = [
        'vIdentification',
        'type',
        'file_path',
        'status',
    ];
}
