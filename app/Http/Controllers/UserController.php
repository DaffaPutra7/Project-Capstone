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
            $pendaftaran = Pendaftaran::where('id_user', $user->id_user)
                ->where('id_tahun', $tahunAktif->id_tahun)
                ->first();
        }

        return view('user.dashboard', [
            'pendaftaran' => $pendaftaran
        ]);
    }

    public function showCompanyProfile()
    {
        $profil = ProfilTk::with('foto')->first();

        if (!$profil) {
            $profil = new ProfilTk([
                'nama_tk' => 'Nama TK Belum Diatur',
                'visi' => 'Visi belum diatur.',
                'misi' => "Misi belum diatur.",
                'tujuan' => "Tujuan belum diatur."
            ]);
            $profil->foto = collect();
        }

        return view('user.company', ['profile' => $profil]);
    }
}
