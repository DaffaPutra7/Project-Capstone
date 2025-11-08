<x-guest-layout>
    <div class="grid md:grid-cols-2 gap-10 max-w-5xl w-full mx-auto items-center">

        <!-- Left Section -->
        <div class="hidden md:flex flex-col justify-center items-start text-[#2E7099] pl-0">
            <h1 class="text-4xl font-extrabold leading-tight max-w-lg">
                Silakan masuk menggunakan <br>
                akun yang sudah Anda buat <br>
                sebelumnya
            </h1>
        </div>

        <!-- Right Section -->
        <div class="bg-white rounded-2xl shadow-md p-8 border border-[#89FFE7] w-full sm:max-w-md mx-auto md:ml-8">

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="hidden md:flex flex-col justify-center items-center text-[#2E7099] mb-6">
                    <h1 class="text-4xl font-extrabold leading-tight max-w-lg">Masuk</h1>
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Alamat Email')" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#2E7099] focus:ring-[#2E7099]"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        placeholder="Masukkan email Anda" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Kata Sandi')" />

                    <!-- Flex Container biar ikon sejajar -->
                    <div class="relative flex items-center">
                        <input id="password"
                            class="block w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#2E7099] focus:ring-[#2E7099] pr-10"
                            type="password" name="password" required autocomplete="current-password"
                            placeholder="Masukkan kata sandi" />

                        <!-- Eye Icon -->
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 text-gray-500 hover:text-[#2E7099] focus:outline-none">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none"
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

                <!-- Lupa Kata Sandi -->
                @if (Route::has('password.request'))
                <div class="flex justify-end mt-3">
                    <a class="text-sm text-[#2E7099] hover:underline"
                        href="{{ route('password.request') }}">
                        {{ __('Lupa kata sandi?') }}
                    </a>
                </div>
                @endif

                <!-- Tombol -->
                <div class="flex flex-col items-center mt-10 space-y-4">
                    <x-primary-button class="inline-flex justify-center px-8 py-2 text-sm rounded-[50px] w-48">
                        {{ __('Masuk') }}
                    </x-primary-button>

                    <a href="{{ route('register') }}"
                        class="inline-flex justify-center px-8 py-2 w-48 text-sm rounded-[50px] border border-[#89FFE7] text-[#2E7099] hover:bg-[#89FFE7] hover:text-white font-semibold uppercase tracking-widest shadow-sm transition ease-in-out duration-150">
                        {{ __('Daftar') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Show/Hide Password -->
    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.98 8.223C5.68 6.17 8.66 4.5 12 4.5c6 0 9.75 7.5 9.75 7.5s-3.75 6.75-9.75 6.75c-3.34 0-6.32-1.67-8.02-3.723" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
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