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

        // Mahasiswa 1 (Menggunakan data asli dari MasterMahasiswaSeeder)
        User::create([
            'name'              => 'ABDURROZIQ J. HASAN',
            'email'             => 'abdurroziq@polbeng.ac.id',
            'password'          => Hash::make('password'),
            'role'              => 'mahasiswa',
            'nim'               => '6404240002',
            'jurusan'           => 'Teknik Informatika',
            'program_studi'     => 'D-IV Keamanan Sistem Informasi',
            'angkatan'          => '2024',
            'email_verified_at' => now(),
        ]);

        // Mahasiswa 2
        User::create([
            'name'              => 'AKBAR MAULANA',
            'email'             => 'akbar@polbeng.ac.id',
            'password'          => Hash::make('password'),
            'role'              => 'mahasiswa',
            'nim'               => '6404240019',
            'jurusan'           => 'Teknik Informatika',
            'program_studi'     => 'D-IV Keamanan Sistem Informasi',
            'angkatan'          => '2024',
            'email_verified_at' => now(),
        ]);

        // Mahasiswa 3
        User::create([
            'name'              => 'ANGGUN MARYYAMAH',
            'email'             => 'anggun@polbeng.ac.id',
            'password'          => Hash::make('password'),
            'role'              => 'mahasiswa',
            'nim'               => '6404240023',
            'jurusan'           => 'Teknik Informatika',
            'program_studi'     => 'D-IV Keamanan Sistem Informasi',
            'angkatan'          => '2024',
            'email_verified_at' => now(),
        ]);
    }
}
