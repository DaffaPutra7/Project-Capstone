<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB; // <-- PASTIKAN INI DITAMBAHKAN

class DataSiswaController extends Controller
{
    /**
     * Menampilkan daftar semua siswa yang telah mengirim formulir.
     */
    public function index(Request $request) // <-- Tambahkan Request
    {
        // 1. Ambil parameter 'sort' dari URL, default-nya 'terbaru'
        $sort = $request->query('sort', 'terbaru');

        // 2. Mulai Query Builder
        $query = Pendaftaran::where('pendaftaran.status', '!=', 'Pengisian Formulir')
            ->with('anak') // Eager load relasi anak
            ->join('anak', 'pendaftaran.id_pendaftaran', '=', 'anak.id_pendaftaran') // JOIN tabel anak
            ->select('pendaftaran.*'); // Pilih semua kolom dari pendaftaran (anak sudah di-load via 'with')

        // 3. Terapkan Sorting berdasarkan parameter 'sort'
        switch ($sort) {
            case 'nama_asc':
                // Urutkan berdasarkan nama anak A-Z
                $query->orderBy('anak.nama_lengkap', 'asc');
                break;

            case 'usia_syarat':
                // Urutkan berdasarkan status usia (Memenuhi Syarat dulu)
                // Kita replikasi logika accessor 'status_usia' di SQL
                // Syarat: Usia >= 4 TAHUN DAN <= 5 TAHUN
                // Note: CURDATE() adalah fungsi MySQL. Gunakan GETDATE() untuk SQL Server atau DATE('now') untuk SQLite.
                $query->orderByRaw(
                    "CASE 
                        WHEN TIMESTAMPDIFF(YEAR, anak.tanggal_lahir, CURDATE()) >= 4 
                         AND TIMESTAMPDIFF(YEAR, anak.tanggal_lahir, CURDATE()) <= 5 
                        THEN 1 
                        ELSE 2 
                     END ASC"
                )
                // Tambahkan urutan sekunder agar konsisten
                ->orderBy('anak.tanggal_lahir', 'desc'); 
                break;
            
            case 'terbaru':
            default:
                // Urutan default: berdasarkan tanggal daftar terbaru
                $query->orderBy('pendaftaran.tanggal_daftar', 'desc');
                break;
        }

        // 4. Ambil data dengan PAGINATION (misal: 10 per halaman)
        $pendaftaranSiswa = $query->paginate(10);

        // 5. Kirim data dan nilai 'sort' ke view
        return view('admin.siswa.index', [
            'pendaftaranSiswa' => $pendaftaranSiswa,
            'sort' => $sort // Kirim variabel sort ke view
        ]);
    }

    /**
     * Menampilkan detail satu siswa.
     */
    public function show($id_pendaftaran)
    {
        // 1. Ambil pendaftaran DAN data anaknya
        $pendaftaran = Pendaftaran::with('anak')->findOrFail($id_pendaftaran);
        
        // 2. Ekstrak data anak untuk dikirim ke view
        $anak = $pendaftaran->anak;

        // 3. Kirim kedua variabel ke view baru
        return view('admin.siswa.show', [
            'pendaftaran' => $pendaftaran,
            'anak' => $anak 
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
        return redirect()->back()->with('success', 'Status siswa berhasil diperbarui.');
    }
}
