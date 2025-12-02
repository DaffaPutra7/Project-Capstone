<x-guest-layout>
    <div class="grid md:grid-cols-2 gap-10 max-w-5xl w-full mx-auto items-center min-h-screen py-10 md:py-0">
        <div class="hidden md:flex flex-col justify-center items-start text-[#2E7099] pl-0">
            <h1 class="text-4xl font-extrabold leading-tight max-w-lg">
                Pendaftaran TK - Aisyiyah<br>
                Bustanul Athfal Banjareja
            </h1>
            <p class="mt-4 text-lg">
                Silakan buat akun terlebih dahulu untuk melanjutkan ke formulir pendaftaran.
            </p>
        </div>

        <div class="bg-white rounded-[50px] shadow-md p-8 border border-[#89FFE7] w-full sm:max-w-md mx-auto md:ml-8">

            <form method="POST" action="{{ route('register') }}" class="space-y-4" novalidate>
                @csrf

                <div x-data="{ hasTyped: false }">
                    <label for="nama_lengkap" class="block text-sm font-semibold mb-2 text-gray-700">
                        Nama Lengkap Orang Tua/Wali <span class="text-red-500">*</span>
                    </label>
                    {{-- Validasi Input Nama: Hanya Huruf --}}
                    <input id="nama_lengkap"
                        class="block w-full rounded-[50px] p-3 focus:ring-2 focus:ring-[#2E7099] focus:border-transparent outline-none border"
                        type="text"
                        name="nama_lengkap"
                        value="{{ old('nama_lengkap') }}"
                        required
                        autofocus
                        placeholder="Masukkan nama lengkap"
                        @input="hasTyped = true; $el.value = $el.value.replace(/[^a-zA-Z\s\.\,\']/g, '')"
                        :class="(!hasTyped && {{ $errors->has('nama_lengkap') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-gray-300'" />
                    <div x-show="!hasTyped">
                        @error('nama_lengkap')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div x-data="{ hasTyped: false }">
                    <label for="no_hp" class="block text-sm font-semibold mb-2 text-gray-700">
                        Nomor HP <span class="text-red-500">*</span>
                    </label>
                    <input id="no_hp"
                        class="block w-full rounded-[50px] p-3 focus:ring-2 focus:ring-[#2E7099] focus:border-transparent outline-none border"
                        type="tel"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        required
                        placeholder="Contoh: 081234567890"
                        @input="hasTyped = true; $el.value = $el.value.replace(/[^0-9]/g, '')"
                        :class="(!hasTyped && {{ $errors->has('no_hp') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-gray-300'" />
                    <div x-show="!hasTyped">
                        @error('no_hp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div x-data="{ hasTyped: false }">
                    <label for="email" class="block text-sm font-semibold mb-2 text-gray-700">
                        Alamat Email <span class="text-red-500">*</span>
                    </label>
                    <input id="email"
                        class="block w-full rounded-[50px] p-3 focus:ring-2 focus:ring-[#2E7099] focus:border-transparent outline-none border"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="username"
                        placeholder="Masukkan email"
                        @input="hasTyped = true"
                        :class="(!hasTyped && {{ $errors->has('email') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-gray-300'" />
                    <div x-show="!hasTyped">
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div x-data="{ hasTyped: false, show: false }">
                        <label for="password" class="block text-sm font-semibold mb-2 text-gray-700">
                            Kata Sandi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input id="password"
                                class="block w-full rounded-[50px] p-3 pr-10 focus:ring-2 focus:ring-[#2E7099] focus:border-transparent outline-none border"
                                :type="show ? 'text' : 'password'"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Masukkan sandi"
                                @input="hasTyped = true"
                                :class="(!hasTyped && {{ $errors->has('password') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-gray-300'" />
                            <button type="button"
                                @click="show = !show"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-500 hover:text-[#2E7099] focus:outline-none">

                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223C5.68 6.17 8.66 4.5 12 4.5c6 0 9.75 7.5 9.75 7.5s-3.75 6.75-9.75 6.75c-3.34 0-6.32-1.67-8.02-3.723M12 16.5c-3.75 0-6-3-6-3s2.25-3 6-3 6 3 6 3-2.25 3-6 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                </svg>

                                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                        <div x-show="!hasTyped">
                            @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div x-data="{ hasTyped: false, show: false }">
                        <label for="password_confirmation" class="block text-sm font-semibold mb-2 text-gray-700">
                            Konfirmasi Sandi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input id="password_confirmation"
                                class="block w-full rounded-[50px] p-3 pr-10 focus:ring-2 focus:ring-[#2E7099] focus:border-transparent outline-none border"
                                :type="show ? 'text' : 'password'"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Ulangi sandi"
                                @input="hasTyped = true"
                                :class="(!hasTyped && {{ $errors->has('password_confirmation') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-gray-300'" />
                            <button type="button"
                                @click="show = !show"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-500 hover:text-[#2E7099] focus:outline-none">

                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223C5.68 6.17 8.66 4.5 12 4.5c6 0 9.75 7.5 9.75 7.5s-3.75 6.75-9.75 6.75c-3.34 0-6.32-1.67-8.02-3.723M12 16.5c-3.75 0-6-3-6-3s2.25-3 6-3 6 3 6 3-2.25 3-6 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
                                </svg>

                                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button>
                        </div>
                        <div x-show="!hasTyped">
                            @error('password_confirmation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div x-data="{ hasTyped: false }">
                    <label for="alamat" class="block text-sm font-semibold mb-2 text-gray-700">
                        Alamat Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alamat"
                        name="alamat"
                        class="block w-full rounded-[30px] p-3 focus:ring-2 focus:ring-[#2E7099] focus:border-transparent outline-none border"
                        placeholder="Masukkan alamat lengkap Anda"
                        required
                        rows="3"
                        @input="hasTyped = true"
                        :class="(!hasTyped && {{ $errors->has('alamat') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-gray-300'">{{ old('alamat') }}</textarea>
                    <div x-show="!hasTyped">
                        @error('alamat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 space-y-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 block text-center"
                        href="{{ route('login') }}">
                        {{ __('Sudah punya akun? Masuk di sini') }}
                    </a>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="w-full sm:w-auto px-10 py-3 bg-[#2E7099] text-white font-bold rounded-[50px] hover:bg-[#1f567a] transition shadow-md">
                            {{ __('Daftar') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</x-guest-layout>