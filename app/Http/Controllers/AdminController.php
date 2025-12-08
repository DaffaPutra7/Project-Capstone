<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $semuaTahunDb = TahunAjaran::orderBy('tahun', 'desc')->get();

        $tahunSekarang = Carbon::now()->year;
        $opsiTahunBaru = [];
        
        for ($i = 0; $i < 4; $i++) {
            $start = $tahunSekarang + $i;
            $end = $start + 1;
            $stringTahun = $start . '/' . $end;
            $opsiTahunBaru[] = $stringTahun;
        }

        $gabunganTahun = $semuaTahunDb->pluck('tahun')->toArray();
        $semuaOpsiTahun = array_unique(array_merge($opsiTahunBaru, $gabunganTahun));
        rsort($semuaOpsiTahun); 

        $tahunPilihan = $request->query('tahun');
        
        if ($tahunPilihan) {
            $tahunAktif = TahunAjaran::where('tahun', $tahunPilihan)->first();
        } else {
            $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->first();
        }

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
            'semuaTahun' => $semuaTahunDb,
            'semuaOpsiTahun' => $semuaOpsiTahun,
            'tahunAktif' => $tahunAktif,
            'jumlahPendaftar' => $jumlahPendaftar,
            'sisaKuota' => $sisaKuota, 
            'pendaftaranSiswa' => $pendaftaranSiswa
        ]);
    }
}
