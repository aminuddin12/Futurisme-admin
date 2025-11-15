<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorProduct extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     */
    protected $table = 'vendor_products';

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'vendor_store_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'images',
        'is_active',
    ];

    /**
     * Tipe data casting.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'images' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Mendapatkan data Toko (store) dari produk ini.
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(VendorStore::class, 'vendor_store_id');
    }
}
