[Main](#main) | [Role And Permission](#role-and-permission)

---

## Main

## Deskripsi

Direktori ini berisi semua file *seeder* untuk database. Seeder digunakan untuk mengisi tabel database dengan data awal atau data dummy yang diperlukan untuk pengembangan dan pengujian aplikasi.

## Daftar Seeder

Berikut adalah rincian untuk setiap file seeder yang ada di dalam direktori ini.

### `RolesAndPermissionsSeeder.php`

*   **Tujuan:** Menginisialisasi semua peran (*roles*) dan izin (*permissions*) yang diperlukan dalam aplikasi menggunakan paket `spatie/laravel-permission`. Seeder ini juga membuat akun Super Admin default.
*   **Keterangan:** Seeder ini sangat penting dan harus dijalankan saat instalasi awal. Lihat tab Role And Permission untuk detail lebih lanjut.

---

## Cara Menjalankan Seeder

Untuk menjalankan **semua seeder** yang terdaftar di `DatabaseSeeder.php`, gunakan perintah:

```bash
php artisan db:seed
```

Jika Anda hanya ingin menjalankan seeder tertentu, gunakan opsi `--class`:

```bash
php artisan db:seed --class=UserSeeder
```

## Penutup

Pastikan untuk memperbarui file `README.md` ini setiap kali Anda menambah atau mengubah file seeder agar dokumentasi tetap relevan dan membantu anggota tim lain.
