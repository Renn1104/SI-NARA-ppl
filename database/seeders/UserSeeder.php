<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'sinara71',
            'password' => Hash::make('naragarden71'),
            'namalengkap' => 'SI-NARA',
            'email' => 'sinara@gmail.com',
            'role' => 'admin'
        ]);
    }

}
