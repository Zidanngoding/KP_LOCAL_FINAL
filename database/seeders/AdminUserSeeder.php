<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Petugas
        User::create([
            'name' => 'Petugas 1',
            'email' => 'petugas@gmail.com',
            'username' => 'petugas',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
        ]);
    }
}