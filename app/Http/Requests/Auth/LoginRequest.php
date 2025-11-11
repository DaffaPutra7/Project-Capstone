<?php

namespace App\Http\Requests\Auth;

// Gunakan semua 'use' statement yang diperlukan
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Str;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Method ini harus ada
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // Method ini juga harus ada
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        // Pastikan tidak kena rate limit (dari kode bawaan)
        $this->ensureIsNotRateLimited();

        // 1. Cek dulu apakah emailnya ada atau tidak
        $user = User::where('email', $this->string('email'))->first();

        // 2. Jika email tidak ditemukan di database
        if (! $user) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => 'Email ini tidak terdaftar di sistem kami.',
                // 'email' => trans('auth.email_not_found'), // Opsional
            ]);
        }

        // 3. Jika email ada, cek password-nya
        if (! Hash::check($this->string('password'), $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'password' => 'Kata sandi yang Anda masukkan salah.',
                // 'password' => trans('auth.password_incorrect'), // Opsional
            ]);
        }

        // 4. Jika email DAN password benar, baru jalankan Auth::attempt
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            
            RateLimiter::hit($this->throttleKey());
            
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'), // 'Email atau kata sandi...'
            ]);
        }

        // 5. Jika berhasil, bersihkan throttle
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     * (Method bawaan, jangan dihapus)
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     * (Method bawaan, jangan dihapus)
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
