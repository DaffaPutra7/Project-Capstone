<x-guest-layout>
    <div class="grid md:grid-cols-2 gap-10 max-w-5xl w-full mx-auto items-center">

        <!-- Left Section (Teks) -->
        <div class="hidden md:flex flex-col justify-center items-start text-[#2E7099] pl-0">
            <h1 class="text-4xl font-extrabold leading-tight max-w-lg">
                Silakan masuk menggunakan <br>
                akun yang sudah Anda buat <br>
                sebelumnya
            </h1>
        </div>

        <!-- Right Section (Form) -->
        <div class="bg-white rounded-2xl shadow-md p-8 border border-[#89FFE7] w-full sm:max-w-md mx-auto md:ml-8">

            <!-- Status Sesi -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="hidden md:flex flex-col justify-center items-center text-[#2E7099]">
                    <h1 class="text-4xl font-extrabold leading-tight max-w-lg">
                        Masuk
                    </h1>
                </div>

                <!-- Alamat Email -->
                <div>
                    <x-input-label for="email" :value="__('Alamat Email')" />
                    <x-text-input id="email" class="block mt-1 w-full"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        placeholder="Masukkan email Anda" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Kata Sandi -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Kata Sandi')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password" name="password" required autocomplete="current-password"
                        placeholder="Masukkan kata sandi" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Ingat Saya + Lupa Kata Sandi -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-[#2E7099] shadow-sm focus:ring-[#2E7099]"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-[#2E7099] hover:underline"
                            href="{{ route('password.request') }}">
                            {{ __('Lupa kata sandi?') }}
                        </a>
                    @endif
                </div>

                <!-- Tombol Masuk & Daftar -->
                <div class="flex flex-col items-center mt-10 space-y-4">
                    <!-- Tombol Masuk -->
                    <x-primary-button class="inline-flex justify-center px-8 py-2 text-sm rounded-[50px] w-48">
                        {{ __('Masuk') }}
                    </x-primary-button>

                    <!-- Tombol Daftar -->
                    <a href="{{ route('register') }}"
                        class="inline-flex justify-center px-8 py-2 w-48 text-sm rounded-[50px] border border-[#89FFE7] text-[#2E7099] hover:bg-[#89FFE7] hover:text-white font-semibold uppercase tracking-widest shadow-sm transition ease-in-out duration-150">
                        {{ __('Daftar') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
