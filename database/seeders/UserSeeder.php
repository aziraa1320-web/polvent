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
        // Admin
        User::create([
            'name'              => 'Administrator Polbeng',
            'email'             => 'admin@polbeng.ac.id',
            'password'          => Hash::make('password'),
            'role'              => 'admin',
            'nim'               => null,
            'email_verified_at' => now(),
        ]);

        // Panitia
        User::create([
            'name'              => 'Panitia Event Polbeng',
            'email'             => 'panitia@polbeng.ac.id',
            'password'          => Hash::make('password'),
            'role'              => 'panitia',
            'nim'               => null,
            'email_verified_at' => now(),
        ]);

        // Mahasiswa 1
        User::create([
            'name'              => 'Budi Santoso',
            'email'             => 'mahasiswa@polbeng.ac.id',
            'password'          => Hash::make('password'),
            'role'              => 'mahasiswa',
            'nim'               => '5304201001',
            'email_verified_at' => now(),
        ]);

        // Mahasiswa 2
        User::create([
            'name'              => 'Siti Rahayu',
            'email'             => 'siti@polbeng.ac.id',
            'password'          => Hash::make('password'),
            'role'              => 'mahasiswa',
            'nim'               => '5304201002',
            'email_verified_at' => now(),
        ]);

        // Mahasiswa 3
        User::create([
            'name'              => 'Ahmad Fauzi',
            'email'             => 'ahmad@polbeng.ac.id',
            'password'          => Hash::make('password'),
            'role'              => 'mahasiswa',
            'nim'               => '5304201003',
            'email_verified_at' => now(),
        ]);
    }
}
