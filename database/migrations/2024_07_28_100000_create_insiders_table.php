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
        Schema::create('insiders', function (Blueprint $table) {
            $table->id();
            $table->string('uIdentification', 16)->unique();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        // Lookup tables
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('position_name')->unique();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('division_name')->unique();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Profile table with foreign keys
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('uIdentification', 16)->unique();
            $table->string('id_code')->unique()->comment('Employee ID Code');
            // $table->foreignId('insider_id')->constrained('insiders')->cascadeOnDelete();
            $table->string('identity_number')->nullable(); // KTP/Passport
            $table->string('identity_pict')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('regency')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_district')->nullable();
            $table->string('apartment')->nullable();
            $table->string('building_number')->nullable();
            $table->string('house_number_1');
            $table->string('house_number_2')->nullable();
            $table->string('street');
            $table->text('additional_address')->nullable();
            $table->string('maps_location')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_location')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('face_pict')->nullable();
            $table->date('entry_date');
            $table->foreignId('position_id');
            $table->foreignId('division_id');
            $table->timestamps();
            $table->softDeletes();

            // Definisikan foreign key secara manual untuk kejelasan
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('division_id')->references('id')->on('divisions');
        });

        // Additional related tables
        Schema::create('wages', function (Blueprint $table) {
            $table->id();
            $table->string('uIdentification', 16)->unique();
            // $table->foreignId('insider_id')->constrained('insiders')->cascadeOnDelete();
            $table->string('period'); // e.g., "2025-10"
            $table->decimal('basic_salary', 15, 2);
            $table->decimal('allowance', 15, 2)->default(0);
            $table->decimal('salary_deduction', 15, 2)->default(0);
            $table->decimal('total_salary', 15, 2);
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('uIdentification', 16)->unique();
            // $table->foreignId('insider_id')->constrained('insiders')->cascadeOnDelete();
            $table->date('date');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->enum('status', ['in', 'permission', 'sick', 'leave', 'alpha']);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('uIdentification', 16)->unique();
            // $table->foreignId('insider_id')->constrained('insiders')->cascadeOnDelete();
            $table->date('submission_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('type_leave');
            $table->text('reason');
            $table->enum('status', ['approved', 'rejected', 'pending'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('wages');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('divisions');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('insiders');
    }
};
