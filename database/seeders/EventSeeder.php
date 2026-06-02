<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        $events = [
            [
                'title'       => 'Seminar Keamanan Siber 2025',
                'description' => 'Seminar nasional membahas ancaman keamanan siber terkini dan strategi perlindungan data digital di era modern. Dihadiri pembicara dari BSSN dan praktisi industri teknologi.',
                'event_date'  => now()->addDays(14),
                'quota'       => 100,
                'poster'      => null,
                'created_by'  => $admin->id,
            ],
            [
                'title'       => 'Workshop Laravel 13 & Keamanan Web',
                'description' => 'Workshop hands-on pengembangan aplikasi web menggunakan Laravel 13 dengan fokus pada implementasi keamanan: SQL Injection, XSS, CSRF, dan autentikasi modern.',
                'event_date'  => now()->addDays(21),
                'quota'       => 50,
                'poster'      => null,
                'created_by'  => $admin->id,
            ],
            [
                'title'       => 'Polbeng Creative Fest 2025',
                'description' => 'Festival kreativitas mahasiswa Polbeng menampilkan karya seni digital, desain grafis, fotografi, dan videografi. Terbuka untuk seluruh mahasiswa aktif Polbeng.',
                'event_date'  => now()->addDays(30),
                'quota'       => 200,
                'poster'      => null,
                'created_by'  => $admin->id,
            ],
            [
                'title'       => 'Olimpiade Matematika Polbeng',
                'description' => 'Kompetisi matematika tingkat politeknik yang mempertemukan mahasiswa terbaik dari seluruh jurusan. Hadiah uang tunai dan sertifikat nasional untuk 10 pemenang terbaik.',
                'event_date'  => now()->addDays(7),
                'quota'       => 80,
                'poster'      => null,
                'created_by'  => $admin->id,
            ],
            [
                'title'       => 'Pelatihan Public Speaking',
                'description' => 'Pelatihan intensif kemampuan berbicara di depan publik yang efektif dan percaya diri. Dipandu oleh trainer berpengalaman dari Toastmasters Indonesia chapter Pekanbaru.',
                'event_date'  => now()->addDays(10),
                'quota'       => 40,
                'poster'      => null,
                'created_by'  => $admin->id,
            ],
            [
                'title'       => 'Hackathon Polbeng 2025',
                'description' => 'Kompetisi programming 24 jam dengan tema Smart Campus Solution. Peserta berlomba membangun aplikasi inovatif yang dapat meningkatkan kualitas kehidupan kampus Polbeng.',
                'event_date'  => now()->addDays(45),
                'quota'       => 60,
                'poster'      => null,
                'created_by'  => $admin->id,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
