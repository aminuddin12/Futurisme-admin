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
        Schema::create('sidebar_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('sidebar_menus')->onDelete('cascade');
            $table->string('key')->unique();
            $table->string('label');
            $table->string('title')->nullable(); // Untuk judul grup seperti 'Apps'
            $table->string('icon')->nullable();
            $table->string('icon_filled')->nullable();
            $table->string('href')->nullable();
            $table->string('route_name')->nullable();
            $table->json('badge')->nullable(); // Menyimpan data badge sebagai JSON
            $table->json('permissions')->nullable(); // Menyimpan permission yang diperlukan sebagai JSON Array
            $table->string('guard_name'); // Guard: 'insider', 'vendor', 'web'
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidebar_menus');
    }
};
