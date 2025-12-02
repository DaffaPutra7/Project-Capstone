<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Custom Pesan Error Bahasa Indonesia
        $messages = [
            'required' => 'Data :attribute wajib diisi.',
            'email' => 'Format email tidak valid (harus mengandung @ dan nama domain, cth: user@gmail.com).', 
            'unique' => 'Data :attribute sudah terdaftar.',
            'min' => 'Data :attribute minimal :min karakter.',
            'max' => 'Data :attribute maksimal :max karakter.',
            'confirmed' => 'Konfirmasi :attribute tidak cocok.',
            'numeric' => 'Data :attribute harus berupa angka.',
            'digits_between' => 'Data :attribute harus bernilai antara :min sampai :max digit.',
            'nama_lengkap.regex' => 'Nama tidak boleh mengandung angka atau simbol aneh.', // Pesan khusus validasi nama
        ];

        // Custom Nama Atribut
        $attributes = [
            'nama_lengkap' => 'Nama Lengkap',
            'email' => 'Alamat Email',
            'password' => 'Kata Sandi',
            'password_confirmation' => 'Konfirmasi Sandi',
            'no_hp' => 'Nomor HP',
            'alamat' => 'Alamat Lengkap',
        ];

        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z\s\.\,\']+$/'], 
            'email'        => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:users,email'],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required'],
            'no_hp'        => ['required', 'string', 'numeric', 'digits_between:10,15'], 
            'alamat'       => ['required', 'string'],
        ], $messages, $attributes);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
            'role'         => 'user', 
        ]);

        event(new Registered($user));

        Auth::login($user); 

        return redirect()
            ->route('user.dashboard') 
            ->with('success', 'Registrasi berhasil! Selamat datang.'); 
    }
}