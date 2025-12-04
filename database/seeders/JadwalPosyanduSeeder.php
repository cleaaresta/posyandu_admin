<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalPosyandu;
use App\Models\Posyandu;
use Faker\Factory as Faker;

class JadwalPosyanduSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Ambil ID Posyandu yang ada
        $posyanduIds = Posyandu::pluck('posyandu_id')->toArray();

        if (empty($posyanduIds)) {
            $this->command->error('Error: Tabel Posyandu kosong. Jalankan PosyanduSeeder dulu.');
            return;
        }

        $temaList = [
            'Pemberian Vitamin A', 'Imunisasi Rutin', 
            'Penyuluhan Gizi Balita', 'Bulan Timbang', 
            'Pemeriksaan Ibu Hamil', 'Imunisasi BIAN'
        ];

        // LOOP 100 DATA
        foreach (range(1, 100) as $index) {
            JadwalPosyandu::create([
                'posyandu_id' => $faker->randomElement($posyanduIds),
                'tanggal'     => $faker->dateTimeBetween('-6 months', '+6 months'),
                'tema'        => $faker->randomElement($temaList),
                'keterangan'  => $faker->sentence(10), // Kalimat acak 10 kata
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}