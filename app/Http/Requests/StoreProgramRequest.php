<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 

class StoreProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Kontak
            'no_hp' => 'required|string|min:10|max:20',

            // Pilihan Program
            'jenis_program' => ['required', Rule::in(['Reguler', 'Full Day'])],
        ];
    }
}