<x-app-layout>
    <main class="space-y-12">

        <!-- Card Selamat Datang dengan Gradient Background -->
        <section class="bg-gradient-to-br from-white via-blue-50 to-cyan-50 shadow-2xl rounded-[50px] p-8 border-2 border-[#89FFE7] flex flex-col sm:flex-row items-center justify-between gap-6 relative overflow-hidden">
            <!-- Decorative circles -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#89FFE7] opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-[#2E7099] opacity-10 rounded-full blur-3xl"></div>
            
            <div class="flex-1 relative z-10">
                <div class="inline-block mb-2">
                    <span class="text-xs font-semibold text-[#2E7099] bg-[#89FFE7] bg-opacity-30 px-3 py-1 rounded-full">
                        Dashboard Calon Siswa
                    </span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-sky-700 mb-2">
                    SELAMAT DATANG,<br> 
                    <span class="text-[#2E7099]">{{ Auth::user()->nama_lengkap ?? 'User' }}</span>
                </h2>
                <p class="text-gray-600 mt-2 leading-relaxed">
                    Penerimaan Peserta Didik Baru (PPDB)<br>
                    <span class="font-semibold text-[#2E7099]">TK Aisyiyah Bustanul Athfal Banjareja</span>
                </p>
            </div>
            <div class="relative">
                <div class="absolute inset-0 bg-[#89FFE7] opacity-20 rounded-full blur-xl animate-pulse"></div>
                <img src="{{ asset('images/logo-TK-Aisyiyah.png') }}" alt="Logo" class="w-28 sm:w-32 h-auto relative z-10 drop-shadow-lg">
            </div>
        </section>

        <!-- Progress Bar (Tahapan PPDB) dengan Style Modern -->
        <section class="max-w-5xl mx-auto bg-gradient-to-br from-white via-blue-50 to-cyan-50 rounded-[40px] p-10 shadow-2xl border-2 border-[#89FFE7] relative overflow-hidden">
            <!-- Decorative background -->
            <div class="absolute top-0 left-0 w-64 h-64 bg-[#89FFE7] opacity-5 rounded-full -ml-32 -mt-32"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-[#2E7099] opacity-5 rounded-full -mr-32 -mb-32"></div>
            
            <div class="relative z-10">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-[#2E7099] mb-2">Tahapan Pendaftaran Anda</h3>
                    <p class="text-sm text-gray-600">Lacak proses pendaftaran secara real-time</p>
                </div>
                
                <!-- Steps Container -->
                <div class="relative">
                    <!-- Progress Line Background -->
                    <div class="absolute top-12 left-0 right-0 h-2 bg-gray-200 rounded-full mx-auto" style="width: calc(100% - 80px); margin-left: 40px;"></div>
                    
                    <!-- Progress Line Active -->
                    <div class="absolute top-12 left-0 h-2 bg-gradient-to-r from-[#2E7099] via-[#3d8bb8] to-[#89FFE7] rounded-full transition-all duration-1000 ease-out shadow-lg" style="width: calc(40% - 80px); margin-left: 40px;">
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-4 h-4 bg-[#89FFE7] rounded-full animate-pulse shadow-lg"></div>
                    </div>

                    <!-- Steps -->
                    <div class="grid grid-cols-5 gap-2 relative z-10">
                        <!-- Step 1: Pengisian Formulir (Completed) -->
                        <div class="flex flex-col items-center group">
                            <div class="relative mb-3">
                                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[#2E7099] to-[#3d8bb8] flex items-center justify-center shadow-xl border-4 border-white transform transition-all duration-300 group-hover:scale-110">
                                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-[#2E7099] text-center leading-tight">Pengisian<br>Formulir</span>
                            <span class="text-xs text-green-600 font-semibold mt-1">✓ Selesai</span>
                        </div>

                        <!-- Step 2: Formulir Dikirim (Active) -->
                        <div class="flex flex-col items-center group">
                            <div class="relative mb-3">
                                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-[#2E7099] to-[#89FFE7] flex items-center justify-center shadow-xl border-4 border-white transform transition-all duration-300 group-hover:scale-110 animate-pulse">
                                    <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                </div>
                                <div class="absolute inset-0 rounded-full border-4 border-[#89FFE7] animate-ping opacity-75"></div>
                            </div>
                            <span class="text-sm font-bold text-[#2E7099] text-center leading-tight">Formulir<br>Dikirim</span>
                            <span class="text-xs text-[#2E7099] font-semibold mt-1 animate-pulse">● Proses</span>
                        </div>

                        <!-- Step 3: Proses Seleksi (Pending) -->
                        <div class="flex flex-col items-center group">
                            <div class="relative mb-3">
                                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center shadow-lg border-4 border-white transform transition-all duration-300 group-hover:scale-105 group-hover:bg-gray-300">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-gray-500 text-center leading-tight">Proses<br>Seleksi</span>
                            <span class="text-xs text-gray-400 mt-1">Menunggu</span>
                        </div>

                        <!-- Step 4: Diterima (Pending) -->
                        <div class="flex flex-col items-center group">
                            <div class="relative mb-3">
                                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center shadow-lg border-4 border-white transform transition-all duration-300 group-hover:scale-105 group-hover:bg-gray-300">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-gray-500 text-center leading-tight">Diterima</span>
                            <span class="text-xs text-gray-400 mt-1">Menunggu</span>
                        </div>

                        <!-- Step 5: Ditolak (Pending) -->
                        <div class="flex flex-col items-center group">
                            <div class="relative mb-3">
                                <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center shadow-lg border-4 border-white transform transition-all duration-300 group-hover:scale-105 group-hover:bg-gray-300">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <span class="text-sm font-semibold text-gray-500 text-center leading-tight">Ditolak</span>
                            <span class="text-xs text-gray-400 mt-1">Menunggu</span>
                        </div>
                    </div>
                </div>

                <!-- Status Info Card -->
                <div class="mt-8 bg-white rounded-2xl p-5 shadow-md border border-[#89FFE7]">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#2E7099] to-[#89FFE7] flex items-center justify-center animate-pulse">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-[#2E7099] mb-1">Status Saat Ini: Formulir Dikirim</h4>
                            <p class="text-sm text-gray-600">Formulir Anda sedang dalam proses verifikasi oleh tim kami. Mohon menunggu konfirmasi lebih lanjut.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tombol Aksi dengan Card Style -->
        <section class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-14 max-w-4xl mx-auto place-items-center">
            <!-- Tombol Biodata -->
            <a href="{{ route('user.biodata') }}"
            class="group bg-gradient-to-br from-white to-cyan-50 border-2 border-[#89FFE7] rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:border-[#2E7099] relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#89FFE7] opacity-10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex flex-col items-center gap-4 relative z-10">
                    <div class="bg-gradient-to-br from-[#2E7099] to-[#3d8bb8] p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A8.966 8.966 0 0112 15c2.21 0 4.21.804 5.879 2.121M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="text-2xl text-[#2E7099] font-bold group-hover:text-[#3d8bb8] transition-colors">Biodata</span>
                    <p class="text-sm text-gray-600 text-center">Lihat dan kelola biodata pribadi</p>
                </div>
            </a>

            <!-- Tombol Profil TK -->
            <a href="{{ route('user.company') }}"
            class="group bg-gradient-to-br from-white to-blue-50 border-2 border-[#89FFE7] rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:border-[#2E7099] relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#89FFE7] opacity-10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex flex-col items-center gap-4 relative z-10">
                    <div class="bg-gradient-to-br from-[#2E7099] to-[#3d8bb8] p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7l9-4 9 4-9 4-9-4zm0 0v10a2 2 0 002 2h14a2 2 0 002-2V7M9 21h6" />
                        </svg>
                    </div>
                    <span class="text-2xl text-[#2E7099] font-bold group-hover:text-[#3d8bb8] transition-colors">Profil TK</span>
                    <p class="text-sm text-gray-600 text-center">Informasi tentang sekolah kami</p>
                </div>
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