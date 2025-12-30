<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::orderBy('created_at', 'asc')->get();
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function destroy($id)
    {
        Guru::findOrFail($id)->delete();
        return back()->with('success', 'Guru dihapus');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'foto' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('guru', 'public');
        }

        Guru::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath
        ]);

        return back()->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.update', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'deskripsi' => 'nullable|string',
            'foto' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('guru', 'public');
            $guru->foto = $fotoPath;
        }

        $guru->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diupdate');
    }
}
