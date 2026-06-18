<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\LoginHistory;
use App\Models\User;
use App\Services\RecaptchaService;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'g-recaptcha-response' => ['required', 'string'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'g-recaptcha-response.required' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.',
        ];
    }

    /**
     * Authenticate the request's credentials and return the user.
     *
     * @throws ValidationException
     */
    public function authenticate(): \App\Models\User
    {
        $this->ensureIsNotRateLimited();

        // Validasi reCAPTCHA via Google API
        if (! RecaptchaService::verify($this->input('g-recaptcha-response'))) {
            RateLimiter::hit($this->throttleKey());
            
            LoginHistory::create([
                'email'      => $this->input('email'),
                'ip_address' => $this->ip(),
                'user_agent' => $this->userAgent(),
                'status'     => 'failed',
            ]);

            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.',
            ]);
        }

        if (! Auth::validate($this->only('email', 'password'))) {
            RateLimiter::hit($this->throttleKey());

            LoginHistory::create([
                'email'      => $this->input('email'),
                'ip_address' => $this->ip(),
                'user_agent' => $this->userAgent(),
                'status'     => 'failed',
            ]);

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $user = User::where('email', $this->input('email'))->first();

        // Proses OTP khusus untuk Mahasiswa pada saat login jika akun belum diverifikasi
        if ($user && $user->role === 'mahasiswa' && !$user->is_otp_verified) {
            session([
                'otp_user_id'  => $user->id,
                'otp_context'  => 'login',
                'otp_role'     => $user->role,
                'otp_remember' => $this->boolean('remember'),
            ]);

            // OTP hanya dikirim satu kali pada proses login (menggunakan pembatasan resend count)
            // Jika butuh dikirim lagi, mereka bisa tekan tombol Kirim Ulang di halaman verifikasi
            if ($user->canResendOtp()) {
                $user->generateOtp();
                $user->sendOtpMail();
                $user->incrementOtpResendCount();
                $message = 'Kode OTP telah dikirim ke email Anda. Silakan masukkan kode OTP untuk memverifikasi akun Anda.';
            } else {
                $message = 'Batas pengiriman OTP otomatis tercapai. Silakan masukkan kode OTP Anda atau tunggu untuk bisa kirim ulang.';
            }

            throw new \Illuminate\Http\Exceptions\HttpResponseException(
                redirect()->route('otp.verify')->with('status', $message)
            );
        }

        RateLimiter::clear($this->throttleKey());

        return $user;
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
