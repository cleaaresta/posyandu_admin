<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kader_posyandu', function (Blueprint $table) {
            $table->id('kader_id');

            $table->foreignId('posyandu_id')
                ->constrained('posyandu', 'posyandu_id')
                ->onDelete('cascade');

            $table->foreignId('warga_id')
                ->constrained('warga', 'warga_id')
                ->onDelete('cascade');

            $table->string('peran', 50);
            $table->date('mulai_tugas');
            $table->date('akhir_tugas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kader_posyandu');
    }
};
