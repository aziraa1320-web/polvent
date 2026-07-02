<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MasterMahasiswa;
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
     * Verifikasi NIM terhadap master_mahasiswa, auto-fill data mahasiswa,
     * lalu kirim OTP WA untuk aktivasi akun.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nim'      => ['required', 'string', 'max:20'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone'    => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 1. Verifikasi NIM ada di database master mahasiswa Polbeng
        $mahasiswa = MasterMahasiswa::where('nim', $request->nim)->first();

        if (! $mahasiswa) {
            throw ValidationException::withMessages([
                'nim' => 'NIM tidak terdaftar sebagai Mahasiswa Politeknik Negeri Bengkalis.',
            ]);
        }

        // 2. Cek apakah NIM sudah digunakan untuk membuat akun
        $nimUsed = User::where('nim', $request->nim)->exists();

        if ($nimUsed) {
            throw ValidationException::withMessages([
                'nim' => 'NIM sudah digunakan untuk membuat akun.',
            ]);
        }

        // 3. Buat akun dengan data dari master mahasiswa
        $user = User::create([
            'name'            => $mahasiswa->nama,
            'email'           => $request->email,
            'nim'             => $mahasiswa->nim,
            'phone'           => $request->phone,
            'jurusan'         => $mahasiswa->jurusan,
            'program_studi'   => $mahasiswa->program_studi,
            'angkatan'        => $mahasiswa->angkatan,
            'password'        => Hash::make($request->password),
            'role'            => 'mahasiswa',
            'is_otp_verified' => false,
        ]);

        // 4. Generate dan kirim OTP via WhatsApp
        $user->generateOtp();
        $user->sendOtpWa();

        // 5. Set session untuk proses OTP verifikasi
        session([
            'otp_user_id' => $user->id,
            'otp_role'    => 'mahasiswa',
            'otp_context' => 'registration',
        ]);

        return redirect()->route('otp.verify');
    }

    /**
     * Lookup data mahasiswa berdasarkan NIM (AJAX endpoint).
     * Digunakan untuk auto-fill form registrasi.
     */
    public function nimLookup(Request $request)
    {
        $request->validate([
            'nim' => ['required', 'string', 'max:20'],
        ]);

        // Cari di master mahasiswa
        $mahasiswa = MasterMahasiswa::where('nim', $request->nim)->first();

        if (! $mahasiswa) {
            return response()->json([
                'found' => false,
                'message' => 'NIM tidak terdaftar sebagai Mahasiswa Politeknik Negeri Bengkalis.',
            ], 404);
        }

        // Cek apakah NIM sudah dipakai
        $nimUsed = User::where('nim', $request->nim)->exists();

        if ($nimUsed) {
            return response()->json([
                'found' => false,
                'message' => 'NIM sudah digunakan untuk membuat akun.',
            ], 409);
        }

        return response()->json([
            'found'        => true,
            'nama'         => $mahasiswa->nama,
            'jurusan'      => $mahasiswa->jurusan,
            'program_studi'=> $mahasiswa->program_studi,
            'angkatan'     => $mahasiswa->angkatan,
        ]);
    }
}
