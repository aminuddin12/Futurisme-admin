<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Membuat tabel untuk Toko/Store milik Vendor
        // Tabel ini terhubung ke tabel 'vendors' melalui 'vIdentification'
        Schema::create('vendor_stores', function (Blueprint $table) {
            $table->id();

            // Kunci asing yang terhubung ke tabel 'vendors'
            // Harus cocok dengan tipe data di migrasi '..._create_vendor_table.php'
            $table->string('vIdentification', 16);

            $table->string('name');
            $table->string('slug')->unique(); // Untuk URL yang ramah (e.g., /stores/nama-toko-saya)
            $table->text('description')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('cover_photo_url')->nullable();
            $table->boolean('is_active')->default(false);

            // Menambahkan foreign key constraint
            // Ini akan otomatis menghapus toko jika vendor dihapus (onDelete('cascade'))
            $table->foreign('vIdentification')
                  ->references('vIdentification')
                  ->on('vendors')
                  ->onDelete('cascade');

            $table->timestamps();
        });

        // 2. Membuat tabel untuk Produk
        // Produk terhubung ke Toko (vendor_stores)
        Schema::create('vendor_products', function (Blueprint $table) {
            $table->id();

            // Kunci asing yang terhubung ke toko
            $table->foreignId('vendor_store_id')
                  ->constrained('vendor_stores')
                  ->onDelete('cascade');

            $table->string('name');
            $table->string('slug')->unique(); // Untuk URL produk (e.g., /products/nama-produk-saya)
            $table->text('description')->nullable();

            // Menyimpan harga dalam 'decimal' untuk akurasi mata uang
            $table->decimal('price', 15, 2)->default(0);
            $table->integer('stock')->default(0);

            $table->json('images')->nullable(); // Menyimpan daftar URL gambar sebagai JSON
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_products');
        Schema::dropIfExists('vendor_stores');
    }
};
