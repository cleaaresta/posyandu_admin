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
        Schema::create('warga', function (Blueprint $table) {

            // Sesuai foto: warga_id, BIGINT(20), Unsigned, Auto Increment (PK)
            $table->id('warga_id');

            // Sesuai foto: no_ktp, VARCHAR(20)
            // Saya tambahkan ->unique() sesuai permintaan Anda sebelumnya
            $table->string('no_ktp', 20)->unique();

            // Sesuai foto: nama, VARCHAR(100)
            $table->string('nama', 100);

            // Sesuai foto: jenis_kelamin, ENUM('Laki-laki', 'Perempuan')
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);

            // Sesuai foto: agama, VARCHAR(50), Allow Null
            $table->string('agama', 50)->nullable();

            // Sesuai foto: pekerjaan, VARCHAR(100), Allow Null
            $table->string('pekerjaan', 100)->nullable();

            // Sesuai foto: telp, VARCHAR(20), Allow Null
            $table->string('telp', 20)->nullable();

            // Sesuai foto: email, VARCHAR(255), Allow Null
            $table->string('email', 255)->nullable();

            // Sesuai foto: created_at dan updated_at, TIMESTAMP, Allow Null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
