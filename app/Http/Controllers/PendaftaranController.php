<?php
namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Pendaftaran;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDataAnakRequest;
use App\Http\Requests\StoreDataOrtuRequest;
use App\Http\Requests\StoreProgramRequest;

class PendaftaranController extends Controller
{
    /**
     * Helper function untuk mengambil atau membuat pendaftaran.
     * Ini adalah inti dari alur "simpan-dan-lanjutkan".
     */
    public function getOrCreatePendaftaran()
    {
        $user = Auth::user();
        $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->first();

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
                'progress_step' => 1, // <-- SET PROGRESS AWAL
            ]);
        }

        // 3. Pastikan record anak juga ada
        $anak = Anak::firstOrCreate(
            ['id_pendaftaran' => $pendaftaran->id_pendaftaran]
        );

        return $pendaftaran; // $pendaftaran sudah otomatis include $anak
    }

    // Helper function untuk Guard (Kunci)
    private function checkStatus($pendaftaran)
    {
        if ($pendaftaran->status !== 'Pengisian Formulir') {
            return redirect()->route('user.dashboard')->with('info', 'Anda sudah mengirim formulir. Data tidak dapat diubah.');
        }
        return null;
    }

    // === LANGKAH 1: DATA ANAK ===
    public function createStep1()
    {
        $pendaftaran = $this->getOrCreatePendaftaran();

        // Guard: Cek apakah formulir sudah dikirim
        $check = $this->checkStatus($pendaftaran);
        if ($check) return $check;

        return view('user.formulir-step-1', [
            'pendaftaran' => $pendaftaran,
            'anak' => $pendaftaran->anak
        ]);
    }

    public function storeStep1(StoreDataAnakRequest $request)
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
        
        // Guard: Cek lagi untuk mencegah double-submit
        $check = $this->checkStatus($pendaftaran);
        if ($check) return $check;

        $validatedData = $request->validated();
        $pendaftaran->anak->update($validatedData);

        // Update progress HANYA JIKA step saat ini 1
        if ($pendaftaran->progress_step < 2) {
             $pendaftaran->update(['progress_step' => 2]);
        }

        return redirect()->route('user.formulir.step2');
    }

    // === LANGKAH 2: DATA ORANG TUA ===
    public function createStep2()
    {
        $pendaftaran = $this->getOrCreatePendaftaran();

        // Guard: Cek apakah formulir sudah dikirim
        $check = $this->checkStatus($pendaftaran);
        if ($check) return $check;

        return view('user.formulir-step-2', [
            'pendaftaran' => $pendaftaran,
            'anak' => $pendaftaran->anak
        ]);
    }

    public function storeStep2(StoreDataOrtuRequest $request)
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
        
        // Guard: Cek lagi
        $check = $this->checkStatus($pendaftaran);
        if ($check) return $check;

        $validatedData = $request->validated();
        $pendaftaran->anak->update($validatedData);

        // Update progress HANYA JIKA step saat ini 2
        if ($pendaftaran->progress_step < 3) {
            $pendaftaran->update(['progress_step' => 3]);
        }

        return redirect()->route('user.formulir.step3');
    }

    // === LANGKAH 3: PROGRAM & SELESAI ===
    public function createStep3()
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
        
        // Guard: Cek apakah formulir sudah dikirim
        $check = $this->checkStatus($pendaftaran);
        if ($check) return $check;

        return view('user.formulir-step-3', [
            'pendaftaran' => $pendaftaran,
        ]);
    }

    public function storeFinal(StoreProgramRequest $request)
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
        
        // Guard: Cek lagi
        $check = $this->checkStatus($pendaftaran);
        if ($check) return $check;

        // Update data terakhir di tabel pendaftaran
        $pendaftaran->update([
            'jenis_program' => $request->jenis_program,
            'no_hp' => $request->no_hp,
            'tanggal_daftar' => now(),
            'status' => 'Formulir Dikirim', // <-- UBAH STATUS!
            'progress_step' => 4, // <-- Tandai sebagai selesai
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Pendaftaran berhasil dikirim!');
    }
}