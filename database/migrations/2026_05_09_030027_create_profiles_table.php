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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->char('nidn', 25)->unique();
            $table->string('nama_dosen');
            $table->string('email', 100)->unique();
            $table->foreignId('prodi_id')->constrained('prodis');
            $table->string('jabatan');
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nim', 25)->unique();
            $table->string('nama_mahasiswa', 150);
            $table->string('email', 100)->unique();
            $table->foreignId('prodi_id')->constrained('prodis');
            $table->integer('semester');
            $table->string('angkatan', 4);
            $table->string('status', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
