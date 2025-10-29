<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // <-- Tambahkan ini

class StoreDataAnakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // <-- UBAH INI
    }

    public function rules(): array
    {
        // Ambil ID anak dari pendaftaran yang sedang diisi, untuk aturan 'unique'
        $anakId = $this->route()->controller->getOrCreatePendaftaran()->anak->id_anak;

        return [
            // Kunci array HARUS SAMA DENGAN atribut 'name' di HTML Anda
            'nama_lengkap' => 'required|string|max:100',
            'nama_panggilan' => 'nullable|string|max:50',
            'nik_anak' => ['required', 'string', 'digits:16', Rule::unique('anak', 'nik_anak')->ignore($anakId, 'id_anak')],
            'anak_ke' => 'nullable|integer|min:1',
            'berdasarkan_akte_kelahiran_no' => 'nullable|string|max:100',
            'asal_sekolah' => 'nullable|string|max:100',
            'nomor_nisn' => 'nullable|string|max:20',
            'penyakit_yang_pernah_diderita' => 'nullable|string',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'gender' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'agama' => 'required|string|max:30',
            'kewarganegaraan' => ['required', Rule::in(['Indonesia', 'WNA'])],
            'banyak_saudara_kandung' => 'nullable|integer|min:0',
            'banyak_saudara_tiri' => 'nullable|integer|min:0',
            'banyak_saudara_angkat' => 'nullable|integer|min:0',
            'bahasa_sehari_hari' => 'required|string|max:50',
            'berat_badan' => 'required|numeric|min:0',
            'tinggi_badan' => 'required|numeric|min:0',
            'golongan_darah' => 'required|string|max:5',
        ];
    }
}