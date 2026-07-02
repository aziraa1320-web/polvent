<?php

namespace Database\Seeders;

use App\Models\MasterMahasiswa;
use Illuminate\Database\Seeder;

class MasterMahasiswaSeeder extends Seeder
{
    /**
     * Seed data master mahasiswa Politeknik Negeri Bengkalis.
     * Data asli aktif mahasiswa prodi Keamanan Sistem Informasi, D4.
     */
    public function run(): void
    {
        $mahasiswa = [
            ['nim' => '6404240002', 'nama' => 'ABDURROZIQ J. HASAN'],
            ['nim' => '6404240019', 'nama' => 'AKBAR MAULANA'],
            ['nim' => '6404240023', 'nama' => 'ANGGUN MARYYAMAH'],
            ['nim' => '6404240027', 'nama' => 'ANNISA NUR ROHMADHANI'],
            ['nim' => '6404240012', 'nama' => 'CAHYANI PUTRI SOFARI'],
            ['nim' => '6404240020', 'nama' => 'ELSA SYAFITRIANI'],
            ['nim' => '6404240016', 'nama' => 'FETTY RATNA DEWI'],
            ['nim' => '6404240007', 'nama' => 'HANDAL KARIS ARBI'],
            ['nim' => '6404240025', 'nama' => 'IRFAN ISWANDI'],
            ['nim' => '6404240008', 'nama' => 'M. ARIFIN ILHAM'],
            ['nim' => '6404240014', 'nama' => 'MASNIDAR AKMI'],
            ['nim' => '6404240028', 'nama' => 'MAZIRA'],
            ['nim' => '6404240017', 'nama' => 'MHD. AIDIL SYAHRON'],
            ['nim' => '6404240006', 'nama' => 'MUAMMAR FARHAN'],
            ['nim' => '6404240005', 'nama' => 'Markus Edison Silalahi'],
            ['nim' => '6404240022', 'nama' => 'NATASYA'],
            ['nim' => '6404240011', 'nama' => 'NUR LELA SABILA'],
            ['nim' => '6404240021', 'nama' => 'Nurvia Sulistry'],
            ['nim' => '6404240003', 'nama' => 'PUTRI NABILA'],
            ['nim' => '6404240009', 'nama' => 'Priska Liza Utami'],
            ['nim' => '6404240024', 'nama' => 'Revis Irwan Gea'],
            ['nim' => '6404240001', 'nama' => 'SYRLI RAHAYU'],
            ['nim' => '6404240013', 'nama' => 'Siti Aisyah'],
            ['nim' => '6404240010', 'nama' => 'WINDA NUR PERMATA'],
            ['nim' => '6404240018', 'nama' => 'Warda Widya Ningsih'],
            ['nim' => '6404240004', 'nama' => 'ZIDAN FAHREZY SYAFRIL'],
        ];

        // Format standar untuk D4 Keamanan Sistem Informasi
        $jurusan = 'Teknik Informatika';
        $program_studi = 'D-IV Keamanan Sistem Informasi';
        $angkatan = '2024';

        foreach ($mahasiswa as $mhs) {
            MasterMahasiswa::firstOrCreate(
                ['nim' => $mhs['nim']],
                [
                    'nama'          => $mhs['nama'],
                    'jurusan'       => $jurusan,
                    'program_studi' => $program_studi,
                    'angkatan'      => $angkatan,
                ]
            );
        }
    }
}
