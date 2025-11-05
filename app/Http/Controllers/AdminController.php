<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil tahun ajaran aktif (paling baru)
        $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->first();

        // Default value biar gak error kalau belum ada data
        $jumlahPendaftar = 0;
        $sisaKuota = 0; // Default sisa kuota
        $pendaftaranSiswa = collect(); // biar bisa di-loop walau kosong

        if ($tahunAktif) {
            // 1. Hitung TOTAL kuota dengan menjumlahkan keduanya
            $totalKuota = ($tahunAktif->kuota_full_day ?? 0) + ($tahunAktif->kuota_reguler ?? 0);

            // 2. Hitung jumlah pendaftar yang udah submit (bukan isi form doang)
            $jumlahPendaftar = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
                ->where('status', '!=', 'Pengisian Formulir')
                ->count();
            
            // 3. Hitung sisa kuota
            $sisaKuota = $totalKuota - $jumlahPendaftar;

            // Ambil data siswa yang udah daftar di tahun ajaran aktif
            $pendaftaranSiswa = Pendaftaran::with('anak')
                ->where('id_tahun', $tahunAktif->id_tahun)
                ->where('status', '!=', 'Pengisian Formulir')
                ->latest()
                ->take(10)
                ->get();
        }

        // 4. Kirim semua data ke view
        return view('admin.dashboard', [
            'tahunAktif' => $tahunAktif,
            'jumlahPendaftar' => $jumlahPendaftar,
            'sisaKuota' => $sisaKuota, // <-- Mengirim sisa kuota yang sudah dihitung
            'pendaftaranSiswa' => $pendaftaranSiswa
        ]);
    }
}
