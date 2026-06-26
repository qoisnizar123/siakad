<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Mata Kuliah
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk')->unique();
            $table->string('nama_mk');
            $table->integer('sks');
            $table->integer('semester');
            $table->enum('jenis_mk', ['Wajib', 'Pilihan'])->default('Wajib');
            $table->foreignId('prodi_id')->constrained('prodis');
            $table->timestamps();
        });

        // 2. Tabel Jadwal Kuliah
        Schema::create('jadwal_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
            $table->foreignId('dosen_id')->constrained('dosens');
            $table->foreignId('ruangan_id')->constrained('ruangans');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('semester');
            $table->string('status', 50)->default('Aktif');
            $table->timestamps();
        });

        // 3. Tabel KRS
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
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
            $table->integer('nilai_angka');
            $table->string('nilai_huruf', 2);
            $table->double('bobot', 4, 2);
            $table->string('status', 50);
            $table->timestamps();
        });
        
        // 5. Tabel KHS 
        Schema::create('khs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
            $table->integer('nilai_angka');
            $table->string('nilai_huruf', 2);
            $table->integer('semester');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // PERBAIKAN: Hapus tabel satu per satu dari urutan paling bawah
        Schema::dropIfExists('khs');
        Schema::dropIfExists('nilais');
        Schema::dropIfExists('krs');
        Schema::dropIfExists('jadwal_kuliahs');
        Schema::dropIfExists('mata_kuliahs');
    }
};