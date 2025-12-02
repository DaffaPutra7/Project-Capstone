<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class DataSiswaController extends Controller
{

    public function index(Request $request) 
    {
        $sort = $request->query('sort', 'terbaru');

        $query = Pendaftaran::where('pendaftaran.status', '!=', 'Pengisian Formulir')
            ->with('anak') 
            ->join('anak', 'pendaftaran.id_pendaftaran', '=', 'anak.id_pendaftaran')
            ->select('pendaftaran.*'); 

        switch ($sort) {
            case 'nama_asc':
                $query->orderBy('anak.nama_lengkap', 'asc');
                break;

            case 'usia_syarat':
                $query->orderByRaw(
                    "CASE 
                        WHEN TIMESTAMPDIFF(YEAR, anak.tanggal_lahir, CURDATE()) >= 4 
                         AND TIMESTAMPDIFF(YEAR, anak.tanggal_lahir, CURDATE()) <= 5 
                        THEN 1 
                        ELSE 2 
                     END ASC"
                )
                ->orderBy('anak.tanggal_lahir', 'desc'); 
                break;
            
            case 'terbaru':
            default:
                $query->orderBy('pendaftaran.tanggal_daftar', 'desc');
                break;
        }

        $pendaftaranSiswa = $query->paginate(10);

        return view('admin.siswa.index', [
            'pendaftaranSiswa' => $pendaftaranSiswa,
            'sort' => $sort 
        ]);
    }

    /**
     * Menampilkan detail satu siswa.
     */
    public function show($id_pendaftaran)
    {
        $pendaftaran = Pendaftaran::with('anak')->findOrFail($id_pendaftaran);
        
        $anak = $pendaftaran->anak;

        return view('admin.siswa.show', [
            'pendaftaran' => $pendaftaran,
            'anak' => $anak 
        ]);
    }

    /**
     * Mengupdate status pendaftaran siswa.
     */
    public function updateStatus(Request $request, $id_pendaftaran)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['Proses Seleksi', 'Diterima', 'Ditolak'])
            ]
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id_pendaftaran);

        $pendaftaran->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Status siswa berhasil diperbarui.');
    }
}
