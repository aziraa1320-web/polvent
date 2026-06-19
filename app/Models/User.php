<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use App\Services\FonnteService;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nim',
        'phone',
        'jurusan',
        'program_studi',
        'angkatan',
        'profile_photo',
        'otp_code',
        'otp_expires_at',
        'is_otp_verified',
        'otp_resend_count',
        'otp_resend_locked_until',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at'      => 'datetime',
            'password'               => 'hashed',
            'otp_expires_at'         => 'datetime',
            'otp_resend_locked_until' => 'datetime',
            'is_otp_verified'        => 'boolean',
        ];
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is panitia.
     */
    public function isPanitia(): bool
    {
        return $this->role === 'panitia';
    }

    /**
     * Check if user is mahasiswa.
     */
    public function isMahasiswa(): bool
    {
        return $this->role === 'mahasiswa';
    }

    /**
     * Get the URL for the user's profile photo.
     */
    public function getProfilePhotoUrlAttribute(): ?string
    {
        if ($this->profile_photo) {
            return Storage::url($this->profile_photo);
        }
        return null;
    }

    /**
     * Relation: events created by this user.
     */
    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    /**
     * Relation: registrations by this user.
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Relation: activity logs by this user.
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    /**
     * Generate a new 6-digit OTP code and save it.
     * OTP berlaku 5 menit dan hanya dapat digunakan 1 kali.
     */
    public function generateOtp(): string
    {
        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $this->update([
            'otp_code'       => $code,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        return $code;
    }

    /**
     * Send OTP via WhatsApp menggunakan Fonnte API.
     * Return true jika berhasil, false jika gagal.
     */
    public function sendOtpWa(): bool
    {
        if (empty($this->phone)) {
            \Illuminate\Support\Facades\Log::warning("Gagal kirim OTP WA: user {$this->id} tidak punya nomor HP.");
            session()->flash('wa_error', 'Nomor WhatsApp belum terdaftar. Hubungi admin untuk memperbarui nomor Anda.');
            return false;
        }

        try {
            $fonnte = new FonnteService();
            $success = $fonnte->sendOtp($this->phone, $this->otp_code);

            if (! $success) {
                \Illuminate\Support\Facades\Log::error("Fonnte gagal kirim OTP ke nomor {$this->phone}");
                \Illuminate\Support\Facades\Log::info("DEBUG OTP CODE untuk {$this->email}: {$this->otp_code}");
                session()->flash('wa_error', 'Gagal mengirim OTP ke WhatsApp. Silakan coba kirim ulang.');
            }

            return $success;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Exception saat kirim OTP WA ke {$this->phone}: " . $e->getMessage());
            \Illuminate\Support\Facades\Log::info("DEBUG OTP CODE untuk {$this->email}: {$this->otp_code}");
            session()->flash('wa_error', 'Terjadi kesalahan saat mengirim OTP ke WhatsApp. Silakan coba lagi.');
            return false;
        }
    }

    /**
     * Send OTP via email (legacy — tidak dipakai di flow utama).
     */
    public function sendOtpMail(): void
    {
        try {
            \Illuminate\Support\Facades\Mail::to($this->email)->send(new \App\Mail\OtpMail($this->otp_code));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Gagal mengirim email OTP ke {$this->email}: " . $e->getMessage());
            \Illuminate\Support\Facades\Log::info("DEBUG OTP CODE untuk {$this->email}: {$this->otp_code}");
            session()->flash('mail_error', 'Gagal mengirim email OTP.');
        }
    }

    /**
     * Check apakah user bisa kirim ulang OTP (maks 3x dalam 15 menit).
     */
    public function canResendOtp(): bool
    {
        // Jika locked, cek apakah lockout sudah expired
        if ($this->otp_resend_locked_until && $this->otp_resend_locked_until->isFuture()) {
            return false;
        }

        // Reset counter jika lock sudah expired
        if ($this->otp_resend_locked_until && $this->otp_resend_locked_until->isPast()) {
            $this->update([
                'otp_resend_count'       => 0,
                'otp_resend_locked_until' => null,
            ]);
        }

        return $this->otp_resend_count < 3;
    }

    /**
     * Increment OTP resend counter dan lock jika sudah 3x.
     */
    public function incrementOtpResendCount(): void
    {
        $newCount = $this->otp_resend_count + 1;

        $this->update([
            'otp_resend_count'       => $newCount,
            'otp_resend_locked_until' => $newCount >= 3 ? now()->addMinutes(15) : null,
        ]);
    }

    /**
     * Reset OTP resend counter setelah OTP berhasil diverifikasi.
     */
    public function resetOtpResendCount(): void
    {
        $this->update([
            'otp_resend_count'       => 0,
            'otp_resend_locked_until' => null,
        ]);
    }
}
