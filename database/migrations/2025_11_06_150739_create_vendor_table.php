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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vIdentification', 16)->unique();
            $table->string('company_name')->unique();
            $table->string('email')->unique();
            $table->string('contact_person')->nullable();
            $table->string('phone_region', 10)->nullable();
            $table->string('phone_number', 25)->unique()->nullable();
            $table->string('website')->nullable();
            $table->text('address')->nullable();
            $table->json('social_links')->nullable();
            $table->string('status', 20)->default('inactive'); // active, inactive, suspended
            $table->boolean('verified')->default(false);
            $table->timestamps();
        });

        Schema::create('vendors_passwds', function (Blueprint $table) {
            $table->id();
            $table->string('vIdentification', 16)->index();
            $table->string('password');
            $table->string('status', 20)->default('newPass'); // newPass, oldPass
            $table->rememberToken();
            $table->timestamps();
            $table->unique(['vIdentification', 'status']);
        });

        Schema::create('vendors_documents', function (Blueprint $table) {
            $table->id();
            $table->string('vIdentification', 16)->index();
            $table->string('type', 50); // e.g., 'NIB', 'SIUP', 'NPWP'
            $table->string('file_path'); // path dokumen
            $table->string('status', 50); // pending_verification, verified, rejected
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('vendors_passwd_reset_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('vIdentification', 16)->nullable()->index();
            $table->string('token')->unique();
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('vendors_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('vIdentification', 16)->index();
            $table->ipAddress()->nullable();
            $table->text('user_agent')->nullable();
            $table->string('device_id', 191)->nullable()->index();
            $table->string('device_fingerprint', 191)->nullable()->index();
            $table->string('os_name')->nullable();
            $table->string('app_key'); // e.g., 'web_admin', 'vendor_portal'
            $table->string('app_version');
            $table->string('type')->nullable(); // login, refresh_token
            $table->text('payload')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('vendors_passwd_reset_tokens');
        Schema::dropIfExists('vendors_sessions');
        Schema::dropIfExists('vendors_documents');
        Schema::dropIfExists('vendors_passwds');
        Schema::dropIfExists('vendors');
    }
};
