<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Pertemuan
        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_id');
            $table->foreign('jadwal_id')->references('id')->on('jadwal_kuliahs')->onDelete('cascade');
            $table->integer('pertemuan_ke'); 
            $table->date('tanggal_pertemuan'); 
            $table->text('catatan_materi')->nullable(); 
            $table->timestamps();
        });

        // 2. Tabel Absensi (Dipindahkan ke sini agar aman)
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pertemuan_id');
            $table->foreign('pertemuan_id')->references('id')->on('pertemuans')->onDelete('cascade');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->enum('status_kehadiran', ['Hadir', 'Izin', 'Sakit', 'Alpha'])->default('Alpha');
            $table->string('keterangan')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // PERBAIKAN: Drop anak (absensis) dulu, baru drop induk (pertemuans)
        Schema::dropIfExists('absensis');
        Schema::dropIfExists('pertemuans');
    }
};