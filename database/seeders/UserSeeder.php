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
            'password' => '1234567890',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Administrator 2',
            'username' => 'admin2',
            'email' => 'admin2@proyek.com',
            'password' => '1234567890',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Administrator 3',
            'username' => 'admin3',
            'email' => 'admin3@proyek.com',
            'password' => '1234567890',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Linda Santika',
            'username' => 'Linda',
            'email' => 'user@proyek.com',
            'password' => '1234567890',
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Thoriq',
            'username' => 'Riq',
            'email' => 'user2@proyek.com',
            'password' => '1234567890',
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Muhammad',
            'username' => 'Muh',
            'email' => 'user3@proyek.com',
            'password' => '1234567890',
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Fadhli',
            'username' => 'Fad',
            'email' => 'user4@proyek.com',
            'password' => '1234567890',
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Cinut',
            'username' => 'Nut',
            'email' => 'user5@proyek.com',
            'password' => '1234567890',
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}