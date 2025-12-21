<x-app-layout>
    {{-- BAGIAN LOGIKA (Diambil dari Code Lama & Diperbaiki) --}}
    @php
        // 1. LOGIKA CEK KUOTA (PENTING: Agar tombol disable jika penuh)
        $tahunAktifDashboard = \App\Models\TahunAjaran::orderBy('tahun', 'desc')->first();
        $semuaKuotaPenuh = false;

        if ($tahunAktifDashboard) {
            $kuotaReguler = $tahunAktifDashboard->kuota_reguler ?? 0;
            $kuotaFullDay = $tahunAktifDashboard->kuota_full_day ?? 0;

            $terisiReguler = \App\Models\Pendaftaran::where('id_tahun', $tahunAktifDashboard->id_tahun)
                ->where('jenis_program', 'Reguler')
                ->whereNotIn('status', ['Pengisian Formulir', 'Ditolak'])
                ->count();
            
            $terisiFullDay = \App\Models\Pendaftaran::where('id_tahun', $tahunAktifDashboard->id_tahun)
                ->where('jenis_program', 'Full Day')
                ->whereNotIn('status', ['Pengisian Formulir', 'Ditolak'])
                ->count();
            
            // Cek apakah keduanya sudah penuh
            if ($terisiReguler >= $kuotaReguler && $terisiFullDay >= $kuotaFullDay) {
                $semuaKuotaPenuh = true;
            }
        }

        // 2. LOGIKA STATUS & PROGRESS BAR
        $steps = [
            'Pengisian Formulir' => ['desc' => 'Anda sedang dalam tahap pengisian formulir.'],
            'Formulir Dikirim' => ['desc' => 'Formulir Anda sedang dalam proses verifikasi oleh tim kami. Mohon menunggu konfirmasi lebih lanjut.'],
            'Proses Seleksi' => ['desc' => 'Anda telah memasuki tahap seleksi. Tim kami akan meninjau data Anda.'],
            'Diterima' => ['desc' => 'Selamat! Anda telah diterima. Silakan lakukan pendaftaran ulang.'],
            'Ditolak' => ['desc' => 'Mohon maaf, Anda belum lolos seleksi. Silakan coba lagi tahun depan.'],
            'Belum Mendaftar' => ['desc' => 'Anda belum melakukan pendaftaran.'],
        ];

        // $pendaftaran dikirim dari Controller
        $currentStatus = $pendaftaran->status ?? 'Belum Mendaftar';

        $statusMap = [
            'Belum Mendaftar' => 0,
            'Pengisian Formulir' => 1,
            'Formulir Dikirim' => 2,
            'Proses Seleksi' => 3,
            'Diterima' => 4,
            'Ditolak' => 4, 
        ];

        $currentStepIndex = $statusMap[$currentStatus] ?? 0;
        $statusInfo = $steps[$currentStatus] ?? $steps['Belum Mendaftar'];

        // Hitung Lebar Progress Bar (Logic Lama diimplementasikan ke UI Baru)
        $progressWidth = '0%';
        if ($currentStepIndex > 1) {
            // Logika: Step 2=33%, Step 3=66%, Step 4=100%
            $progressWidth = min(100, ($currentStepIndex - 1) * 33.33) . '%';
        }
    @endphp

    <main class="space-y-12">

        {{-- BAGIAN HEADER (UI BARU) --}}
        <section class="bg-gradient-to-br from-white via-blue-50 to-cyan-50 shadow-2xl rounded-[50px] p-8 border-2 border-[#89FFE7] flex flex-col sm:flex-row items-center justify-between gap-6 relative overflow-hidden">
            {{-- Elemen dekoratif blur --}}
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
                <img src="{{ asset('images/logo-TK-Aisyiyah.png') }}" alt="Logo" class="w-28 sm:w-32 h-auto relative z-10 drop-shadow-lg">
            </div>
        </section>

        {{-- BAGIAN STATUS & PROGRESS (UI BARU + LOGIKA LAMA) --}}
        <section class="max-w-5xl mx-auto bg-gradient-to-br from-white via-blue-50 to-cyan-50 rounded-[40px] p-10 shadow-2xl border-2 border-[#89FFE7] relative overflow-hidden">
            <div class="absolute top-0 left-0 w-64 h-64 bg-[#89FFE7] opacity-5 rounded-full -ml-32 -mt-32"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-[#2E7099] opacity-5 rounded-full -mr-32 -mb-32"></div>

            <div class="relative z-10">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-[#2E7099] mb-2">Tahapan Pendaftaran Anda</h3>
                    <p class="text-sm text-gray-600">Lacak proses pendaftaran secara real-time</p>
                </div>

                <div class="relative">
                    {{-- GARIS PROGRESS ABU-ABU (Background) --}}
                    <div class="hidden md:block absolute top-12 left-0 right-0 h-2 bg-gray-200 rounded-full mx-auto" style="width: calc(100% - 80px); margin-left: 40px;"></div>

                    {{-- GARIS PROGRESS BERWARNA (Isi) --}}
                    <div class="hidden md:block absolute top-12 left-0 h-2 bg-gradient-to-r from-[#2E7099] via-[#3d8bb8] to-[#89FFE7] rounded-full transition-all duration-1000 ease-out shadow-lg"
                        style="width: calc({{ $progressWidth }} - 80px); margin-left: 40px;">
                        @if ($currentStepIndex > 0 && $currentStepIndex < 4)
                            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-4 h-4 bg-[#89FFE7] rounded-full animate-pulse shadow-lg"></div>
                        @endif
                    </div>

                    {{-- GRID STEP ITEMS --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 md:gap-2 relative z-10 mt-6">

                        {{-- STEP 1: Pengisian Formulir --}}
                        @php $stepIndex = 1; @endphp
                        <div class="flex flex-col items-center group mb-10 md:mb-0">
                            <div class="relative mb-3">
                                <div class="w-24 h-24 rounded-full flex items-center justify-center shadow-xl border-4 border-white transform transition-all duration-300 group-hover:scale-110 
                                    {{ $currentStepIndex > $stepIndex ? 'bg-gradient-to-br from-[#2E7099] to-[#3d8bb8]' : '' }}
                                    {{ $currentStepIndex == $stepIndex ? 'bg-gradient-to-br from-[#2E7099] to-[#89FFE7] animate-pulse' : '' }}
                                    {{ $currentStepIndex < $stepIndex ? 'bg-gray-200 group-hover:bg-gray-300' : '' }}">

                                    @if ($currentStepIndex > $stepIndex)
                                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    @else
                                    <svg class="w-10 h-10 {{ $currentStepIndex == $stepIndex ? 'text-white' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    @endif
                                </div>
                                @if ($currentStepIndex > $stepIndex)
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                @endif
                                @if ($currentStepIndex == $stepIndex)
                                <div class="absolute inset-0 rounded-full border-4 border-[#89FFE7] animate-ping opacity-75"></div>
                                @endif
                            </div>
                            <span class="text-sm font-bold {{ $currentStepIndex >= $stepIndex ? 'text-[#2E7099]' : 'text-gray-500' }} text-center leading-tight">Pengisian<br>Formulir</span>
                            @if ($currentStepIndex > $stepIndex)
                            <span class="text-xs text-green-600 font-semibold mt-1">✓ Selesai</span>
                            @elseif ($currentStepIndex == $stepIndex)
                            <span class="text-xs text-[#2E7099] font-semibold mt-1 animate-pulse">● Proses</span>
                            @else
                            <span class="text-xs text-gray-400 mt-1">Menunggu</span>
                            @endif
                        </div>

                        {{-- STEP 2: Formulir Dikirim --}}
                        @php $stepIndex = 2; @endphp
                        <div class="flex flex-col items-center group mb-10 md:mb-0">
                            <div class="relative mb-3">
                                <div class="w-24 h-24 rounded-full flex items-center justify-center shadow-xl border-4 border-white transform transition-all duration-300 group-hover:scale-110
                                    {{ $currentStepIndex > $stepIndex ? 'bg-gradient-to-br from-[#2E7099] to-[#3d8bb8]' : '' }}
                                    {{ $currentStepIndex == $stepIndex ? 'bg-gradient-to-br from-[#2E7099] to-[#89FFE7] animate-pulse' : '' }}
                                    {{ $currentStepIndex < $stepIndex ? 'bg-gray-200 group-hover:bg-gray-300' : '' }}">

                                    @if ($currentStepIndex > $stepIndex)
                                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    @else
                                    <svg class="w-10 h-10 {{ $currentStepIndex == $stepIndex ? 'text-white' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                    @endif
                                </div>
                                @if ($currentStepIndex > $stepIndex)
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                @endif
                                @if ($currentStepIndex == $stepIndex)
                                <div class="absolute inset-0 rounded-full border-4 border-[#89FFE7] animate-ping opacity-75"></div>
                                @endif
                            </div>
                            <span class="text-sm font-bold {{ $currentStepIndex >= $stepIndex ? 'text-[#2E7099]' : 'text-gray-500' }} text-center leading-tight">Formulir<br>Dikirim</span>
                            @if ($currentStepIndex > $stepIndex)
                            <span class="text-xs text-green-600 font-semibold mt-1">✓ Selesai</span>
                            @elseif ($currentStepIndex == $stepIndex)
                            <span class="text-xs text-[#2E7099] font-semibold mt-1 animate-pulse">● Proses</span>
                            @else
                            <span class="text-xs text-gray-400 mt-1">Menunggu</span>
                            @endif
                        </div>

                        {{-- STEP 3: Proses Seleksi --}}
                        @php $stepIndex = 3; @endphp
                        <div class="flex flex-col items-center group mb-10 md:mb-0">
                            <div class="relative mb-3">
                                <div class="w-24 h-24 rounded-full flex items-center justify-center shadow-xl border-4 border-white transform transition-all duration-300 group-hover:scale-110
                                    {{ $currentStepIndex > $stepIndex ? 'bg-gradient-to-br from-[#2E7099] to-[#3d8bb8]' : '' }}
                                    {{ $currentStepIndex == $stepIndex ? 'bg-gradient-to-br from-[#2E7099] to-[#89FFE7] animate-pulse' : '' }}
                                    {{ $currentStepIndex < $stepIndex ? 'bg-gray-200 group-hover:bg-gray-300' : '' }}">

                                    @if ($currentStepIndex > $stepIndex)
                                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    @else
                                    <svg class="w-10 h-10 {{ $currentStepIndex == $stepIndex ? 'text-white' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    @endif
                                </div>
                                @if ($currentStepIndex > $stepIndex)
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                @endif
                                @if ($currentStepIndex == $stepIndex)
                                <div class="absolute inset-0 rounded-full border-4 border-[#89FFE7] animate-ping opacity-75"></div>
                                @endif
                            </div>
                            <span class="text-sm font-bold {{ $currentStepIndex >= $stepIndex ? 'text-[#2E7099]' : 'text-gray-500' }} text-center leading-tight">Proses<br>Seleksi</span>
                            @if ($currentStepIndex > $stepIndex)
                            <span class="text-xs text-green-600 font-semibold mt-1">✓ Selesai</span>
                            @elseif ($currentStepIndex == $stepIndex)
                            <span class="text-xs text-[#2E7099] font-semibold mt-1 animate-pulse">● Proses</span>
                            @else
                            <span class="text-xs text-gray-400 mt-1">Menunggu</span>
                            @endif
                        </div>

                        {{-- STEP 4: Hasil Seleksi --}}
                        @php $stepIndex = 4; @endphp
                        <div class="flex flex-col items-center group">
                            <div class="relative mb-3">
                                <div class="w-24 h-24 rounded-full flex items-center justify-center shadow-xl border-4 border-white transform transition-all duration-300 group-hover:scale-110
                                    {{ $currentStatus == 'Diterima' ? 'bg-gradient-to-br from-green-500 to-green-400' : '' }}
                                    {{ $currentStatus == 'Ditolak' ? 'bg-gradient-to-br from-red-500 to-red-400' : '' }}
                                    {{ $currentStepIndex < $stepIndex ? 'bg-gray-200 group-hover:bg-gray-300' : '' }}">

                                    @if ($currentStatus == 'Diterima')
                                    <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @elseif ($currentStatus == 'Ditolak')
                                    <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @else
                                    <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @endif
                                </div>

                                {{-- Badge dinamis --}}
                                @if ($currentStatus == 'Diterima')
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                @elseif ($currentStatus == 'Ditolak')
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-red-500 rounded-full border-2 border-white flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                @endif
                            </div>

                            <span class="text-sm font-bold {{ $currentStatus == 'Diterima' ? 'text-green-600' : ($currentStatus == 'Ditolak' ? 'text-red-600' : 'text-gray-500') }} text-center leading-tight">Status<br>Pendaftaran</span>

                            @if ($currentStatus == 'Diterima')
                            <span class="text-xs text-green-600 font-semibold mt-1">✓ Diterima</span>
                            @elseif ($currentStatus == 'Ditolak')
                            <span class="text-xs text-red-600 font-semibold mt-1">● Ditolak</span>
                            @else
                            <span class="text-xs text-gray-400 mt-1">Menunggu</span>
                            @endif
                        </div>

                    </div>
                </div>

                {{-- INFO CARD STATUS --}}
                <div class="mt-8 bg-white rounded-2xl p-5 shadow-md border border-[#89FFE7]">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#2E7099] to-[#89FFE7] flex items-center justify-center 
                                    {{ ($currentStepIndex == 4) ? '' : 'animate-pulse' }}">

                            @if ($currentStatus == 'Diterima')
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            @elseif ($currentStatus == 'Ditolak')
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            @else
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-[#2E7099] mb-1">Status Saat Ini: {{ $currentStatus }}</h4>
                            <p class="text-sm text-gray-600">{{ $statusInfo['desc'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- BAGIAN TOMBOL MENU --}}
        <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-14 max-w-5xl mx-auto place-items-stretch">
            @php
            // LOGIKA PENENTUAN LINK & DISABLE TOMBOL (Diambil dari Code Lama)
            $linkPendaftaran = route('user.formulir.step1');
            $teksJudul = "Mulai Pendaftaran";
            $teksDeskripsi = "Klik untuk mengisi formulir pendaftaran";
            $iconPendaftaran = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />';

            $step = 1;
            $isDisabled = false;

            if (!$pendaftaran && $semuaKuotaPenuh) {
                // KONDISI 1: Belum daftar TAPI kuota penuh -> DISABLE
                $isDisabled = true;
                $linkPendaftaran = '#';
                $teksJudul = "Kuota Penuh";
                $teksDeskripsi = "Mohon maaf, kuota pendaftaran tahun ini sudah penuh.";
            } 
            elseif ($pendaftaran) {
                // KONDISI 2: Sudah daftar/sedang daftar
                $step = $pendaftaran->progress_step ?? 1;

                if ($pendaftaran->status == 'Pengisian Formulir') {
                    if ($step == 1) {
                        $linkPendaftaran = route('user.formulir.step1');
                        $teksJudul = "Lanjutkan Pendaftaran";
                        $teksDeskripsi = "Anda di Tahap 1: Data Anak";
                    } elseif ($step == 2) {
                        $linkPendaftaran = route('user.formulir.step2');
                        $teksJudul = "Lanjutkan Pendaftaran";
                        $teksDeskripsi = "Anda di Tahap 2: Data Orang Tua";
                    } elseif ($step >= 3) {
                        $linkPendaftaran = route('user.formulir.step3');
                        $teksJudul = "Lanjutkan Pendaftaran";
                        $teksDeskripsi = "Anda di Tahap 3: Pilihan Program";
                    }
                } else {
                    // KONDISI 3: Sudah Submit (Menunggu/Diterima/Ditolak) -> LINK MATI (Lihat status)
                    $linkPendaftaran = '#';
                    $teksJudul = "Pendaftaran Terkirim";
                    $teksDeskripsi = "Data Anda sedang diverifikasi. Status: " . $pendaftaran->status;
                    $iconPendaftaran = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />';
                }
            }
            @endphp

            {{-- TOMBOL PENDAFTARAN --}}
            <a href="{{ $linkPendaftaran }}"
               class="group bg-gradient-to-br from-[#3889BA] to-[#89FFE7] rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 relative overflow-visible flex flex-col
                @if ($pendaftaran && $pendaftaran->status == 'Pengisian Formulir' && !$isDisabled)
                    border-4 border-[#89FFE7] hover:border-[#2E7099]
                @else
                    border-2 border-[#89FFE7] hover:border-[#2E7099]
                @endif
                {{-- Tambahkan class grayscale/cursor-not-allowed jika disabled --}}
                {{ ($pendaftaran && $pendaftaran->status !== 'Pengisian Formulir') || $isDisabled ? 'opacity-70 cursor-not-allowed' : '' }}
               "
               @if($isDisabled) onclick="return false;" @endif
            >

                @if ((!$pendaftaran || ($pendaftaran && $pendaftaran->status == 'Pengisian Formulir')) && !$isDisabled)
                <div class="absolute -inset-2 rounded-3xl border-8 border-[#89FFE7] opacity-50 animate-ping z-0"></div>
                @endif

                <div class="absolute top-0 right-0 w-32 h-32 bg-[#89FFE7] opacity-10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>

                <div class="flex flex-col items-center gap-3 relative z-10">
                    <div class="relative">
                        <div class="relative bg-gradient-to-br from-[#2E7099] to-[#3d8bb8] p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                {!! $iconPendaftaran !!}
                            </svg>
                        </div>
                    </div>

                    <span class="text-xl text-[#2E7099] font-bold group-hover:text-[#3d8bb8] transition-colors">{{ $teksJudul }}</span>
                    <p class="text-sm text-gray-600 text-center">{{ $teksDeskripsi }}</p>
                </div>

                {{-- PROGRESS BAR KECIL DI KARTU --}}
                @if ($pendaftaran && $pendaftaran->status == 'Pengisian Formulir' && !$isDisabled)
                @php $progressPercent = max(0, ($step - 1) * 50); @endphp

                <div class="w-full mt-auto pt-4 relative z-10">
                    <span class="text-xs font-semibold text-gray-500">Progres: ({{ $step }}/3)</span>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                        <div class="bg-[#2E7099] h-2.5 rounded-full transition-all duration-500"
                            style="width: {{ $progressPercent }}%">
                        </div>
                    </div>
                </div>
                @endif
            </a>

            {{-- TOMBOL BIODATA --}}
            <a href="{{ route('user.biodata') }}"
                class="group bg-gradient-to-br from-[#347928] to-[#C0EBA6] border-2 border-[#C0EBA6] rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:border-[#2E7099] relative overflow-hidden flex flex-col">

                <div class="absolute top-0 right-0 w-32 h-32 bg-[#89FFE7] opacity-10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>

                <div class="flex flex-col items-center gap-3 relative z-10">
                    <div class="bg-gradient-to-br from-[#E0B624] to-[#B89A11] p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A8.966 8.966 0 0112 15c2.21 0 4.21.804 5.879 2.121M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>

                    <span class="text-xl text-[#E0B624] font-bold group-hover:text-[#B89A11] transition-colors">Biodata</span>
                    <p class="text-sm text-gray-600 text-center">Lihat dan kelola biodata pribadi</p>
                </div>
            </a>

            {{-- TOMBOL PROFIL TK --}}
            <a href="{{ route('user.company') }}"
                class="group bg-gradient-to-br from-[#B33D63] to-[#EDCAD5] border-2 border-[#EDCAD5] rounded-3xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:border-[#2E7099] relative overflow-hidden flex flex-col">

                <div class="absolute top-0 right-0 w-32 h-32 bg-[#89FFE7] opacity-10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>

                <div class="flex flex-col items-center gap-3 relative z-10">
                    <div class="bg-gradient-to-br from-[#C588EB] to-[#9E6ABD] p-4 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7l9-4 9 4-9 4-9-4zm0 0v10a2 2 0 002 2h14a2 2 0 002-2V7M9 21h6" />
                        </svg>
                    </div>

                    <span class="text-xl text-[#9E6ABD] font-bold group-hover:text-[#9E6ABD] transition-colors">Profil TK</span>
                    <p class="text-sm text-gray-600 text-center">Informasi tentang sekolah kami</p>
                </div>
            </a>
        </section>
    </main>

    {{-- ALERT (Tetap dipertahankan) --}}
    @if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            icon: 'success',
            title: 'Login berhasil ',
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