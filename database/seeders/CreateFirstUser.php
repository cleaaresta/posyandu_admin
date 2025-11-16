<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' =>  'Posyandu Admin',
            'email' => 'clearesrarahimah@gmail.com',
            'password' => Hash::make('posyanduadmin')
        ]);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 0925ae51d5b0851252d055c5eed7a66eeb6cd325
