<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            
        ]);

        // User
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'User2',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Pemda
        User::create([
            'name' => 'Pemda',
            'email' => 'pemda@example.com',
            'password' => Hash::make('password'),
            'role' => 'pemda',
        ]);

        User::create([
            'name' => 'Pemda2',
            'email' => 'pemda2@example.com',
            'password' => Hash::make('password'),
            'role' => 'pemda',
        ]);
    }
}
