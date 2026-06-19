<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected string $token;
    protected string $apiUrl;

    public function __construct()
    {
        $this->token  = config('services.fonnte.token', '');
        $this->apiUrl = config('services.fonnte.url', 'https://api.fonnte.com/send');
    }

    /**
     * Kirim pesan OTP ke nomor WhatsApp.
     *
     * @param  string  $phone  Nomor WA tujuan (08xxx atau 628xxx)
     * @param  string  $code   Kode OTP 6 digit
     * @return bool
     */
    public function sendOtp(string $phone, string $code): bool
    {
        $phone = $this->normalizePhone($phone);

        $message = "🔐 *POLVENT - Kode OTP*\n\n"
                 . "Kode verifikasi Anda:\n\n"
                 . "*{$code}*\n\n"
                 . "Kode berlaku selama *5 menit*.\n"
                 . "Jangan bagikan kode ini kepada siapapun.\n\n"
                 . "_— Tim POLVENT_";

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->asForm()->post($this->apiUrl, [
                'target'  => $phone,
                'message' => $message,
            ]);

            $body = $response->json();

            if ($response->successful() && isset($body['status']) && $body['status'] === true) {
                Log::info("OTP WA berhasil dikirim ke {$phone}");
                return true;
            }

            Log::warning("Fonnte response tidak sukses ke {$phone}: " . json_encode($body));
            return false;

        } catch (\Exception $e) {
            Log::error("Gagal mengirim OTP WA ke {$phone}: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Normalisasi format nomor telepon ke format internasional (tanpa +).
     * 08xxx  → 628xxx
     * +628xx → 628xxx
     * 628xxx → 628xxx (tidak berubah)
     */
    public function normalizePhone(string $phone): string
    {
        // Hapus semua karakter non-digit
        $phone = preg_replace('/\D/', '', $phone);

        // Jika dimulai dengan 0, ganti dengan 62
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        // Jika belum dimulai dengan 62, tambahkan 62
        if (! str_starts_with($phone, '62')) {
            $phone = '62' . $phone;
        }

        return $phone;
    }
}
