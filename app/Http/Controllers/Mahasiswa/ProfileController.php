<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile edit form.
     */
    public function edit(Request $request)
    {
        return view('mahasiswa.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255', 'min:3'],
            'phone'         => ['nullable', 'string', 'max:15', 'regex:/^(\+62|62|0)[0-9]{8,13}$/'],
            'jurusan'       => ['nullable', 'string', 'max:255'],
            'program_studi' => ['nullable', 'string', 'max:255'],
            'angkatan'      => ['nullable', 'digits:4', 'integer', 'min:2000', 'max:' . (date('Y') + 1)],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ], [
            'name.required'      => 'Nama lengkap wajib diisi.',
            'name.min'           => 'Nama lengkap minimal 3 karakter.',
            'phone.regex'        => 'Format nomor HP tidak valid. Gunakan format 08xxxxxxx atau +628xxxxxxx.',
            'angkatan.digits'    => 'Angkatan harus berupa 4 digit tahun.',
            'angkatan.min'       => 'Angkatan tidak valid (minimal tahun 2000).',
            'angkatan.max'       => 'Angkatan tidak boleh melebihi tahun ' . (date('Y') + 1) . '.',
            'profile_photo.image'  => 'File harus berupa gambar.',
            'profile_photo.mimes'  => 'Format gambar harus JPEG, JPG, PNG, atau WEBP.',
            'profile_photo.max'    => 'Ukuran gambar maksimal 2MB.',
        ]);

        $user->fill([
            'name'          => $validated['name'],
            'phone'         => $validated['phone'] ?? null,
            'jurusan'       => $validated['jurusan'] ?? null,
            'program_studi' => $validated['program_studi'] ?? null,
            'angkatan'      => $validated['angkatan'] ?? null,
        ]);

        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui! 🎉');
    }
}
