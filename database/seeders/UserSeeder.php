<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@proyek.com',
            'password' => '1234567890', // Akan di-hash otomatis karena cast
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'User Biasa',
            'username' => 'user',
            'email' => 'user@proyek.com',
            'password' => '1234567890', // Akan di-hash otomatis karena cast
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}