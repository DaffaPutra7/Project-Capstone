<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\TahunAjaran;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Ambil tahun ajaran yang sedang aktif
        $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->first();

        $jumlahPendaftar = 0;

        if ($tahunAktif) {
            // 2. Hitung pendaftar di tahun aktif yang sudah submit
            $jumlahPendaftar = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
                                        ->where('status', '!=', 'Pengisian Formulir')
                                        ->count();
        }

        // 3. Kirim data ke view
        return view('admin.dashboard', [
            'jumlahPendaftar' => $jumlahPendaftar
            // Anda bisa tambahkan data lain di sini (misal: kuota)
        ]);
    }
}
