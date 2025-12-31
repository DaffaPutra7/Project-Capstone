<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Anak;
use App\Models\User;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
                $query->orderByRaw("CASE WHEN TIMESTAMPDIFF(YEAR, anak.tanggal_lahir, CURDATE()) >= 4 AND TIMESTAMPDIFF(YEAR, anak.tanggal_lahir, CURDATE()) <= 5 THEN 1 ELSE 2 END ASC")
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

    public function show($id_pendaftaran)
    {
        $pendaftaran = Pendaftaran::with('anak')->findOrFail($id_pendaftaran);
        $anak = $pendaftaran->anak;

        return view('admin.siswa.show', [
            'pendaftaran' => $pendaftaran,
            'anak' => $anak
        ]);
    }

    public function updateStatus(Request $request, $id_pendaftaran)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['Proses Seleksi', 'Diterima', 'Ditolak'])]
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id_pendaftaran);
        $pendaftaran->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Status siswa berhasil diperbarui.');
    }

    public function create()
    {
        $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->first();

        $terisiReguler = 0;
        $terisiFullDay = 0;
        $sisaReguler = 0;
        $sisaFullDay = 0;
        $isRegulerFull = false;
        $isFullDayFull = false;

        if ($tahunAktif) {
            $terisiReguler = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
                ->where('jenis_program', 'Reguler')
                ->where('status', '!=', 'Ditolak')
                ->where('status', '!=', 'Pengisian Formulir')
                ->count();

            $terisiFullDay = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
                ->where('jenis_program', 'Full Day')
                ->where('status', '!=', 'Ditolak')
                ->where('status', '!=', 'Pengisian Formulir')
                ->count();

            $sisaReguler = max(0, $tahunAktif->kuota_reguler - $terisiReguler);
            $sisaFullDay = max(0, $tahunAktif->kuota_full_day - $terisiFullDay);

            $isRegulerFull = $sisaReguler <= 0;
            $isFullDayFull = $sisaFullDay <= 0;
        }

        return view('admin.pendaftaran.create', compact(
            'tahunAktif',
            'sisaReguler',
            'sisaFullDay',
            'isRegulerFull',
            'isFullDayFull'
        ));
    }

    public function store(Request $request)
    {
        // 1. Validasi Lengkap
        $pendidikan = ['SD', 'SMP', 'SMA', 'SMK', 'S1', 'S2', 'S3', 'Tidak Sekolah'];
        
        $regexHuruf = 'regex:/^[a-zA-Z\s\.\,\'\-]+$/';

        $request->validate([
            // --- DATA ANAK ---
            'nama_lengkap' => ['required', 'string', 'max:100', $regexHuruf],
            'nama_panggilan' => ['required', 'string', 'max:50', $regexHuruf],
            'nik_anak' => 'required|digits:16|unique:anak,nik_anak',
            'anak_ke' => 'required|integer|min:1|max:99',
            'nomor_akte' => 'required|string|max:100',
            'tempat_lahir' => ['required', 'string', 'max:50', $regexHuruf],
            'tanggal_lahir' => 'required|date|after_or_equal:1900-01-01|before_or_equal:today',
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'agama' => ['required', Rule::in(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'])],
            'kewarganegaraan' => ['required', Rule::in(['Indonesia', 'WNA'])],
            'alamat' => 'required|string',
            'bahasa_sehari_hari' => 'required|string|max:50',
            'berat_badan' => 'required|numeric|min:0|max:999',
            'tinggi_badan' => 'required|numeric|min:0|max:999',
            'golongan_darah' => ['required', Rule::in(['A', 'B', 'AB', 'O'])],
            
            'foto_anak' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'asal_sekolah' => 'nullable|string|max:100',
            'nisn' => 'nullable|string|max:20',
            'riwayat_penyakit' => 'nullable|string',

            // --- DATA ORTU (AYAH) ---
            'nama_ayah' => ['required', 'string', 'max:100', $regexHuruf],
            'tempat_lahir_ayah' => ['required', 'string', 'max:50', $regexHuruf],
            'tanggal_lahir_ayah' => 'required|date|after_or_equal:1900-01-01|before_or_equal:today',
            'pendidikan_ayah' => ['required', Rule::in($pendidikan)],
            'pekerjaan_ayah' => 'required|string|max:100',

            // --- DATA ORTU (IBU) ---
            'nama_ibu' => ['required', 'string', 'max:100', $regexHuruf],
            'tempat_lahir_ibu' => ['required', 'string', 'max:50', $regexHuruf],
            'tanggal_lahir_ibu' => 'required|date|after_or_equal:1900-01-01|before_or_equal:today',
            'pendidikan_ibu' => ['required', Rule::in($pendidikan)],
            'pekerjaan_ibu' => 'required|string|max:100',

            // --- DATA WALI (OPSIONAL) ---
            'nama_wali' => ['nullable', 'string', 'max:100', $regexHuruf],
            'pekerjaan_wali' => 'nullable|string|max:100',

            // --- PROGRAM & KONTAK ---
            'no_hp' => 'required|string|min:10|max:20',
            'jenis_program' => ['required', Rule::in(['Reguler', 'Full Day'])],
        ], [
            // Custom Messages
            'nama_lengkap.regex' => 'Nama Lengkap hanya boleh berisi huruf.',
            'nama_panggilan.regex' => 'Nama Panggilan hanya boleh berisi huruf.',
            'tempat_lahir.regex' => 'Tempat Lahir hanya boleh berisi huruf.',
            'nama_ayah.regex' => 'Nama Ayah hanya boleh berisi huruf.',
            'tempat_lahir_ayah.regex' => 'Tempat Lahir Ayah hanya boleh berisi huruf.',
            'nama_ibu.regex' => 'Nama Ibu hanya boleh berisi huruf.',
            'tempat_lahir_ibu.regex' => 'Tempat Lahir Ibu hanya boleh berisi huruf.',
            'nama_wali.regex' => 'Nama Wali hanya boleh berisi huruf.',
            
            'tanggal_lahir.after_or_equal' => 'Tanggal Lahir Anak tidak valid (Minimal tahun 1900).',
            'tanggal_lahir_ayah.after_or_equal' => 'Tanggal Lahir Ayah tidak valid (Minimal tahun 1900).',
            'tanggal_lahir_ibu.after_or_equal' => 'Tanggal Lahir Ibu tidak valid (Minimal tahun 1900).',
        ]);

        DB::beginTransaction();
        try {
            $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->firstOrFail();

            $pathFoto = null;
            if ($request->hasFile('foto_anak')) {
                $pathFoto = $request->file('foto_anak')->store('foto_anak', 'public');
            }

            // Menggunakan Auth::user()->id_user (Admin yang sedang login)
            $pendaftaran = Pendaftaran::create([
                'id_user' => Auth::user()->id_user,
                'id_tahun' => $tahunAktif->id_tahun,
                'jenis_program' => $request->jenis_program,
                'no_hp' => $request->no_hp,
                'tanggal_daftar' => now(),
                'status' => 'Proses Seleksi',
                'progress_step' => 4, 
                'tipe_daftar' => 'Offline',
            ]);

            Anak::create([
                'id_pendaftaran' => $pendaftaran->id_pendaftaran,
                
                // --- Data Anak ---
                'nama_lengkap' => $request->nama_lengkap,
                'nama_panggilan' => $request->nama_panggilan,
                'nik_anak' => $request->nik_anak,
                'anak_ke' => $request->anak_ke,
                'nomor_akte' => $request->nomor_akte,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'kewarganegaraan' => $request->kewarganegaraan,
                'alamat' => $request->alamat,
                'bahasa_sehari_hari' => $request->bahasa_sehari_hari,
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
                'golongan_darah' => $request->golongan_darah,
                'foto_anak' => $pathFoto,
                
                // Data Opsional Anak
                'asal_sekolah' => $request->asal_sekolah,
                'nisn' => $request->nisn,
                'riwayat_penyakit' => $request->riwayat_penyakit,

                // --- Data Ayah ---
                'nama_ayah' => $request->nama_ayah,
                'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
                'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,

                // --- Data Ibu ---
                'nama_ibu' => $request->nama_ibu,
                'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
                'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,

                // --- Data Wali ---
                'nama_wali' => $request->nama_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
            ]);

            DB::commit();

            return redirect()->route('admin.siswa.index')->with('success', 'Pendaftaran offline berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}