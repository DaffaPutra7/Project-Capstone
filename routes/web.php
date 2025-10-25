<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilTkController;
use Illuminate\Support\Facades\Route;

// =======================
//      HALAMAN UTAMA
// =======================
Route::get('/', function () {
    return view('welcome');
});

// =======================
//      USER ROUTES
// =======================
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    Route::get('/company', [ProfilTkController::class, 'index'])->name('user.company');
    Route::get('/formulir', function () {
        return view('user.formulir');
    })->name('user.formulir');
    Route::get('/biodata', function () {
        return view('user.biodata');
    })->name('user.biodata');
});

// =======================
//      ADMIN ROUTES
// =======================
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/formulir', function () {
        return view('user.formulir');
    })->name('user.formulir');
    Route::get('/admin/company', function () {
        return view('admin.company');
    })->name('admin.company');
});

// =======================
//   PROFILE (SEMUA USER)
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
