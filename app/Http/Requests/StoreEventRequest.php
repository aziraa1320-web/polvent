<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Only admin and panitia can create events.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin() || $this->user()->isPanitia();
    }

    /**
     * Validation rules — prevents XSS via server-side sanitization.
     */
    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'min:20', 'max:5000'],
            'event_date'  => [
                'required', 
                'date', 
                'after:now',
                function ($attribute, $value, $fail) {
                    $location = $this->input('location');
                    if ($location) {
                        $date = \Carbon\Carbon::parse($value)->toDateString();
                        $exists = \App\Models\Event::where('location', $location)
                                    ->whereDate('event_date', $date)
                                    ->exists();
                        if ($exists) {
                            $fail("Lokasi {$location} sudah penuh (telah dipesan) pada tanggal tersebut.");
                        }
                    }
                }
            ],
            'quota'       => ['required', 'integer', 'min:1', 'max:10000'],
            'location'    => ['nullable', 'string', 'in:Aula Teknik Informatika,Aula Bahasa,Aula ADM'],
            'organizer'   => ['nullable', 'string', 'max:255'],
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
            'event_date.after'     => 'Tanggal event harus di masa mendatang.',
            'quota.required'       => 'Kuota peserta wajib diisi.',
            'quota.min'            => 'Kuota minimal 1 orang.',
            'poster.image'         => 'File poster harus berupa gambar.',
            'poster.max'           => 'Ukuran poster maksimal 2MB.',
        ];
    }
}
