<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilTkController;
use App\Http\Controllers\PendaftaranController;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
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
        Route::get('/company', [ProfilTkController::class, 'index'])->name('company');

        // Route::view('/formulir', 'user.formulir')->name('formulir');
        Route::get('/formulir/data-anak', [PendaftaranController::class, 'createStep1'])->name('formulir.step1');
        Route::post('/formulir/data-anak', [PendaftaranController::class, 'storeStep1'])->name('formulir.step1.store');

        Route::get('/formulir/data-ortu', [PendaftaranController::class, 'createStep2'])->name('formulir.step2');
        Route::post('/formulir/data-ortu', [PendaftaranController::class, 'storeStep2'])->name('formulir.step2.store');

        Route::get('/formulir/program', [PendaftaranController::class, 'createStep3'])->name('formulir.step3');
        Route::post('/formulir/program', [PendaftaranController::class, 'storeFinal'])->name('formulir.store');
        
        Route::view('/biodata', 'user.biodata')->name('biodata');
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
        Route::view('/formulir', 'admin.formulir')->name('formulir');
        Route::view('/company', 'admin.company')->name('company');
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
