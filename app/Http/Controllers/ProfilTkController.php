<?php

namespace App\Http\Controllers;

use App\Models\ProfilTk;
use Illuminate\Http\Request;

class ProfilTkController extends Controller
{
    public function index()
    {
        // Ambil data profil pertama dari database
        $profil = ProfilTk::first();

        return view('admin.company', [
            'profil' => $profil
        ]);
    }

    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tujuan' => 'nullable|string',
            'motto' => 'nullable|string',
        ]);

        // Ambil data pertama (karena cuma 1 profil)
        $profil = ProfilTk::first();

        // Update datanya
        $profil->update([
            'visi' => $request->visi,
            'misi' => $request->misi,
            'tujuan' => $request->tujuan,
            'motto' => $request->motto,
        ]);

        // Balikin ke halaman dengan pesan sukses
        return redirect()->route('admin.company')->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}
