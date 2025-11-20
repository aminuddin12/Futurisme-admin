# Database Seeders

## Deskripsi

Direktori ini berisi semua file *seeder* untuk database. Seeder digunakan untuk mengisi tabel database dengan data awal atau data dummy yang diperlukan untuk pengembangan dan pengujian aplikasi.

---

## Daftar Seeder

Berikut adalah rincian untuk setiap file seeder yang ada di dalam direktori ini.

### `UserSeeder.php` (Contoh)

*   **Tujuan:** Seeder ini digunakan untuk mengisi tabel `users` dengan data pengguna awal, seperti akun administrator atau beberapa akun pengguna dummy.
*   **Struktur Data:**
    ```json
    {
      "name": "string",
      "email": "string|unique",
      "password": "hashed_string",
      "role": "string (e.g., 'admin', 'user')"
    }
    ```
*   **Keterangan:** Jalankan seeder ini untuk membuat akun admin utama agar bisa masuk ke dalam sistem.

### `ProductCategorySeeder.php` (Contoh)

*   **Tujuan:** Mengisi tabel `product_categories` dengan daftar kategori produk yang standar.
*   **Struktur Data:**
    ```json
    {
      "name": "string",
      "slug": "string|unique"
    }
    ```
*   **Keterangan:** Kategori ini akan digunakan sebagai relasi untuk data produk.

---

## Cara Menjalankan Seeder

Untuk menjalankan semua seeder, Anda dapat menggunakan perintah Artisan berikut:

```bash
php artisan db:seed
```

Jika Anda hanya ingin menjalankan seeder tertentu, gunakan opsi `--class`:

```bash
php artisan db:seed --class=UserSeeder
```

## Penutup

Pastikan untuk memperbarui file `README.md` ini setiap kali Anda menambah atau mengubah file seeder agar dokumentasi tetap relevan dan membantu anggota tim lain.
