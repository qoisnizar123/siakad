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
            $table->string('name');
            $table->string('email')->unique();
<<<<<<< HEAD
            $table->string('npm')->nullable()->unique();
            $table->string('nidn')->nullable()->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'dosen', 'mahasiswa']);
=======
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // Tambahkan role di sini
            $table->enum('role', ['admin', 'dosen', 'mahasiswa'])->default('mahasiswa');
>>>>>>> 0db3f78fb4f2a7c687b1b4e96705e2da4e491494
            $table->rememberToken();
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
