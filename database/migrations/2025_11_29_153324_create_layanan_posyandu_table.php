<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan_posyandu', function (Blueprint $table) {
            $table->id('layanan_id');

            // Relasi ke Jadwal
            $table->foreignId('jadwal_id')
                ->constrained('jadwal_posyandu', 'jadwal_id')
                ->onDelete('cascade');

            // Relasi ke Warga (Peserta Posyandu)
            $table->foreignId('warga_id')
                ->constrained('warga', 'warga_id')
                ->onDelete('cascade');

            $table->float('berat')->nullable();
            $table->float('tinggi')->nullable();
            $table->string('vitamin', 100)->nullable();
            $table->text('konseling')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan_posyandu');
    }
};
