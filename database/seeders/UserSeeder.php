<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@polvent.com',
            'password' => Hash::make('Admin123!'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Panitia Event',
            'email' => 'panitia@polvent.com',
            'password' => Hash::make('Panitia123!'),
            'role' => 'panitia',
        ]);

        User::create([
            'name' => 'Mahasiswa Polbeng',
            'email' => 'mahasiswa@polvent.com',
            'password' => Hash::make('Mahasiswa123!'),
            'role' => 'mahasiswa',
        ]);
    }
}