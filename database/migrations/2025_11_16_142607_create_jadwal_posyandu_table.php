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
            $table->bigIncrements('jadwal_id');
            
            // =================================================================
            // KODE PERBAIKAN DI SINI:
            // Kita akan mengganti 2 baris lama dengan 1 baris modern di bawah ini
            //
            // $table->unsignedBigInteger('posyandu_id'); // <-- GANTI BARIS INI
            // $table->foreign('posyandu_id')->...       // <-- GANTI BARIS INI
            
            // MENJADI INI:
            $table->foreignId('posyandu_id')
                  ->constrained('posyandu', 'posyandu_id') // (Tabel Induk, Kolom Induk)
                  ->onDelete('cascade');
            // =================================================================
            
            $table->date('tanggal');
            $table->string('tema', 255);
            $table->text('keterangan')->nullable();
            $table->string('poster')->nullable(); 
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