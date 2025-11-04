<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DataSiswaController extends Controller
{
    /**
     * Menampilkan daftar semua siswa yang telah mengirim formulir.
     */
    public function index()
    {
        // 1. Ambil data pendaftaran yang statusnya BUKAN 'Pengisian Formulir'
        // 2. Gunakan ->with('anak') untuk eager loading (optimasi query)
        // 3. Urutkan berdasarkan tanggal daftar terbaru
        $pendaftaranSiswa = Pendaftaran::where('status', '!=', 'Pengisian Formulir')
            ->with('anak')
            ->orderBy('tanggal_daftar', 'desc')
            ->get();

        // 4. Kirim data ke view
        return view('admin.siswa.index', [
            'pendaftaranSiswa' => $pendaftaranSiswa
        ]);
    }

    /**
     * (Opsional - Untuk nanti)
     * Menampilkan detail satu siswa.
     */
    public function show($id_pendaftaran)
    {
        $pendaftaran = Pendaftaran::with('anak')->findOrFail($id_pendaftaran);

        return view('admin.siswa.show', [
            'pendaftaran' => $pendaftaran
        ]);
    }

    /**
     * Mengupdate status pendaftaran siswa.
     */
    public function updateStatus(Request $request, $id_pendaftaran)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['Proses Seleksi', 'Diterima', 'Ditolak'])
            ]
        ]);

        // 2. Cari pendaftaran
        $pendaftaran = Pendaftaran::findOrFail($id_pendaftaran);

        // 3. Update status
        $pendaftaran->update(['status' => $validated['status']]);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('admin.siswa.index')->with('success', 'Status siswa berhasil diperbarui.');
    }
}
