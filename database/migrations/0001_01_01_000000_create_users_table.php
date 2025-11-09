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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uIdentification', 16)->unique();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('profile_img')->nullable();
            $table->string('phone_region', 10)->nullable();
            $table->string('phone_number', 25)->unique()->nullable();
            $table->json('social_login')->nullable();
            $table->string('status', 20)->default('offline'); // online, offline, suspended, banned
            $table->boolean('verified')->default(false);
            $table->timestamps();
        });

        Schema::create('users_passwds', function (Blueprint $table) {
            $table->id();
            $table->string('uIdentification', 16)->index();
            $table->string('password');
            $table->string('status', 20)->default('newPass'); // newPass, oldPass
            $table->rememberToken();
            $table->timestamps();
            $table->unique(['uIdentification', 'status']);
        });

        Schema::create('users_second_identities', function (Blueprint $table) {
            $table->id();
            $table->string('uIdentification', 16)->index();
            $table->string('type', 50); // e.g., 'KTP', 'Passport', 'NPWP'
            $table->string('value'); // Nomor identitas
            $table->string('status', 50); // e.g., 'pending_verification', 'verified', 'rejected'
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users_passwd_reset_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('uIdentification', 16)->nullable()->index();
            $table->string('token')->unique();
            $table->timestamp('created_at')->nullable();
        });

         Schema::create('users_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('uIdentification', 16)->index();
            $table->ipAddress()->nullable();
            $table->text('user_agent')->nullable();
            $table->string('device_id', 191)->nullable()->index();
            $table->string('device_fingerprint', 191)->nullable()->index();
            $table->string('os_name')->nullable();
            $table->string('app_key'); // Kunci aplikasi yg digunakan (e.g., 'web_admin', 'mobile_customer')
            $table->string('app_version'); // Versi aplikasi
            $table->string('type')->nullable(); // e.g., 'login', 'refresh_token'
            $table->text('payload')->nullable(); // Data tambahan (misal: token JWT jika perlu)
            $table->string('location')->nullable(); // Lokasi geografis (misal: "City, Country")
            $table->string('status', 20)->default('active'); // active, expired, revoked
            $table->timestamp('last_activity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('users_passwd_reset_tokens');
        Schema::dropIfExists('users_sessions');
        Schema::dropIfExists('users_second_identities');
        Schema::dropIfExists('users_passwds');
        Schema::dropIfExists('users');

    }
};
