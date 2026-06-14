<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    private function generateCaptcha()
    {
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);
        session(['captcha_answer' => $num1 + $num2]);
        session(['captcha_question' => "$num1 + $num2"]);
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        $this->generateCaptcha();
        return view('auth.login');
    }

    /**
     * Display the admin login view.
     */
    public function createAdmin(): View
    {
        $this->generateCaptcha();
        return view('auth.login-admin');
    }

    /**
     * Display the panitia login view.
     */
    public function createPanitia(): View
    {
        $this->generateCaptcha();
        return view('auth.login-panitia');
    }

    /**
     * Handle an incoming authentication request for Mahasiswa.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = $request->authenticate();

        if ($user->role !== 'mahasiswa') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Akun ini tidak memiliki akses ke portal login Mahasiswa.',
            ]);
        }

        // Generate and send OTP
        $user->generateOtp();
        $user->sendOtpMail();

        session([
            'otp_user_id' => $user->id,
            'otp_role' => $user->role,
            'otp_remember' => $request->boolean('remember'),
        ]);

        return redirect()->route('otp.verify');
    }

    /**
     * Handle an incoming authentication request for Admin.
     */
    public function storeAdmin(LoginRequest $request): RedirectResponse
    {
        $user = $request->authenticate();

        if ($user->role !== 'admin') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Akses ditolak. Anda bukan Admin.',
            ]);
        }

        // Generate and send OTP
        $user->generateOtp();
        $user->sendOtpMail();

        session([
            'otp_user_id' => $user->id,
            'otp_role' => $user->role,
            'otp_remember' => $request->boolean('remember'),
        ]);

        return redirect()->route('otp.verify');
    }

    /**
     * Handle an incoming authentication request for Panitia.
     */
    public function storePanitia(LoginRequest $request): RedirectResponse
    {
        $user = $request->authenticate();

        if ($user->role !== 'panitia') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Akses ditolak. Anda bukan Panitia.',
            ]);
        }

        // Generate and send OTP
        $user->generateOtp();
        $user->sendOtpMail();

        session([
            'otp_user_id' => $user->id,
            'otp_role' => $user->role,
            'otp_remember' => $request->boolean('remember'),
        ]);

        return redirect()->route('otp.verify');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
