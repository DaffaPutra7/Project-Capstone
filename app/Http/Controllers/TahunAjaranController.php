<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string', 
            'kuota_full_day' => 'required|integer|min:0',
            'kuota_reguler' => 'required|integer|min:0',
        ]);

        TahunAjaran::updateOrCreate(
            ['tahun' => $request->tahun],
            [
                'kuota_full_day' => $request->kuota_full_day,
                'kuota_reguler' => $request->kuota_reguler,
            ] 
        );

        return redirect()->back()->with('success', 'Data Tahun Ajaran ' . $request->tahun . ' berhasil disimpan!');
    }
}