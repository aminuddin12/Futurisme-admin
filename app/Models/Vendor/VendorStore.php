<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VendorStore extends Model
{
    use HasFactory;

    /**
     * Nama tabel database.
     */
    protected $table = 'vendor_stores';

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'vIdentification',
        'name',
        'slug',
        'description',
        'logo_url',
        'cover_photo_url',
        'is_active',
    ];

    /**
     * Mendapatkan data Vendor (pemilik) dari toko ini.
     * Relasi ini menggunakan 'vIdentification' sebagai kunci.
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(VendorIdentity::class, 'vIdentification', 'vIdentification');
    }

    /**
     * Mendapatkan semua produk yang dimiliki oleh toko ini.
     */
    public function products(): HasMany
    {
        return $this->hasMany(VendorProduct::class, 'vendor_store_id');
    }
}
