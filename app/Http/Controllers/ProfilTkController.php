<?php

namespace App\Http\Controllers;

use App\Models\ProfilTk;
use Illuminate\Http\Request;

class ProfilTkController extends Controller
{
    public function index() {
        $profil = ProfilTk::first();

        return view('user.company', [
            'profil' => $profil
        ]);
    }
}
