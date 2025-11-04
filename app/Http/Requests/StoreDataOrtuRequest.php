<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataOrtuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            // Data Ayah (disamakan dengan 'name' di HTML)
            'nama_ayah' => 'required|string|max:100',
            'tempat_lahir_ayah' => 'required|string|max:50',
            'tanggal_lahir_ayah' => 'required|date',
            'pendidikan_ayah' => 'required|string|max:50',
            'pekerjaan_ayah' => 'required|string|max:100',

            // Data Ibu (disamakan dengan 'name' di HTML)
            'nama_ibu' => 'required|string|max:100', 
            'tempat_lahir_ibu' => 'required|string|max:50',
            'tanggal_lahir_ibu' => 'required|date',
            'pendidikan_ibu' => 'required|string|max:50', 
            'pekerjaan_ibu' => 'required|string|max:100',

            // Data Wali
            'nama_wali' => 'nullable|string|max:100',
            'pekerjaan_wali' => 'nullable|string|max:100',
        ];
    }
}