<x-guest-layout>
    <div class="grid md:grid-cols-2 gap-10 max-w-5xl w-full mx-auto items-center">
        <!-- Left Section (Teks) -->
        <div class="hidden md:flex flex-col justify-center items-start text-[#2E7099] pl-0">
            <h1 class="text-4xl font-extrabold leading-tight max-w-lg">
                Pendaftaran TK - Aisyiyah<br>
                Bustanul Athfal Banjareja
            </h1>
            <p>
                Silakan buat akun terlebih dahulu untuk melanjutkan ke formulir pendaftaran.
            </p>
        </div>

        <!-- Right Section (Form) -->
        <div class="bg-white rounded-2xl shadow-md p-8 border border-[#89FFE7] w-full sm:max-w-md mx-auto md:ml-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <x-input-label for="nama_lengkap" :value="__('Nama Lengkap Orang Tua/Wali Murid')" />
                    <x-text-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap" required autofocus placeholder="Masukkan nama lengkap" />
                </div>

                <!-- Nomor HP -->
                <div class="mt-4">
                    <x-input-label for="no_hp" :value="__('Nomor HP')" />
                    <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" placeholder="Contoh: 081234567890" />
                </div>

                <!-- Alamat Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Alamat Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Masukkan email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Kata Sandi & Konfirmasi Kata Sandi -->
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Kata Sandi -->
                    <div>
                        <x-input-label for="password" :value="__('Kata Sandi')" />
                        <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password"
                                    placeholder="Masukkan kata sandi" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Konfirmasi Kata Sandi -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation"
                                    required autocomplete="new-password"
                                    placeholder="Ulangi kata sandi" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
                <!-- Alamat -->
                <div class="mt-4">
                    <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
                    <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 rounded-md" placeholder="Masukkan alamat lengkap Anda"></textarea>
                </div>

                <div class="mt-4 space-y-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Sudah punya akun? Masuk di sini') }}
                    </a>

                    <div class="flex justify-center">
                        <x-primary-button class="mt-2">
                            {{ __('Daftar') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
