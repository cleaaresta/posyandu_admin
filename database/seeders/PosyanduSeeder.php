<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Posyandu;
use Faker\Factory as Faker;

class PosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID'); // Pakai locale Indonesia untuk alamat/no hp

        // Daftar nama Posyandu umum (Nama Bunga)
        $namaBunga = [
            'Mawar', 'Melati', 'Anggrek', 'Kenanga', 
            'Dahlia', 'Cempaka', 'Nusa Indah', 'Teratai',
            'Flamboyan', 'Bougenville'
        ];

        // Loop array nama bunga untuk membuat data
        foreach ($namaBunga as $nama) {
            Posyandu::create([
                'nama'   => 'Posyandu ' . $nama, // Contoh: Posyandu Mawar
                'alamat' => $faker->address,     // Alamat lengkap (Jln, Kota)
                'rt'     => sprintf('%03d', $faker->numberBetween(1, 15)), // Format 001 - 015
                'rw'     => sprintf('%03d', $faker->numberBetween(1, 10)), // Format 001 - 010
                'kontak' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}