<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel krs (Kartu Rencana Studi) sesuai ERD: id (PK auto increment),
     * npm (FK ke mahasiswa), kode_matakuliah (FK ke matakuliah).
     * Relasi many-to-many antara mahasiswa & matakuliah melalui tabel ini.
     */
    public function up(): void
    {
        Schema::create('krs', function (Blueprint $table) {
            $table->id();
            $table->char('npm', 10);
            $table->char('kode_matakuliah', 8);
            $table->string('semester', 20)->default('Ganjil 2025/2026');
            $table->timestamps();

            $table->foreign('npm')->references('npm')->on('mahasiswa')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kode_matakuliah')->references('kode_matakuliah')->on('matakuliah')
                ->onUpdate('cascade')->onDelete('cascade');

            // Mencegah mahasiswa mengambil matkul yang sama 2x di semester yang sama
            $table->unique(['npm', 'kode_matakuliah', 'semester']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
