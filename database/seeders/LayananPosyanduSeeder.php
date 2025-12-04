<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LayananPosyandu;
use App\Models\Warga;
use App\Models\JadwalPosyandu;
use Faker\Factory as Faker;

class LayananPosyanduSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Ambil ID Jadwal dan Warga
        $jadwalIds = JadwalPosyandu::pluck('jadwal_id')->toArray();
        $wargaIds  = Warga::pluck('warga_id')->toArray();

        if (empty($jadwalIds) || empty($wargaIds)) {
            $this->command->error('Error: Data Jadwal atau Warga kosong.');
            return;
        }

        $vitaminList = ['Vitamin A Merah', 'Vitamin A Biru', 'Obat Cacing', '-'];

        // LOOP 100 DATA
        foreach (range(1, 100) as $index) {
            LayananPosyandu::create([
                'jadwal_id' => $faker->randomElement($jadwalIds),
                'warga_id'  => $faker->randomElement($wargaIds),
                'berat'     => $faker->randomFloat(1, 3, 25), // 3.0 - 25.0 kg
                'tinggi'    => $faker->numberBetween(45, 110), // 45 - 110 cm
                'vitamin'   => $faker->randomElement($vitaminList),
                'konseling' => $faker->randomElement([
                    'Tumbuh kembang baik', 
                    'Berat badan kurang, tingkatkan ASI/MPASI', 
                    'Sehat, imunisasi lengkap'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}