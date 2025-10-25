<x-app-layout>
    <main class="space-y-12">

        <!-- Card Selamat Datang -->
        <section class="bg-white shadow-md rounded-[50px] p-6 border border-[#89FFE7] flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex-1">
                <h2 class="text-xl font-bold text-sky-700">SELAMAT DATANG</h2>
                <p class="text-gray-600 mt-1 leading-relaxed">
                    Penerimaan Peserta Didik Baru (PPDB) TK Aisyiyah Bustanul Athfal Banjareja
                </p>
                <!-- Wrapper supaya arrow custom bisa di-position -->
                <div class="flex items-center gap-2">
                    <label for="tahun" class="text-sm font-medium text-gray-600">Tahun Ajaran</label>

                    <div class="relative inline-block">
                        <select id="tahun" name="tahun"
                                class="block w-full max-w-xs appearance-none rounded-[50px] border border-[#89FFE7] px-3 py-2 pr-10 text-sm focus:outline-none focus:ring-1 focus:ring-sky-400 bg-white">
                        <option>2025/2026</option>
                        <option>2024/2025</option>
                        <option>2023/2024</option>
                        </select>
                    </div>
                </div>
            </div>

            <img src="{{ asset('images/logo-TK-Aisyiyah.png') }}" alt="Logo" class="w-24 sm:w-28 h-auto">
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

        <!-- Statistik -->
        <section class="flex flex-wrap justify-center gap-32 mt-16">
            <!-- Jumlah Pendaftar -->
            <div class="flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <div class="bg-[#2E7099] text-white font-extrabold text-2xl px-20 py-8 rounded-full mb-5 shadow-lg">
                    Jumlah Pendaftar
                </div>
                <div class="flex items-center gap-4 text-[#2E7099] py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 10a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                    <span class="text-6xl font-extrabold tracking-wide">2500</span>
                </div>
            </div>

            <!-- Kuota Pendaftaran -->
            <div class="flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <div class="bg-[#2E7099] text-white font-extrabold text-2xl px-20 py-8 rounded-full mb-5 shadow-lg">
                    Kuota Pendaftaran
                </div>
                <div class="flex items-center gap-4 text-[#2E7099] py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 10a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                    <span class="text-6xl font-extrabold tracking-wide">2500</span>
                </div>
            </div>
        </section>
    </main>
    @if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'bottom-end', // pojok kanan bawah
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
