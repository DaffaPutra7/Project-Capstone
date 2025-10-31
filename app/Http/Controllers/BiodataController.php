<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran; 
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    /**
     * Menampilkan halaman biodata user.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Ambil data pendaftaran terakhir milik user ini
        // 'with('anak')' agar data anak ikut terambil 
        $pendaftaran = Pendaftaran::where('id_user', $user->id_user)
                                    ->with('anak')
                                    ->latest('created_at') // Ambil yg paling baru
                                    ->first();

        // 2. Cek jika user belum pernah daftar
        if (!$pendaftaran || !$pendaftaran->anak) {
            // Jika user belum pernah daftar SAMA SEKALI,
            // alihkan dia ke formulir langkah 1
            return redirect()->route('user.formulir.step1')
                             ->with('info', 'Anda belum memiliki biodata. Silakan isi formulir pendaftaran terlebih dahulu.');
        }

        // 3. Kirim data pendaftaran dan data anak ke view
        return view('user.biodata', [
            'pendaftaran' => $pendaftaran,
            'anak' => $pendaftaran->anak
        ]);
    }
}
