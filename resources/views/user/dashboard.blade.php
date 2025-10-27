    <x-app-layout>
        <main class="space-y-12">

            <!-- Card Selamat Datang -->
            <section class="bg-white shadow-md rounded-[50px] p-6 border border-[#89FFE7] flex flex-col sm:flex-row items-center justify-between gap-6 relative">
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-sky-700">
                        SELAMAT DATANG,<br> {{ Auth::user()->nama_lengkap ?? 'User' }}
                    </h2>
                    <p class="text-gray-600 mt-1 leading-relaxed">
                        Penerimaan Peserta Didik Baru (PPDB) TK Aisyiyah Bustanul Athfal Banjareja
                    </p>
                </div>
                <img src="{{ asset('images/logo-TK-Aisyiyah.png') }}" alt="Logo" class="w-24 sm:w-28 h-auto">
            </section>

            <!-- Progress Bar (Tahapan PPDB) -->
            <section class="max-w-4xl mx-auto">
                <div class="flex justify-between text-sm font-medium text-gray-600 mb-2 px-4">
                    <span>Pengisian Formulir</span>
                    <span>Formulir Dikirim</span>
                    <span>Proses Seleksi</span>
                    <span>Diterima</span>
                    <span>Ditolak</span>
                </div>

                <!-- Bar -->
                <div class="relative w-full h-3 bg-gray-200 rounded-full">
                    <!-- Progress aktif -->
                    <div class="absolute top-0 left-0 h-3 bg-[#2E7099] rounded-full transition-all duration-500" style="width: 40%;"></div>
                </div>

                <!-- Titik step -->
                <div class="flex justify-between mt-2 px-[6px]">
                    <div class="w-4 h-4 rounded-full bg-[#2E7099] border-2 border-white shadow-md"></div>
                    <div class="w-4 h-4 rounded-full bg-[#2E7099] border-2 border-white shadow-md"></div>
                    <div class="w-4 h-4 rounded-full bg-gray-300 border-2 border-white shadow-md"></div>
                    <div class="w-4 h-4 rounded-full bg-gray-300 border-2 border-white shadow-md"></div>
                    <div class="w-4 h-4 rounded-full bg-gray-300 border-2 border-white shadow-md"></div>
                </div>
            </section>

            <!-- Tombol Aksi -->
            <section class="flex flex-wrap justify-center gap-12 mt-14">
                <!-- Tombol Pendaftaran -->
                <a href="{{ route('user.formulir') }}"
                class="flex items-center gap-4 border border-[#89FFE7] rounded-[50px] px-20 py-6 shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#2E7099]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m2 8H7a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v9a2 2 0 01-2 2z" />
                    </svg>
                    <span class="text-2xl text-[#2E7099] font-semibold">Pendaftaran</span>
                </a>

                <!-- Tombol Biodata -->
                <a href="{{ route('user.biodata') }}"
                class="flex items-center gap-4 border border-[#89FFE7] rounded-[50px] px-20 py-6 shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#2E7099]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A8.966 8.966 0 0112 15c2.21 0 4.21.804 5.879 2.121M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-2xl text-[#2E7099] font-semibold">Biodata</span>
                </a>

                <!-- Tombol Profil TK -->
                <a href="{{ route('user.company') }}"
                class="flex items-center gap-4 border border-[#89FFE7] rounded-[50px] px-20 py-6 shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#2E7099]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7l9-4 9 4-9 4-9-4zm0 0v10a2 2 0 002 2h14a2 2 0 002-2V7M9 21h6" />
                    </svg>
                    <span class="text-2xl text-[#2E7099] font-semibold">Profil TK</span>
                </a>
            </section>
        </main>

        @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'bottom-end',
                icon: 'success',
                title: 'Login berhasil 🎉',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                background: '#2E7099',
                color: '#fff',
                iconColor: '#89FFE7',
                customClass: {
                    popup: 'rounded-lg shadow-lg'
                }
            })
        </script>
        @endif
    </x-app-layout>
