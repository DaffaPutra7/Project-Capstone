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

        // Ambil pendaftaran yang sudah dikirim (bukan dalam tahap 'Pengisian Formulir')
        $pendaftaran = Pendaftaran::where('id_user', $user->id_user)
                                    ->where('status', '!=', 'Pengisian Formulir')
                                    ->with('anak')
                                    ->latest('tanggal_daftar')
                                    ->first();

        // Jika tidak ada: Baru cari pendaftaran yang masih di tahap 'Pengisian Formulir'
        if (!$pendaftaran) {
            $pendaftaran = Pendaftaran::where('id_user', $user->id_user)
                                        ->where('status', 'Pengisian Formulir')
                                        ->with('anak')
                                        ->latest('created_at') 
                                        ->first();
        }

        if ($pendaftaran) {
            

            $anak = $pendaftaran->anak;

        } else {
            
            $pendaftaran = new Pendaftaran();
            $anak = new Anak();
            
            $pendaftaran->status = 'Pengisian Formulir'; 
        }

        return view('user.biodata', [
            'pendaftaran' => $pendaftaran,
            'anak' => $anak
        ]);
    }
}
