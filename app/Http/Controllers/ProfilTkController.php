<?php

namespace App\Http\Controllers;

use App\Models\ProfilTk;
use App\Models\FotoTk; // Import model FotoTk
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class ProfilTkController extends Controller
{
    public function index()
    {
        $profil = ProfilTk::with('foto')->first();

        if (!$profil) {
            $profil = ProfilTk::create([
                'nama_tk' => 'Nama TK Default',
                'visi' => '',
                'misi' => '',
                'tujuan' => '',
                'motto' => ''
            ]);
        }
        return view('admin.company', ['profil' => $profil]);
    }

    public function update(Request $request)
    {
        // (Validasi sudah benar)
        $request->validate([
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tujuan' => 'nullable|string',
            'motto' => 'nullable|string',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|array',
            'deskripsi.*' => 'nullable|string|max:255'
        ]);

        $profil = ProfilTk::first();

        // Update data teks
        $profil->update([
            'visi' => $request->visi,
            'misi' => $request->misi,
            'tujuan' => $request->tujuan,
            'motto' => $request->motto,
        ]);

        // (Logika update deskripsi sudah benar)
        if ($request->has('deskripsi')) {
            foreach ($request->deskripsi as $id_foto => $teks_deskripsi) {
                FotoTk::where('id_foto', $id_foto)
                    ->where('id_profil', $profil->id_profil)
                    ->update(['deskripsi' => $teks_deskripsi]);
            }
        }

        // (Logika upload foto baru DIPERBAIKI)
        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {

                // 1. Simpan di folder 'galeri' pada disk 'public'
                $path = $file->store('galeri', 'public');

                // 2. Tidak perlu str_replace — $path sudah benar (galeri/namafile.jpg)

                // 3. Simpan path langsung ke database
                $profil->foto()->create([
                    'path_foto' => $path,
                    'deskripsi' => null,
                ]);
            }
        }


        return redirect()->route('admin.company')->with('success', 'Profil sekolah berhasil diperbarui!');
    }

    public function hapusFoto($id_foto)
    {
        // (Logika hapus foto sudah benar)
        $foto = FotoTk::findOrFail($id_foto);
        Storage::delete('public/' . $foto->path_foto);
        $foto->delete();
        return redirect()->back()->with('success', 'Foto berhasil dihapus!');
    }
}
