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
            $pendaftaran = null; // Default

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

    public function showCompanyProfile()
        {
            // Ambil data profil TK pertama dari database
            $profil = ProfilTk::first();

            // Kirim data ke view 'user.company'
            // Kita gunakan nama variabel 'profile' agar cocok dengan blade Anda
            return view('user.company', ['profile' => $profil]);
        }
}
