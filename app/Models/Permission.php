<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    // Dengan meng-extend model Permission dari Spatie, kita dapat menambahkan
    // logika kustom, relasi, atau accessor/mutator di sini pada masa mendatang
    // tanpa mengubah kode vendor.
    //
    // Untuk saat ini, file ini bisa tetap kosong karena sudah mewarisi semua fungsionalitas yang diperlukan.
}
