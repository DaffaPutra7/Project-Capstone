<?php
namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Pendaftaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDataAnakRequest;   // <-- Akan kita buat
use App\Http\Requests\StoreDataOrtuRequest;  // <-- Akan kita buat
use App\Http\Requests\StoreProgramRequest; // <-- Akan kita buat

class PendaftaranController extends Controller
{
    /**
     * Helper function untuk mengambil atau membuat pendaftaran.
     * Ini adalah inti dari alur "simpan-dan-lanjutkan".
     */
    public function getOrCreatePendaftaran()
    {
        $user = Auth::user();
        $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->first(); // Asumsi yg terbaru = aktif

        // 1. Cari pendaftaran yang 'Pengisian Formulir'
        $pendaftaran = Pendaftaran::where('id_user', $user->id_user)
            ->where('id_tahun', $tahunAktif->id_tahun)
            ->where('status', 'Pengisian Formulir')
            ->first();

        // 2. Jika tidak ada, buat baru
        if (!$pendaftaran) {
            $pendaftaran = Pendaftaran::create([
                'id_user' => $user->id_user,
                'id_tahun' => $tahunAktif->id_tahun,
                'status' => 'Pengisian Formulir',
            ]);
        }

        // 3. Pastikan record anak juga ada
        $anak = Anak::firstOrCreate(
            ['id_pendaftaran' => $pendaftaran->id_pendaftaran]
        );

        return $pendaftaran; // $pendaftaran sudah otomatis include $anak
    }

    // === LANGKAH 1: DATA ANAK ===
    public function createStep1()
    {
        // 1. Laravel OTOMATIS menjalankan authorize() dan rules() 
        //    dari StoreDataAnakRequest.
        
        // 2. Jika GAGAL, Laravel OTOMATIS me-redirect user kembali
        //    ke form dengan pesan error.

        // 3. Jika BERHASIL, baru kode di bawah ini dijalankan:
        $pendaftaran = $this->getOrCreatePendaftaran();

        // Redirect jika user sudah selesai isi form
        if($pendaftaran->status !== 'Pengisian Formulir') {
            return redirect()->route('user.dashboard')->with('info', 'Anda sudah mengirim formulir.');
        }

        return view('user.formulir-step-1', [ // Ganti nama view sesuai front-end
            'pendaftaran' => $pendaftaran,
            'anak' => $pendaftaran->anak // Kirim data anak
        ]);
    }

    public function storeStep1(StoreDataAnakRequest $request)
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
        $pendaftaran->anak->update($request->validated());

        return redirect()->route('user.formulir.step2'); // Lanjut ke langkah 2
    }

    // === LANGKAH 2: DATA ORANG TUA ===
    public function createStep2()
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
        return view('user.formulir-step-2', [ // Ganti nama view
            'pendaftaran' => $pendaftaran,
            'anak' => $pendaftaran->anak // Kirim data anak (yg sudah terisi data ortu)
        ]);
    }

    public function storeStep2(StoreDataOrtuRequest $request)
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
        $pendaftaran->anak->update($request->validated());

        return redirect()->route('user.formulir.step3'); // Lanjut ke langkah 3
    }

    // === LANGKAH 3: PROGRAM & SELESAI ===
    public function createStep3()
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
        return view('user.formulir-step-3', [ // Ganti nama view
            'pendaftaran' => $pendaftaran, // Kirim data pendaftaran
        ]);
    }

    public function storeFinal(StoreProgramRequest $request)
    {
        $pendaftaran = $this->getOrCreatePendaftaran();

        // Update data terakhir di tabel pendaftaran
        $pendaftaran->update([
            'jenis_program' => $request->jenis_program,
            'no_hp' => $request->no_hp,
            'tanggal_daftar' => now(),
            'status' => 'Formulir Dikirim' // <-- UBAH STATUS!
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Pendaftaran berhasil dikirim!');
    }
}