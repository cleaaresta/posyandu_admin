<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        foreach (range(1, 100) as $index) {
            DB::table('warga')->insert([
                'no_ktp'        => $faker->nik(), 
                'nama'          => $faker->name,
                
                // --- PERBAIKAN DI SINI ---
                // Harus 'Laki-laki' atau 'Perempuan' (sesuai migration)
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']), 
                // -------------------------

                'agama'         => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan'     => $faker->jobTitle,
                'telp'          => $faker->phoneNumber,
                'email'         => $faker->freeEmail,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}