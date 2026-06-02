<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Only admin can update events.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'min:20', 'max:5000'],
            'event_date'  => ['required', 'date'],
            'quota'       => ['required', 'integer', 'min:1', 'max:10000'],
            'poster'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    /**
     * Custom error messages in Indonesian.
     */
    public function messages(): array
    {
        return [
            'title.required'       => 'Judul event wajib diisi.',
            'title.min'            => 'Judul minimal 5 karakter.',
            'description.required' => 'Deskripsi event wajib diisi.',
            'description.min'      => 'Deskripsi minimal 20 karakter.',
            'event_date.required'  => 'Tanggal event wajib diisi.',
            'quota.required'       => 'Kuota peserta wajib diisi.',
            'quota.min'            => 'Kuota minimal 1 orang.',
            'poster.image'         => 'File poster harus berupa gambar.',
            'poster.max'           => 'Ukuran poster maksimal 2MB.',
        ];
    }
}
