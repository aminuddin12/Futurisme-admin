<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    // Dengan meng-extend model Role dari Spatie, kita dapat menambahkan
    // logika kustom, relasi, atau accessor/mutator di sini pada masa mendatang
    // tanpa mengubah kode vendor.
    //
    // Untuk saat ini, file ini bisa tetap kosong karena sudah mewarisi semua fungsionalitas yang diperlukan.
}
