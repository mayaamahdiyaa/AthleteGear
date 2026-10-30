<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Membuat akun default untuk admin dan athlete.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@athletegear.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'athlete@athletegear.test'],
            [
                'name' => 'Atlet',
                'password' => Hash::make('password'),
                'role' => 'athlete',
                'email_verified_at' => now(),
            ]
        );
    }
}
