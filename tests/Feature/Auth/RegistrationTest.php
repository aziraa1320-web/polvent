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
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'g-recaptcha-response' => 'mock-token',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('otp.verify'));

        $user = \App\Models\User::where('email', 'test@example.com')->first();
        $this->assertNotNull($user);
        $this->assertFalse($user->is_otp_verified);
        $this->assertNotNull($user->otp_code);

        $verifyResponse = $this->post('/otp/verify', [
            'otp' => $user->otp_code,
        ]);

        $verifyResponse->assertRedirect(route('login'));
        $this->assertTrue($user->fresh()->is_otp_verified);
    }
}
