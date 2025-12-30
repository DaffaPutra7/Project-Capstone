<?php

namespace App\Http\Controllers;

use App\Models\ProfilTk;
use App\Models\Pendaftaran;
use App\Models\Guru;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil tahun ajaran terbaru untuk acuan kuota
        $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->first();
        $pendaftaran = null;

        if ($tahunAktif) {
            $pendaftaran = Pendaftaran::where('id_user', $user->id_user)
                ->where('id_tahun', $tahunAktif->id_tahun)
                ->first();
        }

        // PAKAI oldest() supaya data baru muncul di paling akhir (kanan/bawah)
        $guru = Guru::orderBy('created_at', 'asc')->get();

        // Inisialisasi variabel statistik
        $kuotaReguler = $tahunAktif->kuota_reguler ?? 0;
        $kuotaFullDay = $tahunAktif->kuota_full_day ?? 0;
        $terisiReguler = 0;
        $terisiFullDay = 0;

        if ($tahunAktif) {
            $terisiReguler = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
                ->where('jenis_program', 'Reguler')
                ->whereNotIn('status', ['Pengisian Formulir', 'Ditolak'])
                ->count();

            $terisiFullDay = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
                ->where('jenis_program', 'Full Day')
                ->whereNotIn('status', ['Pengisian Formulir', 'Ditolak'])
                ->count();
        }

        $sisaReguler = max(0, $kuotaReguler - $terisiReguler);
        $sisaFullDay = max(0, $kuotaFullDay - $terisiFullDay);

        // Langsung return ke dashboard user
        return view('user.dashboard', [
            'guru' => $guru,
            'pendaftaran' => $pendaftaran,
            'sisaReguler' => $sisaReguler,
            'sisaFullDay' => $sisaFullDay,
            'kuotaReguler' => $kuotaReguler,
            'kuotaFullDay' => $kuotaFullDay,
            'terisiReguler' => $terisiReguler,
            'terisiFullDay' => $terisiFullDay,
        ]);
    }

    public function showCompanyProfile()
    {
        $profil = ProfilTk::with('foto')->first();

        if (!$profil) {
            $profil = new ProfilTk([
                'nama_tk' => 'Nama TK Belum Diatur',
                'visi' => 'Visi belum diatur.',
                'misi' => 'Misi belum diatur.',
                'tujuan' => 'Tujuan belum diatur.'
            ]);
            $profil->foto = collect();
        }

        return view('user.company', ['profil' => $profil]);
    }
}
