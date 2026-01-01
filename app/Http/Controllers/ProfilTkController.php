<?php

namespace App\Http\Controllers;

use App\Models\ProfilTk;
use App\Models\FotoTk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilTkController extends Controller
{
    public function index()
    {
        $profil = ProfilTk::with('foto')->first();

        if (!$profil) {
            $profil = ProfilTk::create([
                'nama_tk' => 'Nama TK Default',
                'sejarah' => '',
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
        $request->validate([
            'sejarah' => 'nullable|string',
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
            'sejarah' => $request->sejarah,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'tujuan' => $request->tujuan,
            'motto' => $request->motto,
        ]);

        if ($request->has('deskripsi')) {
            foreach ($request->deskripsi as $id_foto => $teks_deskripsi) {
                FotoTk::where('id_foto', $id_foto)
                    ->where('id_profil', $profil->id_profil)
                    ->update(['deskripsi' => $teks_deskripsi]);
            }
        }

        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $file) {

                $path = $file->store('galeri', 'public');

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
        $foto = FotoTk::findOrFail($id_foto);
        Storage::delete('public/' . $foto->path_foto);
        $foto->delete();
        return redirect()->back()->with('success', 'Foto berhasil dihapus!');
    }
}
