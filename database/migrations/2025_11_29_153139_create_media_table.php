<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');

            // Kunci Polimorfik (Menunjuk ke tabel mana file ini milik)
            $table->string('ref_table', 50);
            $table->unsignedBigInteger('ref_id');

            $table->string('file_url');
            $table->string('caption')->nullable();
            $table->string('mime_type', 50)->nullable();
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            // Index agar query media cepat
            $table->index(['ref_table', 'ref_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
