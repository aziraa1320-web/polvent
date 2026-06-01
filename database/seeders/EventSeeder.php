<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::create([
            'title' => 'Seminar Cyber Security',
            'description' => 'Seminar keamanan siber untuk mahasiswa Polbeng.',
            'event_date' => '2026-06-15',
            'quota' => 100,
            'poster' => null,
            'created_by' => 1,
        ]);

        Event::create([
            'title' => 'Workshop Laravel 13',
            'description' => 'Pelatihan pengembangan web menggunakan Laravel 13.',
            'event_date' => '2026-06-20',
            'quota' => 50,
            'poster' => null,
            'created_by' => 1,
        ]);

        Event::create([
            'title' => 'Kompetisi UI/UX',
            'description' => 'Kompetisi desain antarmuka tingkat kampus.',
            'event_date' => '2026-06-25',
            'quota' => 75,
            'poster' => null,
            'created_by' => 1,
        ]);
    }
}