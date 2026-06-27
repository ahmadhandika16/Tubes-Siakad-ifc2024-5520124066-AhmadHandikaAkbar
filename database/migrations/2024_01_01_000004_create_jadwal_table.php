<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel jadwal sesuai ERD: id (PK auto increment), kode_matakuliah (FK),
     * nidn (FK), kelas, hari, jam.
     * Jadwal menentukan dosen pengajar, hari & jam, serta kelas untuk
     * sebuah mata kuliah (sesuai fitur Manajemen Jadwal pada Admin).
     */
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->char('kode_matakuliah', 8);
            $table->char('nidn', 10);
            $table->char('kelas', 1);
            $table->string('hari', 10);
            $table->time('jam');
            $table->timestamps();

            $table->foreign('kode_matakuliah')->references('kode_matakuliah')->on('matakuliah')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nidn')->references('nidn')->on('dosen')
                ->onUpdate('cascade')->onDelete('cascade');

            // Mencegah jadwal duplikat: 1 matkul + 1 kelas hanya 1 jadwal
            $table->unique(['kode_matakuliah', 'kelas']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
