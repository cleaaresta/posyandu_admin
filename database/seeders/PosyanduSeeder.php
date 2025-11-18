<?php
// NAMA FILE: database/seeders/PosyanduSeeder.php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Pastikan ini ada

class PosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan \Faker\Factory::create() seperti contoh Anda
        // 'id_ID' digunakan agar data (seperti alamat) sesuai format Indonesia
        $faker = Factory::create('id_ID'); 

        foreach (range(1, 100) as $index) { // Kita akan buat 10 data Posyandu
            DB::table('posyandu')->insert([
                'nama' => 'Posyandu ' . $faker->lastName, // Cth: Posyandu Lestari
                'alamat' => $faker->address,
                'rt' => '00' . $faker->numberBetween(1, 9),
                'rw' => '00' . $faker->numberBetween(1, 5),
                'kontak' => $faker->phoneNumber,
                'foto' => null, // Kita biarkan null
                'created_at' => now(), // Kolom timestamps harus diisi manual
                'updated_at' => now(),  // jika menggunakan DB::insert()
            ]);
        }
    }
}