<?php

namespace App\Http\Controllers;

use App\Models\ProfilTk;
use App\Models\Pendaftaran;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->first();
        $pendaftaran = null;

        if ($tahunAktif) {
            // Cari pendaftaran user di tahun ajaran aktif
            $pendaftaran = Pendaftaran::where('id_user', $user->id_user)
                ->where('id_tahun', $tahunAktif->id_tahun)
                ->first();
        }

        // Kirim seluruh objek pendaftaran (atau null) ke view
        return view('user.dashboard', [
            'pendaftaran' => $pendaftaran
        ]);
    }

    /**
     * Method ini diubah untuk mengambil data foto
     */
    public function showCompanyProfile()
    {
        // Ambil data profil, beserta relasi 'foto'-nya
        $profil = ProfilTk::with('foto')->first();

        // Pengaman jika database/tabel profil_tk masih kosong
        if (!$profil) {
            $profil = new ProfilTk([
                'nama_tk' => 'Nama TK Belum Diatur',
                'visi' => 'Visi belum diatur.',
                'misi' => "Misi belum diatur.",
                'tujuan' => "Tujuan belum diatur."
            ]);
            // Buat koleksi kosong agar view tidak error saat di-loop
            $profil->foto = collect();
        }

        // Kirim data ke view 'user.company'
        // Variabel 'profile' sudah benar sesuai blade Anda
        return view('user.company', ['profile' => $profil]);
    }
}
