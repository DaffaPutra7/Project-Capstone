<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilTkController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// =======================
//      USER ROUTES
// =======================
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    // Route::get('/company', function () {
    //     return view('user.company');
    // })->name('company');
    Route::get('/company', [ProfilTkController::class, 'index'])->name('company');
    Route::get('/formulir', function () {
        return view('user.formulir');
    })->name('formulir');
    Route::get('/biodata', function () {
        return view('user.biodata');
    })->name('biodata');
});

// =======================
//       ADMIN ROUTES
// =======================
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // lo bisa tambahin route admin lain di sini nanti
});

// =======================
//   PROFILE (semua user)
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
