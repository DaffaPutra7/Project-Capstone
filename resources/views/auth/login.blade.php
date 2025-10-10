<x-guest-layout>
    <div class="grid md:grid-cols-2 gap-10 max-w-5xl w-full mx-auto items-center">

        <!-- Left Section (Teks) -->
        <div class="hidden md:flex flex-col justify-center items-start text-[#2E7099] pl-0">
            <h1 class="text-4xl font-extrabold leading-tight max-w-lg">
                Silahkan masuk menggunakan <br>
                akun yang sudah dibuat <br>
                sebelumnya
            </h1>
        </div>

        <!-- Right Section (Form) -->
        <div class="bg-white rounded-2xl shadow-md p-8 border border-gray-100 w-full sm:max-w-md mx-auto">

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="hidden md:flex flex-col justify-center items-center text-[#2E7099]">
                    <h1 class="text-4xl font-extrabold leading-tight max-w-lg">
                        Login
                    </h1>
                </div>
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full"
                        type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-[#2E7099] shadow-sm focus:ring-[#2E7099]"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-[#2E7099] hover:underline"
                           href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="bg-[#2E7099] hover:bg-[#256084] transition">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

    </div>
</x-guest-layout>
