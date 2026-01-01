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

        $regexHuruf = 'regex:/^[a-zA-Z\s\.\,\'\-]+$/';

        return [
            'nama_lengkap' => ['required', 'string', 'max:100', $regexHuruf],
            'nama_panggilan' => ['required', 'string', 'max:50', $regexHuruf],
            'anak_ke' => 'required|integer|min:1|max:99',
            'nomor_akte' => 'required|string|max:100',
            'nik_anak' => ['required', 'string', 'digits:16', Rule::unique('anak', 'nik_anak')->ignore($anakId, 'id_anak')],

            'asal_sekolah' => 'nullable|string|max:100',
            'nisn' => 'nullable|string|max:20',
            'riwayat_penyakit' => 'nullable|string',

            'tempat_lahir' => ['required', 'string', 'max:50', $regexHuruf],
            'tanggal_lahir' => 'required|date|after_or_equal:1900-01-01|before_or_equal:today',
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
            'nama_lengkap' => 'Nama Lengkap',
            'nama_panggilan' => 'Nama Panggilan',
            'nik_anak' => 'NIK Anak',
            'anak_ke' => 'Anak ke',
            'nomor_akte' => 'Nomor Akta',
            'asal_sekolah' => 'Asal Sekolah',
            'nisn' => 'NISN',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'agama' => 'Agama',
            'bahasa_sehari_hari' => 'Bahasa Sehari-hari',
            'berat_badan' => 'Berat Badan',
            'tinggi_badan' => 'Tinggi Badan',
            'golongan_darah' => 'Golongan Darah',
            'jenis_kelamin' => 'Jenis Kelamin',
            'kewarganegaraan' => 'Kewarganegaraan',
            'alamat' => 'Alamat',
            'foto_anak' => 'Foto Anak',
            'riwayat_penyakit' => 'Riwayat Penyakit',
        ];
    }

    /**
     * Kustomisasi pesan error.
     */
    public function messages(): array
    {
        return [
            'required' => 'Data :attribute wajib diisi.',
            
            // Validasi Nama & Tempat
            'nama_lengkap.regex' => 'Nama Lengkap hanya boleh berisi huruf (tidak boleh angka).',
            'nama_panggilan.regex' => 'Nama Panggilan hanya boleh berisi huruf (tidak boleh angka).',
            'tempat_lahir.regex' => 'Tempat Lahir hanya boleh berisi huruf (tidak boleh angka).',

            // Validasi Tanggal
            'tanggal_lahir.after_or_equal' => 'Tanggal Lahir tidak valid (Minimal tahun 1900).',
            'tanggal_lahir.before_or_equal' => 'Tanggal Lahir tidak boleh melebihi hari ini.',

            'foto_anak.required' => 'Mohon unggah Foto Anak.',
            'nik_anak.digits' => 'NIK Anak harus berjumlah 16 digit.',
            'nik_anak.unique' => 'NIK Anak ini sudah terdaftar.',
            'numeric' => 'Data :attribute harus berupa angka.',
            'date' => 'Format :attribute tidak valid.',
            'image' => 'File :attribute harus berupa gambar.',
            'max' => 'Data :attribute tidak boleh lebih dari :max karakter/kilobyte.',
        ];
    }
}