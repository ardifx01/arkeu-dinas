<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder; // ✅ ini yang benar
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Bendahara User',
            'email' => 'bendahara@example.com',
            'password' => Hash::make('password'),
            'role' => 'bendahara',
        ]);
    }
}
