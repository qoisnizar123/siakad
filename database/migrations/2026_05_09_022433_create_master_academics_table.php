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
        // Tabel Fakultas
        Schema::create('fakultas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fakultas');
            $table->timestamps();
        });

        // Tabel Program Studi
        Schema::create('prodis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fakultas_id')->constrained('fakultas')->onDelete('cascade');
            $table->string('nama_prodi');
            $table->timestamps();
        });

        // Tabel Ruangan
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ruangan');
            $table->integer('kapasitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_academics');
    }
};
