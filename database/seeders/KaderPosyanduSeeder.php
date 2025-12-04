<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Gunakan DB facade atau Model KaderPosyandu
use App\Models\Posyandu;
use App\Models\Warga;
use Faker\Factory as Faker;

class KaderPosyanduSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $posyanduIds = Posyandu::pluck('posyandu_id')->toArray();
        $wargaIds    = Warga::pluck('warga_id')->toArray();

        if (empty($posyanduIds) || empty($wargaIds)) {
            $this->command->error('Error: Data Posyandu atau Warga kosong.');
            return;
        }

        $peranList = ['Ketua', 'Sekretaris', 'Bendahara', 'Anggota', 'Kader Balita'];

        // LOOP 100 DATA
        foreach (range(1, 100) as $index) {
            
            $mulai = $faker->dateTimeBetween('-5 years', '-1 month');
            
            // Menggunakan DB insert agar lebih cepat, atau bisa pakai Model::create
            DB::table('kader_posyandu')->insert([
                'posyandu_id' => $faker->randomElement($posyanduIds),
                'warga_id'    => $faker->randomElement($wargaIds),
                'peran'       => $faker->randomElement($peranList),
                'mulai_tugas' => $mulai,
                // 30% kemungkinan sudah berhenti (ada tanggal akhir), 70% masih aktif (null)
                'akhir_tugas' => $faker->boolean(30) ? $faker->dateTimeBetween($mulai, 'now') : null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}