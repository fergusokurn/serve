<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create petugas_koor user
        User::create([
            'name' => 'Petugas Koordinator',
            'email' => 'petugas@example.com',
            'password' => Hash::make('password'),
            'role' => 'petugas_koor',
            'email_verified_at' => now(),
        ]);
    }
}
