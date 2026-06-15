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
     * Handle login for Mahasiswa — no OTP, direct login after captcha.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = $request->authenticate();

        if ($user->role !== 'mahasiswa') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Akun ini tidak memiliki akses ke portal login Mahasiswa.',
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

        return redirect()->route('mahasiswa.dashboard');
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
     * Handle login for Panitia — no OTP, direct login after captcha.
     */
    public function storePanitia(LoginRequest $request): RedirectResponse
    {
        $user = $request->authenticate();

        if ($user->role !== 'panitia') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Akses ditolak. Anda bukan Panitia.',
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

        return redirect()->route('panitia.dashboard');
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
