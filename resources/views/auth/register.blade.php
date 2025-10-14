<x-guest-layout>
    <div class="grid md:grid-cols-2 gap-10 max-w-5xl w-full mx-auto items-center">
        <!-- Left Section (Teks) -->
        <div class="hidden md:flex flex-col justify-center items-start text-[#2E7099] pl-0">
            <h1 class="text-4xl font-extrabold leading-tight max-w-lg">
                Pendaftaran TK - Aisyiyah<br>
                Bustanul Athfal Banjareja
            </h1>
            <p>
                Silahkan lakukan pembuatan akun supaya bisa melanjutkan ke formulir pendaftaran !!!
            </p>
        </div>
        <!-- Right Section (Form) -->
        <div class="bg-white rounded-2xl shadow-md p-8 border border-[#89FFE7] w-full sm:max-w-md mx-auto md:ml-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!--  Nama Lengkap  -->
               <div>
                    <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
                    <x-text-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap" required autofocus />
                </div>
                <!-- No Hp -->
                <div class="mt-4">
                    <x-input-label for="no_hp" :value="__('No HP')" />
                    <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" />
                </div>
                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <!-- Alamat -->
                <div class="mt-4">
                    <x-input-label for="alamat" :value="__('Alamat')" />
                    <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 rounded-md"></textarea>
                </div>

                <div class="mt-4 space-y-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <div class="flex justify-center">
                        <x-primary-button class="mt-2">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
