<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat 1 Akun Admin Utama untuk Portal
        User::updateOrCreate(
            ['email' => 'adminportal@rb.com'],
            [
                'name' => 'Admin Portal',
                'password' => Hash::make('password123'), // Silakan ganti passwordnya sesuai selera
            ]
        );
    }
}