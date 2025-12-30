<?php

use App\Models\ProfilTk;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilTkController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\Admin\DataSiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Models\TahunAjaran;
use App\Models\Pendaftaran;
use App\Models\Guru;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $profil = ProfilTk::first();
    $tahunAktif = TahunAjaran::orderBy('tahun', 'desc')->first();

    // UBAH: Pakai orderBy asc supaya data baru tidak menggeser data lama ke kanan
    $guru = Guru::orderBy('created_at', 'asc')->get();

    $jumlahPendaftar = 0;
    $terisiReguler = 0;
    $terisiFullDay = 0;
    $sisaReguler = 0;
    $sisaFullDay = 0;

    if ($tahunAktif) {
        $kuotaReguler = $tahunAktif->kuota_reguler ?? 0;
        $kuotaFullDay = $tahunAktif->kuota_full_day ?? 0;

        $jumlahPendaftar = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
            ->whereNotIn('status', ['Pengisian Formulir', 'Ditolak'])
            ->count();

        $terisiReguler = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
            ->where('jenis_program', 'Reguler')
            ->whereNotIn('status', ['Pengisian Formulir', 'Ditolak'])
            ->count();

        $terisiFullDay = Pendaftaran::where('id_tahun', $tahunAktif->id_tahun)
            ->where('jenis_program', 'Full Day')
            ->whereNotIn('status', ['Pengisian Formulir', 'Ditolak'])
            ->count();

        $sisaReguler = max(0, $kuotaReguler - $terisiReguler);
        $sisaFullDay = max(0, $kuotaFullDay - $terisiFullDay);
    }

    return view('welcome', compact(
        'profil',
        'guru',
        'jumlahPendaftar',
        'sisaReguler',
        'terisiReguler',
        'sisaFullDay',
        'terisiFullDay'
    ));
})->name('home');

/*
|--------------------------------------------------------------------------
| LOGIN / AUTH ROUTES
|--------------------------------------------------------------------------
*/
if (!Route::has('login')) {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
}

/*
|--------------------------------------------------------------------------
| ROUTE UNTUK USER (role:user)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
        Route::get('/company', [UserController::class, 'showCompanyProfile'])->name('company');

        Route::get('/formulir/data-anak', [PendaftaranController::class, 'createStep1'])->name('formulir.step1');
        Route::post('/formulir/data-anak', [PendaftaranController::class, 'storeStep1'])->name('formulir.step1.store');

        Route::get('/formulir/data-ortu', [PendaftaranController::class, 'createStep2'])->name('formulir.step2');
        Route::post('/formulir/data-ortu', [PendaftaranController::class, 'storeStep2'])->name('formulir.step2.store');

        Route::get('/formulir/program', [PendaftaranController::class, 'createStep3'])->name('formulir.step3');
        Route::post('/formulir/program', [PendaftaranController::class, 'storeFinal'])->name('formulir.step3.store');

        Route::get('/biodata', [BiodataController::class, 'index'])->name('biodata');
    });

/*
|--------------------------------------------------------------------------
| ROUTE UNTUK ADMIN (role:admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // COMPANY / PROFIL
        Route::get('/company', [ProfilTkController::class, 'index'])->name('company');
        Route::post('/company/update', [ProfilTkController::class, 'update'])->name('profil.update');
        Route::delete('/company/foto/{id_foto}', [ProfilTkController::class, 'hapusFoto'])->name('profil.foto.hapus');

        // GURU
        Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
        Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
        Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
        Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
        Route::put('/guru/{id}', [GuruController::class, 'update'])->name('guru.update');
        Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');

        // SISWA
        Route::get('/siswa', [DataSiswaController::class, 'index'])->name('siswa.index');
        Route::get('/siswa/{id_pendaftaran}', [DataSiswaController::class, 'show'])->name('siswa.show');
        Route::post('/siswa/{id_pendaftaran}/update-status', [DataSiswaController::class, 'updateStatus'])->name('siswa.updateStatus');

        // TAHUN AJARAN
        Route::post('/tahun-ajaran/save', [\App\Http\Controllers\TahunAjaranController::class, 'storeOrUpdate'])
            ->name('tahun-ajaran.save');
    });

/*
|--------------------------------------------------------------------------
| PROFILE (SEMUA USER)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| FILE AUTH (REGISTER, LOGIN, LOGOUT DLL)
|--------------------------------------------------------------------------
*/
$authFile = __DIR__ . '/auth.php';
if (file_exists($authFile)) {
    require $authFile;
}
