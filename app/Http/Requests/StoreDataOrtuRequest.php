<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDataOrtuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        $pendidikan = ['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3', 'Tidak Sekolah'];

        return [
            'nama_ayah' => 'required|string|max:100',
            'tempat_lahir_ayah' => 'required|string|max:50',
            'tanggal_lahir_ayah' => 'required|date',
            'pendidikan_ayah' => ['required', Rule::in($pendidikan)],
            'pekerjaan_ayah' => 'required|string|max:100',

            'nama_ibu' => 'required|string|max:100', 
            'tempat_lahir_ibu' => 'required|string|max:50',
            'tanggal_lahir_ibu' => 'required|date',
            'pendidikan_ibu' => ['required', Rule::in($pendidikan)],
            'pekerjaan_ibu' => 'required|string|max:100',

            'nama_wali' => 'nullable|string|max:100',
            'pekerjaan_wali' => 'nullable|string|max:100',
        ];
    }

    /**
     * Ubah nama atribut database menjadi nama yang enak dibaca user.
     */
    public function attributes(): array
    {
        return [
            'nama_ayah' => 'Nama Ayah',
            'tempat_lahir_ayah' => 'Tempat Lahir Ayah',
            'tanggal_lahir_ayah' => 'Tanggal Lahir Ayah',
            'pendidikan_ayah' => 'Pendidikan Ayah',
            'pekerjaan_ayah' => 'Pekerjaan Ayah',
            
            'nama_ibu' => 'Nama Ibu',
            'tempat_lahir_ibu' => 'Tempat Lahir Ibu',
            'tanggal_lahir_ibu' => 'Tanggal Lahir Ibu',
            'pendidikan_ibu' => 'Pendidikan Ibu',
            'pekerjaan_ibu' => 'Pekerjaan Ibu',
            
            'nama_wali' => 'Nama Wali',
            'pekerjaan_wali' => 'Pekerjaan Wali',
        ];
    }

    /**
     * Kustomisasi pesan error.
     */
    public function messages(): array
    {
        return [
            'required' => 'Data :attribute wajib diisi.',
            'date' => 'Format :attribute tidak valid.',
            'max' => 'Data :attribute maksimal :max karakter.',
        ];
    }
}