<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'owner@gmail.com'],
            [
                'name' => 'Owner Peminjaman',
                'password' => Hash::make('12345'),
                'role' => User::ROLE_ADMIN,
                'email_verified_at' => now(),
            ]
        );

        // Tambah user role petugas
        User::updateOrCreate(
            ['email' => 'petugas@gmail.com'],
            [
                'name' => 'Petugas Konfirmasi',
                'password' => Hash::make('12345'),
                'role' => User::ROLE_PETUGAS,
                'email_verified_at' => now(),
            ]
        );
    }
}
