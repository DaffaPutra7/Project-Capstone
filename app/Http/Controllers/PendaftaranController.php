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
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PendaftaranController extends Controller
{
    public function getOrCreatePendaftaran()
    {
        $user = Auth::user();
        $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->first();

        $pendaftaran = Pendaftaran::where('id_user', $user->id_user)
            ->where('id_tahun', $tahunAktif->id_tahun)
            ->where('status', 'Pengisian Formulir')
            ->first();

        if (!$pendaftaran) {
            $pendaftaran = Pendaftaran::create([
                'id_user' => $user->id_user,
                'id_tahun' => $tahunAktif->id_tahun,
                'status' => 'Pengisian Formulir',
                'progress_step' => 1,
            ]);
        }

        $anak = Anak::firstOrCreate(
            ['id_pendaftaran' => $pendaftaran->id_pendaftaran]
        );

        return $pendaftaran;
    }

    private function checkStatus($pendaftaran)
    {
        if ($pendaftaran->status !== 'Pengisian Formulir') {
            return redirect()->route('user.dashboard')->with('info', 'Anda sudah mengirim formulir. Data tidak dapat diubah.');
        }
        return null;
    }

    public function createStep1()
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
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
        $check = $this->checkStatus($pendaftaran);
        if ($check) return $check;

        $validatedData = $request->validated();
        $anak = $pendaftaran->anak;

        if ($request->hasFile('foto_anak')) {
            if ($anak->foto_anak) {
                Storage::disk('public')->delete($anak->foto_anak);
            }

            $path = $request->file('foto_anak')->store('foto_anak', 'public');
            $validatedData['foto_anak'] = $path;
        }

        $anak->update($validatedData);

        if ($pendaftaran->progress_step < 2) {
            $pendaftaran->update(['progress_step' => 2]);
        }

        return redirect()->route('user.formulir.step2');
    }

    public function createStep2()
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
        $check = $this->checkStatus($pendaftaran);
        if ($check) return $check;

        if ($pendaftaran->progress_step < 2) {
            return redirect()->route('user.formulir.step1')
                ->with('error', 'Silakan lengkapi Data Anak terlebih dahulu.');
        }

        return view('user.formulir-step-2', [
            'pendaftaran' => $pendaftaran,
            'anak' => $pendaftaran->anak
        ]);
    }

    public function storeStep2(StoreDataOrtuRequest $request)
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
        $check = $this->checkStatus($pendaftaran);
        if ($check) return $check;

        $validatedData = $request->validated();
        $pendaftaran->anak->update($validatedData);

        if ($pendaftaran->progress_step < 3) {
            $pendaftaran->update(['progress_step' => 3]);
        }

        return redirect()->route('user.formulir.step3');
    }

    public function createStep3()
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
        $check = $this->checkStatus($pendaftaran);
        if ($check) return $check;

        if ($pendaftaran->progress_step < 3) {
            return redirect()->route('user.formulir.step2')
                ->with('error', 'Silakan lengkapi Data Orang Tua terlebih dahulu.');
        }

        $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->first();

        $limitReguler = $tahunAktif->kuota_reguler ?? 0;
        $limitFullDay = $tahunAktif->kuota_full_day ?? 0;

        $terisiReguler = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
            ->where('jenis_program', 'Reguler')
            ->whereNotIn('status', ['Pengisian Formulir', 'Ditolak'])
            ->count();

        $terisiFullDay = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
            ->where('jenis_program', 'Full Day')
            ->whereNotIn('status', ['Pengisian Formulir', 'Ditolak'])
            ->count();

        $sisaReguler = max(0, $limitReguler - $terisiReguler);
        $sisaFullDay = max(0, $limitFullDay - $terisiFullDay);

        return view('user.formulir-step-3', [
            'pendaftaran' => $pendaftaran,
            'sisaReguler' => $sisaReguler,
            'sisaFullDay' => $sisaFullDay,
            'isRegulerFull' => $sisaReguler <= 0,
            'isFullDayFull' => $sisaFullDay <= 0,
        ]);
    }

    public function storeFinal(StoreProgramRequest $request)
    {
        $pendaftaran = $this->getOrCreatePendaftaran();
        $check = $this->checkStatus($pendaftaran);
        if ($check) return $check;

        $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->first();
        
        $limit = ($request->jenis_program == 'Reguler') 
                    ? ($tahunAktif->kuota_reguler ?? 0) 
                    : ($tahunAktif->kuota_full_day ?? 0);
        
        $terisi = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
                    ->where('jenis_program', $request->jenis_program)
                    ->whereNotIn('status', ['Pengisian Formulir', 'Ditolak'])
                    ->count();

        if ($terisi >= $limit) {
            throw ValidationException::withMessages([
                'jenis_program' => "Mohon maaf, kuota untuk program {$request->jenis_program} baru saja penuh. Silakan pilih program lain."
            ]);
        }

        $pendaftaran->update([
            'jenis_program' => $request->jenis_program,
            'no_hp' => $request->no_hp,
            'tanggal_daftar' => now(),
            'status' => 'Formulir Dikirim',
            'progress_step' => 4,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Pendaftaran berhasil dikirim!');
    }
}