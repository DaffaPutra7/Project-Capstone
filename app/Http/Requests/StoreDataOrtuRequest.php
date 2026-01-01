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
        $pendidikan = ['SD', 'SMP', 'SMA', 'SMK', 'S1', 'S2', 'S3', 'Tidak Sekolah'];
        
        $regexHuruf = 'regex:/^[a-zA-Z\s\.\,\'\-]+$/';

        return [
            // --- AYAH ---
            'nama_ayah' => ['required', 'string', 'max:100', $regexHuruf],
            'tempat_lahir_ayah' => ['required', 'string', 'max:50', $regexHuruf],
            'tanggal_lahir_ayah' => 'required|date|after_or_equal:1900-01-01|before_or_equal:today',
            'pendidikan_ayah' => ['required', Rule::in($pendidikan)],
            'pekerjaan_ayah' => 'required|string|max:100',

            // --- IBU ---
            'nama_ibu' => ['required', 'string', 'max:100', $regexHuruf], 
            'tempat_lahir_ibu' => ['required', 'string', 'max:50', $regexHuruf],
            'tanggal_lahir_ibu' => 'required|date|after_or_equal:1900-01-01|before_or_equal:today',
            'pendidikan_ibu' => ['required', Rule::in($pendidikan)],
            'pekerjaan_ibu' => 'required|string|max:100',

            // --- WALI ---
            'nama_wali' => ['nullable', 'string', 'max:100', $regexHuruf],
            'pekerjaan_wali' => 'nullable|string|max:100',
        ];
    }

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

    public function messages(): array
    {
        return [
            'required' => 'Data :attribute wajib diisi.',
            
            // Custom Messages Regex
            'nama_ayah.regex' => 'Nama Ayah hanya boleh berisi huruf (tidak boleh angka).',
            'tempat_lahir_ayah.regex' => 'Tempat Lahir Ayah hanya boleh berisi huruf (tidak boleh angka).',
            'nama_ibu.regex' => 'Nama Ibu hanya boleh berisi huruf (tidak boleh angka).',
            'tempat_lahir_ibu.regex' => 'Tempat Lahir Ibu hanya boleh berisi huruf (tidak boleh angka).',
            'nama_wali.regex' => 'Nama Wali hanya boleh berisi huruf (tidak boleh angka).',

            // Custom Messages Date
            'tanggal_lahir_ayah.after_or_equal' => 'Tanggal Lahir Ayah tidak valid (Minimal tahun 1900).',
            'tanggal_lahir_ayah.before_or_equal' => 'Tanggal Lahir Ayah tidak boleh melebihi hari ini.',
            'tanggal_lahir_ibu.after_or_equal' => 'Tanggal Lahir Ibu tidak valid (Minimal tahun 1900).',
            'tanggal_lahir_ibu.before_or_equal' => 'Tanggal Lahir Ibu tidak boleh melebihi hari ini.',

            'date' => 'Format :attribute tidak valid.',
            'max' => 'Data :attribute maksimal :max karakter.',
        ];
    }
}