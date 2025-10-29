<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // <-- Tambahkan ini

class StoreProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // <-- UBAH INI
    }

    public function rules(): array
    {
        return [
            // Kontak
            'no_hp' => 'required|string|min:10|max:20',

            // Pilihan Program
            'program' => ['required', Rule::in(['Reguler', 'Full Day'])],
        ];
    }
}