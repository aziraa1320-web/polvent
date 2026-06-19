<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LoginHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    /**
     * Request an OTP for passwordless login.
     */
    public function requestOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'role'  => ['required', 'string', 'in:mahasiswa,admin,panitia'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || $user->role !== $request->role) {
            return back()->withErrors(['email' => 'Email tidak terdaftar atau tidak memiliki akses ke portal ini.']);
        }

        // Cek nomor HP / WA
        if (empty($user->phone)) {
            return back()->withErrors(['email' => 'Nomor WhatsApp belum terdaftar di akun ini. Hubungi admin.']);
        }

        // Cek rate limit kirim OTP
        if (! $user->canResendOtp()) {
            $minutesLeft = $user->otp_resend_locked_until
                ? $user->otp_resend_locked_until->diffInMinutes(now()) + 1
                : 15;

            return back()->withErrors([
                'email' => "Batas pengiriman OTP tercapai. Silakan coba lagi dalam {$minutesLeft} menit.",
            ]);
        }

        $user->generateOtp();
        $user->sendOtpWa();
        $user->incrementOtpResendCount();

        session([
            'otp_user_id' => $user->id,
            'otp_role'    => $user->role,
            'otp_remember'=> $request->boolean('remember'),
            'otp_context' => 'login',
        ]);

        return redirect()->route('otp.verify');
    }

    /**
     * Show the OTP verification view.
     */
    public function show(Request $request)
    {
        if (! $request->session()->has('otp_user_id')) {
            return redirect()->route('login');
        }

        $userId = $request->session()->get('otp_user_id');
        $user = User::find($userId);

        $canResend = $user ? $user->canResendOtp() : false;
        $resendCount = $user ? $user->otp_resend_count : 0;
        $lockedUntil = ($user && $user->otp_resend_locked_until && $user->otp_resend_locked_until->isFuture())
            ? $user->otp_resend_locked_until->toIso8601String()
            : null;

        return view('auth.otp-verify', compact('canResend', 'resendCount', 'lockedUntil'));
    }

    /**
     * Verify the OTP code.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'numeric', 'digits:6'],
        ]);

        if (! $request->session()->has('otp_user_id')) {
            return redirect()->route('login');
        }

        $userId = $request->session()->get('otp_user_id');
        $user = User::find($userId);

        if (! $user) {
            $request->session()->forget(['otp_user_id', 'otp_role', 'otp_remember', 'otp_context']);
            return redirect()->route('login')->withErrors(['email' => 'User tidak ditemukan.']);
        }

        // Validasi OTP — cek kode dan masa berlaku
        if ($user->otp_code !== $request->otp || $user->otp_expires_at < now()) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kadaluarsa.']);
        }

        $context = $request->session()->get('otp_context', 'login');

        // OTP valid — clear OTP fields & tandai terverifikasi
        $user->update([
            'otp_code'        => null,
            'otp_expires_at'  => null,
            'is_otp_verified' => true,
        ]);

        // Reset OTP resend counter
        $user->resetOtpResendCount();

        // Jika dari registrasi, aktifkan akun lalu redirect ke login
        if ($context === 'registration') {
            $request->session()->forget(['otp_user_id', 'otp_role', 'otp_remember', 'otp_context']);

            return redirect()->route('login')
                ->with('status', 'Akun berhasil diverifikasi! Silakan login dengan email dan password Anda.');
        }

        // Jika dari login — langsung login
        $remember = $request->session()->get('otp_remember', false);
        Auth::login($user, $remember);

        // Record successful login history
        LoginHistory::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'success',
        ]);

        // Clear session data
        $role = $request->session()->get('otp_role', 'mahasiswa');
        $request->session()->forget(['otp_user_id', 'otp_role', 'otp_remember', 'otp_context']);
        $request->session()->regenerate();

        // Redirect based on role
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'panitia' => redirect()->route('panitia.dashboard'),
            default => redirect()->route('mahasiswa.dashboard'),
        };
    }

    /**
     * Resend the OTP code — maks 3x dalam 15 menit.
     */
    public function resend(Request $request)
    {
        if (! $request->session()->has('otp_user_id')) {
            return redirect()->route('login');
        }

        $userId = $request->session()->get('otp_user_id');
        $user = User::find($userId);

        if (! $user) {
            return redirect()->route('login');
        }

        // Cek rate limit
        if (! $user->canResendOtp()) {
            $minutesLeft = $user->otp_resend_locked_until
                ? $user->otp_resend_locked_until->diffInMinutes(now()) + 1
                : 15;

            return back()->withErrors([
                'otp' => "Batas pengiriman OTP tercapai (3x). Silakan coba lagi dalam {$minutesLeft} menit.",
            ]);
        }

        $user->generateOtp();
        $user->sendOtpWa();
        $user->incrementOtpResendCount();

        return back()->with('status', 'Kode OTP baru telah dikirim ke WhatsApp Anda.');
    }
}
