<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 overflow-x-hidden">

    <!-- HEADER -->
    <header>
        <!-- Top Bar -->
        <div class="bg-gradient-to-r from-[rgba(137,255,231,0.4)] to-[#2E7099] text-white">
            <div class="max-w-7xl mx-auto flex flex-col items-center justify-center py-4">
                <h1 class="text-xl font-bold tracking-wide">PPDB-TK</h1>
                <p class="text-xs opacity-90">TK AISYIYAH BUSTANUL ATHFAL BANJAREJA</p>
            </div>
        </div>

        <!-- Navigation -->
        <div class="bg-[#CDCDCD] text-[#2E7099]">
            <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-2">

                {{-- Link Beranda dinamis sesuai role --}}
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-1 hover:text-[#1f4f6e] transition">
                    @else
                        <a href="{{ route('user.dashboard') }}" class="flex items-center gap-1 hover:text-[#1f4f6e] transition">
                    @endif
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h6m8-11v10a1 1 0 01-1 1h-6" />
                            </svg>
                            <span class="font-semibold text-sm">Beranda</span>
                        </a>
                @endauth

                <!-- Tombol Logout -->
                @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-1 text-sm font-semibold text-[#2E7099] hover:text-[#1f4f6e] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-8V7a2 2 0 114 0v1" />
                        </svg>
                        <span class="tracking-wide">Logout</span>
                    </button>
                </form>
                @endauth
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex items-center justify-center min-h-[calc(100vh-160px)] px-6 py-8 overflow-hidden">
        <div class="w-full max-w-6xl">
            {{ $slot }}
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="py-4 bg-[#2E7099] text-center text-white text-sm">
        &copy; 2025 TK Aisyiyah Bustanul Athfal Banjareja. All rights reserved.
    </footer>

</body>
</html>
