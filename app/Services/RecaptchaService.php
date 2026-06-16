<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RecaptchaService
{
    /**
     * Validasi token reCAPTCHA dengan Google API.
     *
     * @param string|null $token Token reCAPTCHA dari frontend
     * @return bool
     */
    public static function verify(?string $token): bool
    {
        if (empty($token)) {
            return false;
        }

        $secretKey = config('services.recaptcha.secret_key');

        // Jika secret key belum dikonfigurasi, skip validasi (dev mode)
        if (empty($secretKey) || $secretKey === 'YOUR_RECAPTCHA_SECRET_KEY') {
            return true;
        }

        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $secretKey,
                'response' => $token,
                'remoteip' => request()->ip(),
            ]);

            $body = $response->json();

            return $body['success'] ?? false;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('reCAPTCHA verification failed: ' . $e->getMessage());
            return false;
        }
    }
}
