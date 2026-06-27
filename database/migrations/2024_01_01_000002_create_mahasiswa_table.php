<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel mahasiswa sesuai ERD: npm (PK), nidn (FK ke dosen sebagai
     * dosen wali/pembimbing), nama, created_at, updated_at.
     */
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->char('npm', 10)->primary();
            $table->char('nidn', 10)->nullable();
            $table->string('nama', 50);
            $table->timestamps();

            $table->foreign('nidn')->references('nidn')->on('dosen')
                ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
