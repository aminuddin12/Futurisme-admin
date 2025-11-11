<div align="center">
  
  <!-- Ganti dengan logo proyek Anda jika ada -->
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" alt="Laravel Logo" width="400">

  <h1 align="center">Futurisme Admin Backend</h1>

  <p align="center">
    Sistem backend untuk manajemen "Insider" pada platform Futurisme.
    <br />
    <a href="#"><strong>Jelajahi Dokumentasi API »</strong></a>
    <br />
    <br />
    <a href="#">Laporkan Bug</a>
    ·
    <a href="#">Minta Fitur Baru</a>
  </p>
</div>

<p align="center">
  <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
</p>

---

## Tentang Proyek

**Futurisme Admin Backend** adalah sebuah API service yang dirancang untuk menjadi tulang punggung sistem manajemen internal. Proyek ini menangani semua kebutuhan terkait data "Insider", mulai dari pendaftaran, autentikasi, manajemen profil, hingga fitur-fitur kepegawaian lainnya seperti absensi dan penggajian.

Dibangun dengan Laravel, API ini menawarkan struktur yang solid, aman, dan mudah untuk dikembangkan lebih lanjut.

### Dibangun Dengan

*   [Laravel](https://laravel.com/)
*   [Laravel Sanctum](https://laravel.com/docs/sanctum)

---

## Memulai

Untuk menjalankan salinan lokal proyek ini, ikuti langkah-langkah sederhana di bawah ini.

### Prasyarat

Pastikan Anda telah menginstal perangkat lunak berikut:
*   PHP (versi sesuai `composer.json`)
*   Composer
*   Database (misalnya MySQL, PostgreSQL)

### Instalasi

1.  **Clone repository**
    ```sh
    git clone https://github.com/your_username/futurisme-admin.git
    cd futurisme-admin
    ```
2.  **Install dependensi PHP**
    ```sh
    composer install
    ```
3.  **Buat dan konfigurasi file `.env`**
    Salin `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```
4.  **Jalankan migrasi database**
    ```sh
    php artisan migrate
    ```
5.  **Jalankan server pengembangan**
    ```sh
    php artisan serve
    ```
    Server akan berjalan di `http://127.0.0.1:8000`.

---

## Struktur Rute & Endpoint

Proyek ini memiliki dua jenis rute utama: **Rute Web** untuk antarmuka pengguna dan **Rute API** untuk layanan backend.

### Rute Web (`routes/web.php`)

Rute ini menangani antarmuka berbasis web yang dirender menggunakan Inertia.js.

| Method | URI                  | Fungsi                                       | Catatan                               |
| :----- | :------------------- | :------------------------------------------- | :------------------------------------ |
| `GET`  | `/`                  | Menampilkan halaman utama (landing page).    | Publik.                               |
| `GET`  | `/login`             | Menampilkan halaman login.                   | Disediakan oleh `routes/auth.php`.    |
| `GET`  | `/register`          | Menampilkan halaman registrasi.              | Disediakan oleh `routes/auth.php`.    |
| `ANY`  | `/admin/{...}`       | Rute-rute untuk panel administrasi.          | Memerlukan login & peran **Admin**.   |

### Rute API (`routes/API/v1/Insider/api.php`)

Endpoint API utama berada di bawah prefix `/api/v1/insider/`. Otentikasi ditangani menggunakan **Laravel Sanctum**. Untuk mengakses endpoint yang terproteksi, sertakan `Bearer Token` yang didapat saat login pada *header* `Authorization`.

#### 1. Autentikasi & Manajemen Akun (Publik)

Endpoint ini dapat diakses secara publik tanpa memerlukan token otentikasi.

| Method | Endpoint                  | Fungsi                                       | Request Body / Catatan                |
| :----- | :------------------------ | :------------------------------------------- | :------------------------------------ |
| `POST` | `/register`               | Mendaftarkan Insider baru beserta profilnya. | `username`, `email`, `password`, dll. |
| `POST` | `/login`                  | Login untuk mendapatkan token akses.         | `credential` (email/username), `password`. |
| `POST` | `/forgot-password`        | Meminta token untuk reset password.          | `credential` (email/username).        |
| `POST` | `/reset-password`         | Mengatur ulang password menggunakan token.   | `credential`, `token`, `password`.    |

#### 2. Profil Pengguna (Terproteksi)

Endpoint ini memerlukan otentikasi menggunakan token Sanctum.

| Method | Endpoint                  | Fungsi                                       | Catatan                               |
| :----- | :------------------------ | :------------------------------------------- | :------------------------------------ |
| `POST` | `/logout`                 | Logout dan menghapus token sesi saat ini.    | -                                     |
| `GET`  | `/me`                     | Mendapatkan data profil dari Insider yang sedang login. | -                                     |

---

## Contributing

Kontribusi adalah hal yang membuat komunitas *open source* menjadi tempat yang luar biasa untuk belajar, menginspirasi, dan berkreasi. Setiap kontribusi yang Anda berikan sangat **kami hargai**.

## License

Didistribusikan di bawah Lisensi MIT. Lihat `LICENSE.txt` untuk informasi lebih lanjut.
