<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel dosen sesuai ERD: nidn (PK), nama, created_at, updated_at.
     */
    public function up(): void
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->char('nidn', 10)->primary();
            $table->string('nama', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
