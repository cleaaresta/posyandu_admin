<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        $roles = ['admin', 'guest']; 

        // Loop 100 kali
        foreach (range(1, 100) as $index) {
            DB::table('users')->insert([
                'name'              => $faker->name,
                'email'             => $faker->unique()->freeEmail, 
                'email_verified_at' => now(),
                'password'          => Hash::make('password'), 
                'role'              => $faker->randomElement($roles),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}