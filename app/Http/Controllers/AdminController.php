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

        $jumlahPendaftar = 0;
        $sisaKuota = 0; 
        $pendaftaranSiswa = collect(); 

        if ($tahunAktif) {
            $totalKuota = ($tahunAktif->kuota_full_day ?? 0) + ($tahunAktif->kuota_reguler ?? 0);

            $jumlahPendaftar = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
                ->where('status', '!=', 'Pengisian Formulir')
                ->count();
            
            $sisaKuota = $totalKuota - $jumlahPendaftar;

            $pendaftaranSiswa = Pendaftaran::with('anak')
                ->where('id_tahun', $tahunAktif->id_tahun)
                ->where('status', '!=', 'Pengisian Formulir')
                ->latest()
                ->take(10)
                ->get();
        }

        return view('admin.dashboard', [
            'tahunAktif' => $tahunAktif,
            'jumlahPendaftar' => $jumlahPendaftar,
            'sisaKuota' => $sisaKuota, 
            'pendaftaranSiswa' => $pendaftaranSiswa
        ]);
    }
}
