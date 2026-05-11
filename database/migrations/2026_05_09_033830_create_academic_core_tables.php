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
        // 1. Tabel Mata Kuliah
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk')->unique();
            $table->string('nama_mk');
            $table->integer('sks');
            $table->foreignId('prodi_id')->constrained('prodis');
            $table->timestamps();
        });

        // 2. Tabel Jadwal Kuliah (Pusat Relasi)
        Schema::create('jadwal_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs');
            $table->foreignId('dosen_id')->constrained('dosens');
            $table->foreignId('ruangan_id')->constrained('ruangans');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('semester'); // Contoh: Ganjil 2024/2025
            $table->timestamps();
        });

        // 3. Tabel KRS (Bridge Mahasiswa & Jadwal)
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas');
            $table->foreignId('jadwal_id')->constrained('jadwal_kuliahs');
            $table->enum('status', ['pending', 'approved'])->default('pending');
            $table->timestamps();
        });

        // 4. Tabel Nilai
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('krs_id')->constrained('krs')->onDelete('cascade');
            $table->integer('angka')->nullable(); // 0-100
            $table->char('huruf', 2)->nullable(); // A, B+, dst
            $table->timestamps();
        });

        // 5. Tabel Absensi
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('krs_id')->constrained('krs')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alpa']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_core_tables');
    }
};
