<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoginHistory;
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
     * Handle login untuk Mahasiswa — verifikasi password lalu kirim OTP ke WA.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = $request->authenticate();

        if ($user->role !== 'mahasiswa') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Akun ini tidak memiliki akses ke portal login Mahasiswa.',
            ]);
        }

        // Jika sudah diverifikasi OTP sebelumnya, langsung login
        if ($user->is_otp_verified) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            LoginHistory::create([
                'user_id'    => $user->id,
                'email'      => $user->email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status'     => 'success',
            ]);

            return redirect()->route('dashboard');
        }

        // Cek nomor WA
        if (empty($user->phone)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Nomor WhatsApp belum terdaftar di akun ini. Hubungi admin.',
            ]);
        }

        // Generate OTP & kirim ke WA
        $user->generateOtp();
        $user->sendOtpWa();
        $user->incrementOtpResendCount();

        // Simpan data sesi OTP
        session([
            'otp_user_id'  => $user->id,
            'otp_role'     => 'mahasiswa',
            'otp_remember' => $request->boolean('remember'),
            'otp_context'  => 'login',
        ]);

        return redirect()->route('otp.verify');
    }

    /**
     * Handle login for Admin — no OTP, direct login after captcha.
     */
    public function storeAdmin(LoginRequest $request): RedirectResponse
    {
        $user = $request->authenticate();

        if ($user->role !== 'admin') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Akses ditolak. Anda bukan Admin.',
            ]);
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        LoginHistory::create([
            'user_id'    => $user->id,
            'email'      => $user->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status'     => 'success',
        ]);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Handle login untuk Panitia — verifikasi password lalu kirim OTP ke WA.
     */
    public function storePanitia(LoginRequest $request): RedirectResponse
    {
        $user = $request->authenticate();

        if ($user->role !== 'panitia') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Akses ditolak. Anda bukan Panitia.',
            ]);
        }

        // Jika sudah diverifikasi OTP sebelumnya, langsung login
        if ($user->is_otp_verified) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            LoginHistory::create([
                'user_id'    => $user->id,
                'email'      => $user->email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status'     => 'success',
            ]);

            return redirect()->route('panitia.dashboard');
        }

        // Cek nomor WA
        if (empty($user->phone)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Nomor WhatsApp belum terdaftar di akun ini. Hubungi admin.',
            ]);
        }

        // Generate OTP & kirim ke WA
        $user->generateOtp();
        $user->sendOtpWa();
        $user->incrementOtpResendCount();

        // Simpan data sesi OTP
        session([
            'otp_user_id'  => $user->id,
            'otp_role'     => 'panitia',
            'otp_remember' => $request->boolean('remember'),
            'otp_context'  => 'login',
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
