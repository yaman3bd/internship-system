<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('national_id')->unique();
            $table->string('country_code', 10)->index();
            $table->string('student_no')->unique();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('phone')->unique();
            $table->string('place_of_birth');
            $table->dateTime('date_of_birth');
            $table->string('password');
            $table->enum('gender', ['male', 'female', 'unknown'])->default('unknown');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
