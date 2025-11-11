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
        $anakId = $this->route()->controller->getOrCreatePendaftaran()->anak->id_anak;

        return [
            'nama_lengkap' => 'required|string|max:100',
            'nama_panggilan' => 'nullable|string|max:50',
            'nik_anak' => ['required', 'string', 'digits:16', Rule::unique('anak', 'nik_anak')->ignore($anakId, 'id_anak')],
            'anak_ke' => 'nullable|integer|min:1',
            'nomor_akte' => 'nullable|string|max:100',
            'asal_sekolah' => 'nullable|string|max:100',
            'nisn' => 'nullable|string|max:20',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:30',
            'bahasa_sehari_hari' => 'required|string|max:50',
            'berat_badan' => 'required|numeric|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
            'golongan_darah' => ['required', Rule::in(['A', 'B', 'AB', 'O'])],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'kewarganegaraan' => ['required', Rule::in(['Indonesia', 'WNA'])],
            'alamat' => 'required|string',
            'riwayat_penyakit' => 'nullable|string',
            
            'foto_anak' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2048KB = 2MB
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
}