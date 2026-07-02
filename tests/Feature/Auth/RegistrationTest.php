<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        // Seed data master mahasiswa untuk verifikasi NIM
        \App\Models\MasterMahasiswa::create([
            'nim'           => '6404240027',
            'nama'          => 'ANNISA NUR ROHMADHANI',
            'jurusan'       => 'Teknik Informatika',
            'program_studi' => 'D-IV Keamanan Sistem Informasi',
            'angkatan'      => '2024',
        ]);

        $response = $this->post('/register', [
            'nim'                   => '6404240027',
            'email'                 => 'annisa@example.com',
            'phone'                 => '081234567890',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('otp.verify'));

        $user = \App\Models\User::where('email', 'annisa@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('6404240027', $user->nim);
        $this->assertEquals('ANNISA NUR ROHMADHANI', $user->name);
        $this->assertEquals('Teknik Informatika', $user->jurusan);
        $this->assertEquals('D-IV Keamanan Sistem Informasi', $user->program_studi);
        $this->assertEquals('2024', $user->angkatan);
        $this->assertEquals('mahasiswa', $user->role);
        $this->assertFalse($user->is_otp_verified);
        $this->assertNotNull($user->otp_code);

        $verifyResponse = $this->post('/otp/verify', [
            'otp' => $user->otp_code,
        ]);

        $verifyResponse->assertRedirect(route('login'));
        $this->assertTrue($user->fresh()->is_otp_verified);
    }
}
