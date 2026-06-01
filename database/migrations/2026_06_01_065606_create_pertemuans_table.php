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
        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel jadwal kuliah (pastikan nama tabel jadwalmu benar, misal: jadwal_kuliahs)
            $table->unsignedBigInteger('jadwal_id');
            $table->foreign('jadwal_id')->references('id')->on('jadwal_kuliahs')->onDelete('cascade');
            
            $table->integer('pertemuan_ke'); // Menyimpan urutan pertemuan: 1, 2, 3, dst.
            $table->date('tanggal_pertemuan'); // Menyimpan tanggal pertemuan dilakukan
            $table->text('catatan_materi')->nullable(); // Catatan dosen untuk pertemuan tersebut
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuans');
    }
};
