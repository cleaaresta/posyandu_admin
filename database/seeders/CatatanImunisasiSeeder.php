<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CatatanImunisasi;
use App\Models\Warga;
use Faker\Factory as Faker;

class CatatanImunisasiSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $wargaIds = Warga::pluck('warga_id')->toArray();

        if (empty($wargaIds)) {
            $this->command->error('Error: Data Warga kosong.');
            return;
        }

        $vaksinList = [
            'Hepatitis B', 'BCG', 'Polio 1', 'Polio 2', 
            'DPT-HB-Hib 1', 'DPT-HB-Hib 2', 'Campak', 'IPV'
        ];

        $lokasiList = ['Posyandu Melati', 'Puskesmas', 'Klinik Desa', 'RSUD'];

        // LOOP 100 DATA
        foreach (range(1, 100) as $index) {
            CatatanImunisasi::create([
                'warga_id'      => $faker->randomElement($wargaIds),
                'jenis_vaksin'  => $faker->randomElement($vaksinList),
                'tanggal'       => $faker->dateTimeBetween('-2 years', 'now'),
                'lokasi'        => $faker->randomElement($lokasiList),
                'nakes'         => 'Bidan ' . $faker->firstNameFemale,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}