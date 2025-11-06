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
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'email'        => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:users,email'],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
            'no_hp'        => ['nullable', 'string', 'numeric', 'min:10', 'max:20'],
            'alamat'       => ['nullable', 'string'],
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
            'role'         => 'user', // default user baru
        ]);

        event(new Registered($user));

        Auth::login($user);

        // 🔥 Langsung arahkan ke form pendaftaran step 1
        return redirect()
            ->route('user.formulir.step1')
            ->with('success', 'Registrasi berhasil! Silakan lengkapi formulir pendaftaran.');
    }
}
