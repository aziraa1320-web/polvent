<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RecaptchaService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     * Setelah registrasi: buat OTP, kirim ke email, redirect ke halaman verifikasi OTP.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'g-recaptcha-response' => ['required', 'string'],
        ], [
            'g-recaptcha-response.required' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.',
        ]);

        // Validasi reCAPTCHA via Google API
        if (! RecaptchaService::verify($request->input('g-recaptcha-response'))) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.',
            ]);
        }

        $user = User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'is_otp_verified' => false,
        ]);

        // Generate OTP dan kirim ke email pengguna
        $user->generateOtp();
        $user->sendOtpMail();

        // Simpan user_id di session untuk verifikasi OTP
        session([
            'otp_user_id'     => $user->id,
            'otp_context'     => 'registration',
            'otp_role'        => 'mahasiswa',
        ]);

        return redirect()->route('otp.verify')
            ->with('status', 'Akun berhasil dibuat! Kode OTP telah dikirim ke email Anda. Silakan verifikasi.');
    }
}
