<?php
// NAMA FILE: database/seeders/JadwalPosyanduSeeder.php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Pastikan ini ada

class JadwalPosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // PENTING: Ambil semua ID posyandu yang sudah ada di database
        $posyanduIds = DB::table('posyandu')->pluck('posyandu_id');

        // Jika tidak ada posyandu, hentikan seeder
        if ($posyanduIds->isEmpty()) {
            $this->command->warn('Tabel "posyandu" kosong. Jalankan PosyanduSeeder terlebih dahulu.');
            return;
        }

        foreach (range(1, 50) as $index) { // Buat 50 data jadwal acak
            DB::table('jadwal_posyandu')->insert([
                // Pilih ID posyandu secara acak dari data yang ada
                'posyandu_id' => $faker->randomElement($posyanduIds), 
                'tanggal' => $faker->dateTimeBetween('+1 week', '+3 months')->format('Y-m-d'),
                'tema' => $faker->sentence(4), // Tema jadwal (4 kata)
                'keterangan' => $faker->optional()->paragraph(1), // Kadang null, kadang tidak
                'poster' => null, // Kita biarkan null
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}