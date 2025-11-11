# Dokumentasi Rute Aplikasi

Direktori `routes/` ini berisi semua definisi rute untuk aplikasi Futurisme Admin. Rute-rute ini mengarahkan permintaan HTTP ke *controller* atau *closure* yang sesuai, menentukan bagaimana aplikasi merespons berbagai URL.

Aplikasi ini memisahkan rute menjadi beberapa file untuk menjaga keteraturan dan kejelasan:

---

## Struktur Direktori Rute

*   `routes/Guest/web.php`: Rute utama untuk antarmuka pengguna berbasis web.
*   `routes/Admin.php`: Rute-rute untuk panel administrasi, yang dimuat oleh `web.php`.
*   `routes/API/v1/Insider/api.php`: Rute-rute untuk API manajemen "Insider".

---

## Rute Web (`routes/web.php`)

File ini mendefinisikan rute-rute yang menangani antarmuka pengguna berbasis web, yang dirender menggunakan **Inertia.js**.

| Method | URI                  | Fungsi                                       | Catatan                               |
| :----- | :------------------- | :------------------------------------------- | :------------------------------------ |
| `GET`  | `/`                  | Menampilkan halaman utama (landing page).    | Publik.                               |
| `GET`  | `/login`             | Menampilkan halaman login.                   | Disediakan oleh `routes/auth.php`.    |
| `GET`  | `/register`          | Menampilkan halaman registrasi.              | Disediakan oleh `routes/auth.php`.    |
| `ANY`  | `/admin/{...}`       | Rute-rute untuk panel administrasi.          | Memerlukan login & peran **Admin**.   |

---

## Rute Admin Web (`routes/Admin.php`)

File ini berisi rute-rute khusus untuk panel administrasi. Semua rute di sini secara otomatis akan memiliki prefix `/admin` dan dilindungi oleh middleware `auth` serta `role:Admin`.

*(Detail endpoint di sini akan bergantung pada isi file `routes/Admin.php` Anda.)*

---

## Rute API Insider (`routes/API/v1/Insider/api.php`)

Endpoint API utama untuk manajemen "Insider" berada di bawah prefix `/api/v1/insider/`. Autentikasi untuk API ini ditangani menggunakan **Laravel Sanctum**. Untuk mengakses endpoint yang terproteksi, sertakan `Bearer Token` yang didapat saat login pada *header* `Authorization`.

### 1. Autentikasi & Manajemen Akun (Publik)

| Method | Endpoint                  | Fungsi                                       | Request Body / Catatan                |
| :----- | :------------------------ | :------------------------------------------- | :------------------------------------ |
| `POST` | `/register`               | Mendaftarkan Insider baru beserta profilnya. | `username`, `email`, `password`, `first_name`, `last_name`, `identity_number`, `identity_type`, `phone_region`, `phone_number`. |
| `POST` | `/login`                  | Login untuk mendapatkan token akses.         | `credential` (email/username), `password`. |
| `POST` | `/forgot-password`        | Meminta token untuk reset password.          | `credential` (email/username).        |
| `POST` | `/reset-password`         | Mengatur ulang password menggunakan token.   | `credential`, `token`, `password`, `password_confirmation`. |

### 2. Profil Pengguna (Terproteksi)

| Method | Endpoint                  | Fungsi                                       | Catatan                               |
| :----- | :------------------------ | :------------------------------------------- | :------------------------------------ |
| `POST` | `/logout`                 | Logout dan menghapus token sesi saat ini.    | Memerlukan `Bearer Token`.            |
| `GET`  | `/me`                     | Mendapatkan data profil dari Insider yang sedang login. | Memerlukan `Bearer Token`.            |
