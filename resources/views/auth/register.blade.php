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
        <div class="bg-white rounded-[50px] shadow-md p-8 border border-[#89FFE7] w-full sm:max-w-md mx-auto md:ml-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama Lengkap -->
                <div>
                    <x-input-label for="nama_lengkap" :value="__('Nama Lengkap Orang Tua/Wali Murid')" />
                    <x-text-input id="nama_lengkap" class="block mt-1 w-full rounded-[50px]" type="text" name="nama_lengkap" required autofocus placeholder="Masukkan nama lengkap" />
                </div>

                <!-- Nomor HP -->
                <div class="mt-4">
                    <x-input-label for="no_hp" :value="__('Nomor HP (hanya bisa di isi angka)')" />
                    <x-text-input id="no_hp" class="block mt-1 w-full rounded-[50px]"
                        type="tel"
                        name="no_hp"
                        placeholder="Contoh: 081234567890"
                        pattern="\d*"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                    <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                </div>

                <!-- Alamat Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Alamat Email')" />
                    <x-text-input id="email" class="block mt-1 w-full rounded-[50px]" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Masukkan email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Kata Sandi & Konfirmasi Kata Sandi -->
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Kata Sandi -->
                    <div>
                        <x-input-label for="password" :value="__('Kata Sandi')" />
                        <div class="relative flex items-center">
                            <input id="password" class="block w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#2E7099] focus:ring-[#2E7099] pr-10"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                placeholder="Masukkan sandi" />
                            <button type="button" onclick="togglePassword('password', 'eyeIcon1')"
                                class="absolute right-4 text-gray-500 hover:text-[#2E7099] focus:outline-none">
                                <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-5 h-5 transition-all duration-200">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Konfirmasi Kata Sandi -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-[50px]"
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
                    <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 rounded-[50px] p-3" placeholder="Masukkan alamat lengkap Anda"></textarea>
                </div>

                <div class="mt-4 space-y-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Sudah punya akun? Masuk di sini') }}
                    </a>

                    <div class="flex justify-center">
                        <x-primary-button class="mt-2 rounded-[50px]">
                            {{ __('Daftar') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Show/Hide Password -->
    <script>
        function togglePassword(fieldId, iconId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(iconId);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.98 8.223C5.68 6.17 8.66 4.5 12 4.5c6 0 9.75 7.5 9.75 7.5s-3.75 6.75-9.75 6.75c-3.34 0-6.32-1.67-8.02-3.723" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 12a3 3 0 11-6 0 3 3 0 06 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 3l18 18" />`;
            } else {
                passwordField.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 12a3 3 0 11-6 0 3 3 0 06 0z" />`;
            }
        }
    </script>
</x-guest-layout>