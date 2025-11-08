<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran; 
use App\Models\Anak; // <-- TAMBAHKAN INI
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    /**
     * Menampilkan halaman biodata user.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. PRIORITASKAN: Ambil pendaftaran yang sudah dikirim (bukan 'Pengisian Formulir')
        $pendaftaran = Pendaftaran::where('id_user', $user->id_user)
                                    ->where('status', '!=', 'Pengisian Formulir')
                                    ->with('anak')
                                    ->latest('tanggal_daftar') // Urutkan dari yg terbaru dikirim
                                    ->first();

        // 2. JIKA TIDAK ADA: Baru cari pendaftaran yang masih 'Pengisian Formulir'
        if (!$pendaftaran) {
            $pendaftaran = Pendaftaran::where('id_user', $user->id_user)
                                        ->where('status', 'Pengisian Formulir')
                                        ->with('anak')
                                        ->latest('created_at') // Ambil yg terbaru dibuat
                                        ->first();
        }

        // 3. Cek jika pendaftaran benar-benar tidak ada ATAU 
        //    data anaknya belum terisi (nama_lengkap masih NULL)
        //    Ini untuk menangani kasus 'anak' (ID 2) yang ada tapi datanya kosong.
        if (!$pendaftaran || !$pendaftaran->anak || !$pendaftaran->anak->nama_lengkap) {
            
            // Alihkan ke formulir untuk mengisi data
            return redirect()->route('user.formulir.step1')
                                 ->with('info', 'Anda belum memiliki biodata. Silakan isi formulir pendaftaran terlebih dahulu.');
        }

        // 4. Jika lolos, kirim data yang valid ke view
        return view('user.biodata', [
            'pendaftaran' => $pendaftaran,
            'anak' => $pendaftaran->anak
        ]);
    }
}
