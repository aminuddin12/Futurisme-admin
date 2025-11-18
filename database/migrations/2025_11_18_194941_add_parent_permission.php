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
        $tableNames = config('permission.table_names');

        // Tambah parent_id ke tabel permissions
        if (Schema::hasTable($tableNames['permissions'])) {
            Schema::table($tableNames['permissions'], function (Blueprint $table) use ($tableNames) {
                // Menambahkan kolom parent_id setelah id
                $table->unsignedBigInteger('parent_id')->nullable()->after('id');

                // Menambahkan foreign key ke dirinya sendiri (self-referencing)
                $table->foreign('parent_id')
                    ->references('id')
                    ->on($tableNames['permissions'])
                    ->onDelete('cascade'); // Jika parent dihapus, child ikut terhapus
            });
        }

        // Tambah parent_id ke tabel roles
        // if (Schema::hasTable($tableNames['roles'])) {
        //     Schema::table($tableNames['roles'], function (Blueprint $table) use ($tableNames) {
        //         // Menambahkan kolom parent_id setelah id
        //         $table->unsignedBigInteger('parent_id')->nullable()->after('id');

        //         // Menambahkan foreign key ke dirinya sendiri
        //         $table->foreign('parent_id')
        //             ->references('id')
        //             ->on($tableNames['roles'])
        //             ->onDelete('cascade');
        //     });
        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');

        if (Schema::hasTable($tableNames['permissions'])) {
            Schema::table($tableNames['permissions'], function (Blueprint $table) {
                $table->dropForeign(['parent_id']);
                $table->dropColumn('parent_id');
            });
        }

        // if (Schema::hasTable($tableNames['roles'])) {
        //     Schema::table($tableNames['roles'], function (Blueprint $table) {
        //         $table->dropForeign(['parent_id']);
        //         $table->dropColumn('parent_id');
        //     });
        // }
    }
};
