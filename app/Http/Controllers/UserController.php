<?php


namespace App\Http\Controllers;

use App\Models\ProfilTk;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // arahkan ke view dashboard user
        return view('user.dashboard');
    }

    public function showCompanyProfile()
    {
        // Ambil data profil TK pertama dari database
        $profil = ProfilTk::first();

        // Kirim data ke view 'user.company'
        // Kita gunakan nama variabel 'profile' agar cocok dengan blade Anda
        return view('user.company', ['profile' => $profil]);
    }
}
