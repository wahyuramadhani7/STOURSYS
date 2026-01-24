<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'adminsistemstoursys@gmail.com'],
            [
                'name'              => 'Admin Sistem STourSys',
                'email'             => 'adminsistemstoursys@gmail.com',
                'password'          => Hash::make('stoursys2026'),
                'email_verified_at' => now(), // langsung verified
                // Jika kamu punya kolom role/is_admin, tambahkan di sini, contoh:
                // 'role'           => 'admin',
                // 'is_admin'       => true,
            ]
        );
    }
}