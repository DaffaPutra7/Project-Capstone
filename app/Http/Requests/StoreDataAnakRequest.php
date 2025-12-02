<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDataAnakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $anak = $this->route()->controller->getOrCreatePendaftaran()->anak;
        $anakId = $anak->id_anak;

        $ruleFoto = $anak->foto_anak ? 'nullable' : 'required';

        return [
            'nama_lengkap' => 'required|string|max:100',
            'nama_panggilan' => 'required|string|max:50',
            'anak_ke' => 'required|integer|min:1|max:99',
            'nomor_akte' => 'required|string|max:100',
            'nik_anak' => ['required', 'string', 'digits:16', Rule::unique('anak', 'nik_anak')->ignore($anakId, 'id_anak')],

            'asal_sekolah' => 'nullable|string|max:100',
            'nisn' => 'nullable|string|max:20',
            'riwayat_penyakit' => 'nullable|string',

            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'agama' => ['required', Rule::in(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'])],
            'bahasa_sehari_hari' => 'required|string|max:50',
            'berat_badan' => 'required|numeric|min:0|max:999', 
            'tinggi_badan' => 'required|numeric|min:0|max:999',
            'golongan_darah' => ['required', Rule::in(['A', 'B', 'AB', 'O'])],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'kewarganegaraan' => ['required', Rule::in(['Indonesia', 'WNA'])],
            'alamat' => 'required|string',
            
            'foto_anak' => [$ruleFoto, 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], 
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_lengkap' => 'Nama lengkap',
            'nik_anak' => 'NIK anak',
            'tempat_lahir' => 'Tempat lahir',
            'tanggal_lahir' => 'Tanggal lahir',
            'berat_badan' => 'Berat badan',
            'tinggi_badan' => 'Tinggi badan',
            'foto_anak' => 'Foto anak', 
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Data ini wajib diisi.',
            
            'foto_anak.required' => 'Mohon unggah foto anak.',
            'nik_anak.digits' => 'NIK harus berjumlah 16 digit.',
            'nik_anak.unique' => 'NIK ini sudah terdaftar.',
            'numeric' => 'Kolom ini harus berupa angka.',
            'date' => 'Format tanggal tidak valid.',
        ];
    }
}