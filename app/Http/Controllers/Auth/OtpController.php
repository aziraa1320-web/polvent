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
            'role' => ['required', 'string', 'in:mahasiswa,admin,panitia'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || $user->role !== $request->role) {
            return back()->withErrors(['email' => 'Email tidak terdaftar atau tidak memiliki akses ke portal ini.']);
        }

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
     * Show the OTP verification view.
     */
    public function show(Request $request)
    {
        if (! $request->session()->has('otp_user_id')) {
            return redirect()->route('login');
        }

        return view('auth.otp-verify');
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
            $request->session()->forget(['otp_user_id', 'otp_role', 'otp_remember']);
            return redirect()->route('login')->withErrors(['email' => 'User tidak ditemukan.']);
        }

        if ($user->otp_code !== $request->otp || $user->otp_expires_at < now()) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kadaluarsa.']);
        }

        // OTP is valid, clear OTP fields
        $user->update([
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        // Log the user in
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
        $request->session()->forget(['otp_user_id', 'otp_role', 'otp_remember']);
        $request->session()->regenerate();

        // Redirect based on role
        return match ($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'panitia' => redirect()->route('panitia.dashboard'),
            default => redirect()->route('mahasiswa.dashboard'),
        };
    }

    /**
     * Resend the OTP code.
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

        $user->generateOtp();
        $user->sendOtpMail();

        return back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.');
    }
}
