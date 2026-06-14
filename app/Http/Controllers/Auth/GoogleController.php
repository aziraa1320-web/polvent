<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LoginHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(Request $request): RedirectResponse
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');

        if (empty($clientId) || empty($clientSecret)) {
            return redirect()->route('login')->withErrors([
                'email' => 'Sistem belum terkonfigurasi dengan Google. Silakan tambahkan GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET di file .env Anda.'
            ]);
        }

        if (!class_exists('Laravel\Socialite\Facades\Socialite')) {
            return redirect()->route('login')->withErrors([
                'email' => 'Paket laravel/socialite belum terinstal. Silakan jalankan composer require laravel/socialite.'
            ]);
        }

        try {
            return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors([
                'email' => 'Terjadi kesalahan saat menghubungi Google: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback(Request $request): RedirectResponse
    {
        if (!class_exists('Laravel\Socialite\Facades\Socialite')) {
            return redirect()->route('login')->withErrors(['email' => 'Socialite package is not installed.']);
        }

        try {
            $googleUser = \Laravel\Socialite\Facades\Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Gagal masuk menggunakan Google: ' . $e->getMessage()]);
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Register as a new student (mahasiswa)
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'role' => 'mahasiswa',
                'nim' => $this->generateRandomNim(),
                'password' => Hash::make(Str::random(24)),
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user);

        // Record history
        LoginHistory::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'success',
        ]);

        // Redirect based on role
        return $this->redirectForRole($user);
    }

    // Mock functions removed as per user request to only use real Google Auth.

    /**
     * Redirect user based on role.
     */
    private function redirectForRole(User $user): RedirectResponse
    {
        return match ($user->role) {
            'admin' => redirect()->intended(route('admin.dashboard')),
            'panitia' => redirect()->intended(route('panitia.dashboard')),
            default => redirect()->intended(route('dashboard')),
        };
    }

    /**
     * Generate a random mock NIM for students.
     */
    private function generateRandomNim(): string
    {
        return '5304' . rand(20, 26) . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
    }
}
