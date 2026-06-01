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
            $table->integer('semester');
            $table->foreignId('prodi_id')->constrained('prodis');
            $table->timestamps();
        });

        // 2. Tabel Jadwal Kuliah (Pusat Relasi)
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
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade'); // Menggunakan mata_kuliah_id sesuai standardisasi lokal kita
            $table->integer('nilai_angka');
            $table->string('nilai_huruf', 2);
            $table->double('bobot', 4, 2);
            $table->string('status', 50); // Lulus, Perbaikan, Remedial
            $table->timestamps();
        });

        // 5. Tabel Absensi
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel pertemuans yang baru saja kita buat di atas
            $table->unsignedBigInteger('pertemuan_id');
            $table->foreign('pertemuan_id')->references('id')->on('pertemuans')->onDelete('cascade');
            
            // Relasi ke tabel mahasiswa (pastikan nama tabel mahasiswamu benar)
            $table->unsignedBigInteger('mahasiswa_id');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
            
            // Pilihan status absensi sesuai UI kelompokmu
            $table->enum('status_kehadiran', ['Hadir', 'Izin', 'Sakit', 'Alpha'])->default('Alpha');
            $table->string('keterangan')->nullable(); // Kolom teks untuk keterangan tambahan
            
            $table->timestamps();
        });
        
        // 6. Tabel KHS (Kartu Hasil Studi)
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_core_tables');
    }
};
