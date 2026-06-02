<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EventSeeder::class,
        ]);

        // Create sample registrations for demo
        $this->createSampleRegistrations();
    }

    /**
     * Create sample registration data for demonstration.
     */
    private function createSampleRegistrations(): void
    {
        $mahasiswaIds = \App\Models\User::where('role', 'mahasiswa')->pluck('id');
        $eventIds     = \App\Models\Event::pluck('id');
        $statuses     = ['pending', 'approved', 'rejected'];

        foreach ($mahasiswaIds as $userId) {
            $sampleEvents = $eventIds->random(min(3, $eventIds->count()));
            foreach ($sampleEvents as $eventId) {
                Registration::firstOrCreate(
                    ['user_id' => $userId, 'event_id' => $eventId],
                    ['status'  => $statuses[array_rand($statuses)]]
                );
            }
        }
    }
}
