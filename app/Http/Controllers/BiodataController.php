<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran; 
use App\Models\Anak;
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

        // 3. === LOGIKA BARU DI SINI ===
        // Cek jika pendaftaran (baik yang sudah dikirim atau belum) DITEMUKAN
        if ($pendaftaran) {
            
            // Jika ada, ambil data anaknya (mungkin datanya masih kosong, 
            // tapi view 'biodata.blade.php' sudah bisa menanganinya)
            $anak = $pendaftaran->anak;

        } else {
            
            // Jika TIDAK DITEMUKAN SAMA SEKALI (user baru, belum klik daftar)
            // Buat objek model kosong agar view tidak error
            $pendaftaran = new Pendaftaran();
            $anak = new Anak();
            
            // PENTING: Set status default agar tombol "Edit Data" muncul
            // di halaman biodata, sesuai permintaan Anda.
            $pendaftaran->status = 'Pengisian Formulir'; 
        }

        // 4. Kirim data (yang mungkin valid, atau mungkin kosong) ke view
        return view('user.biodata', [
            'pendaftaran' => $pendaftaran,
            'anak' => $anak
        ]);
    }
}
