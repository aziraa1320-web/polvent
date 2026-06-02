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
            'event_id' => ['required', 'integer', 'exists:events,id'],
        ];
    }

    /**
     * Custom error messages in Indonesian.
     */
    public function messages(): array
    {
        return [
            'event_id.required' => 'Event tidak ditemukan.',
            'event_id.exists'   => 'Event tidak valid.',
        ];
    }
}
