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
        // 1. Ambil data pendaftaran
        $pendaftaranSiswaQuery = Pendaftaran::where('status', '!=', 'Pengisian Formulir')
            ->with('anak') // Eager loading tetap penting
            ->orderBy('tanggal_daftar', 'desc')
            ->get(); // Ambil datanya sebagai Collection

        // 2. Urutkan Collection berdasarkan status usia (dari Accessor)
        //    Kita gunakan sortBy agar 'Memenuhi Syarat' tampil di atas.
        $pendaftaranSiswa = $pendaftaranSiswaQuery->sortBy(function ($pendaftaran) {
            
            // Pengecekan jika relasi anak ada
            if (isset($pendaftaran->anak)) {
                // pendaftaran->anak->status_usia akan memanggil Accessor
                $statusUsia = $pendaftaran->anak->status_usia; 

                if ($statusUsia === 'Memenuhi Syarat') {
                    return 1; // Grup 1 (Paling atas)
                } elseif ($statusUsia === 'Tidak Memenuhi Syarat') {
                    return 2; // Grup 2 (Di bawahnya)
                } else {
                    return 3; // Grup 3 (N/A atau lainnya)
                }
            }
            return 4; // Fallback jika data anak tidak ada
        });


        // 3. Kirim data ke view
        return view('admin.siswa.index', [
            'pendaftaranSiswa' => $pendaftaranSiswa
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
