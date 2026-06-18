<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterEventRequest extends FormRequest
{
    /**
     * Only mahasiswa can register to events.
     */
    public function authorize(): bool
    {
        return $this->user()->isMahasiswa();
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [
            'event_id'      => ['required', 'integer', 'exists:events,id'],
            'nama_lengkap'  => ['required', 'string', 'max:255'],
            'nim'           => ['required', 'string', 'max:50'],
            'jurusan'       => ['required', 'string', 'max:255'],
            'program_studi' => ['required', 'string', 'max:255'],
            'angkatan'      => ['required', 'integer', 'min:2000', 'max:2100'],
        ];
    }

    /**
     * Custom error messages in Indonesian.
     */
    public function messages(): array
    {
        return [
            'event_id.required'      => 'Event tidak ditemukan.',
            'event_id.exists'        => 'Event tidak valid.',
            'nama_lengkap.required'  => 'Nama Lengkap wajib diisi.',
            'nim.required'           => 'NIM wajib diisi.',
            'jurusan.required'       => 'Jurusan wajib diisi.',
            'program_studi.required' => 'Program Studi wajib diisi.',
            'angkatan.required'      => 'Angkatan wajib diisi.',
            'angkatan.integer'       => 'Angkatan harus berupa angka.',
        ];
    }
}
