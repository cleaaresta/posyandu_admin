<?php
// NAMA FILE: database/migrations/2025_11_16_142607_create_jadwal_posyandu_table.php

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
        Schema::create('jadwal_posyandu', function (Blueprint $table) {
            $table->id('jadwal_id'); // Primary Key

            // Foreign Key
            $table->foreignId('posyandu_id')
                ->constrained('posyandu', 'posyandu_id')
                ->onDelete('cascade');

            $table->date('tanggal');
            $table->string('tema', 255);
            $table->text('keterangan')->nullable();
            // Kolom 'poster' DIHAPUS karena pindah ke tabel media
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_posyandu');
    }
};
