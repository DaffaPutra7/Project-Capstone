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
            'no_hp' => 'required|string|min:10|max:20',
            'jenis_program' => ['required', Rule::in(['Reguler', 'Full Day'])],
        ];
    }

    /**
     * Ubah nama atribut database menjadi nama yang enak dibaca user.
     */
    public function attributes(): array
    {
        return [
            'no_hp' => 'Nomor HP',
            'jenis_program' => 'Jenis Program',
        ];
    }

    /**
     * Kustomisasi pesan error.
     */
    public function messages(): array
    {
        return [
            'required' => 'Data :attribute wajib diisi.',
            'min' => 'Data :attribute minimal :min karakter.',
            'max' => 'Data :attribute maksimal :max karakter.',
        ];
    }
}