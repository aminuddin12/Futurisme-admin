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
        Schema::create('config_center', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('config_center')->onDelete('cascade');
            $table->string('group')->index();
            $table->string('function')->nullable()->index();
            $table->string('key')->nullable()->unique();
            $table->longText('value')->nullable();
            $table->string('type')->default('text');
            $table->string('media_disk')->nullable();
            $table->string('media_path')->nullable();
            $table->enum('status', ['active', 'inactive', 'undefined'])->default('undefined')->index();
            $table->boolean('is_encrypted')->default(false);
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_center');
    }
};
