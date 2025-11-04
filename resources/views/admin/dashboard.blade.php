<x-app-layout>
    <main class="space-y-12">

        <!-- Card Selamat Datang -->
        <section class="relative bg-white shadow-xl rounded-[50px] p-8 border-2 border-[#89FFE7] overflow-hidden">
            <!-- Decorative circles -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#89FFE7] rounded-full opacity-10"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-[#2E7099] rounded-full opacity-10"></div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 relative z-10">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-1.5 h-8 bg-[#2E7099] rounded-full"></div>
                        <h2 class="text-2xl font-bold text-sky-700">SELAMAT DATANG</h2>
                    </div>
                    <p class="text-gray-600 mt-2 leading-relaxed ml-5">
                        Penerimaan Peserta Didik Baru (PPDB) TK Aisyiyah Bustanul Athfal Banjareja
                    </p>

                    <div class="flex items-center gap-3 mt-5 ml-5">
                        <label for="tahun" class="text-sm font-semibold text-[#2E7099] flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Tahun Ajaran
                        </label>

                        <div class="relative inline-block">
                            <select id="tahun" name="tahun"
                                class="block w-full max-w-xs appearance-none rounded-[50px] border-2 border-[#89FFE7] px-4 py-2.5 pr-10 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-sky-400 bg-white hover:bg-gray-50 transition-all cursor-pointer shadow-sm">
                                <option>2025/2026</option>
                                <option>2024/2025</option>
                                <option>2023/2024</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 text-[#2E7099] pointer-events-none">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <img src="{{ asset('images/logo-TK-Aisyiyah.png') }}" alt="Logo" class="w-28 sm:w-32 h-auto transform hover:scale-110 transition-transform duration-300">
            </div>
        </section>

        <!-- Tombol Aksi -->
        <section class="flex flex-wrap justify-center gap-8 mt-14">

            <!-- Tombol List Siswa -->
            <a href="{{ route('admin.siswa.index') }}"
                class="group relative flex items-center gap-4 bg-white border-2 border-[#89FFE7] rounded-[50px] px-12 py-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                <div class="bg-[#89FFE7] bg-opacity-20 p-4 rounded-full group-hover:bg-opacity-40 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#2E7099]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A8.966 8.966 0 0112 15c2.21 0 4.21.804 5.879 2.121M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>

                <div class="text-left">
                    <span class="text-2xl text-[#2E7099] font-bold block">List Siswa</span>
                    <span class="text-sm text-gray-500 mt-1 block">Kelola data siswa</span>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#2E7099] transform group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <!-- Tombol Profil TK -->
            <a href="{{ route('admin.company') }}"
                class="group relative flex items-center gap-4 bg-white border-2 border-[#89FFE7] rounded-[50px] px-12 py-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">

                <div class="bg-[#89FFE7] bg-opacity-20 p-4 rounded-full group-hover:bg-opacity-40 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#2E7099]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7l9-4 9 4-9 4-9-4zm0 0v10a2 2 0 002 2h14a2 2 0 002-2V7M9 21h6" />
                    </svg>
                </div>

                <div class="text-left">
                    <span class="text-2xl text-[#2E7099] font-bold block">Profil TK</span>
                    <span class="text-sm text-gray-500 mt-1 block">Informasi sekolah</span>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#2E7099] transform group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </section>

        <!-- Tabel List Siswa Terbaru -->
        <section class="max-w-6xl mx-auto mt-12">
            <div class="bg-white border-2 border-[#89FFE7] rounded-[40px] p-8 shadow-lg">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-1.5 h-8 bg-[#2E7099] rounded-full"></div>
                    <h3 class="text-2xl font-bold text-[#2E7099]">Pendaftar Terbaru</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Lengkap
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tgl. Daftar
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Program
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($pendaftaranSiswa as $pendaftaran)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{-- Akses data anak melalui relasi --}}
                                    {{ $pendaftaran->anak->nama_lengkap ?? 'Data Belum Lengkap' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $pendaftaran->tanggal_daftar ? \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $pendaftaran->jenis_program ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{-- Logika untuk warna status (opsional) --}}
                                    @php
                                    $statusClass = '';
                                    switch ($pendaftaran->status) {
                                    case 'Formulir Dikirim': $statusClass = 'bg-blue-100 text-blue-800'; break;
                                    case 'Proses Seleksi': $statusClass = 'bg-yellow-100 text-yellow-800'; break;
                                    case 'Diterima': $statusClass = 'bg-green-100 text-green-800'; break;
                                    case 'Ditolak': $statusClass = 'bg-red-100 text-red-800'; break;
                                    }
                                    @endphp
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                        {{ $pendaftaran->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('admin.siswa.updateStatus', $pendaftaran->id_pendaftaran) }}" method="POST" class="flex items-center justify-end gap-2">
                                        @csrf

                                        {{-- Dropdown untuk memilih status --}}
                                        <select name="status" class="block w-40 text-sm py-1 px-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-sky-500 focus:border-sky-500">
                                            <option value="Proses Seleksi" {{ $pendaftaran->status == 'Proses Seleksi' ? 'selected' : '' }}>
                                                Proses Seleksi
                                            </option>
                                            <option value="Diterima" {{ $pendaftaran->status == 'Diterima' ? 'selected' : '' }}>
                                                Diterima
                                            </option>
                                            <option value="Ditolak" {{ $pendaftaran->status == 'Ditolak' ? 'selected' : '' }}>
                                                Ditolak
                                            </option>
                                        </select>

                                        {{-- Tombol untuk submit --}}
                                        <button type="submit" class="px-3 py-1 text-xs font-medium text-white bg-sky-600 rounded-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                            Update
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <span>Belum ada data pendaftar</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('admin.siswa.index') }}" class="inline-flex items-center gap-2 text-[#2E7099] font-semibold hover:text-[#1a5577] transition-colors">
                        Lihat Semua Pendaftar
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Statistik -->
        <section class="flex flex-wrap justify-center gap-12 mt-16">
            <!-- Jumlah Pendaftar -->
            <div class="flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <div class="bg-[#2E7099] text-white font-extrabold text-xl px-16 py-6 rounded-full mb-8 shadow-lg">
                    Jumlah Pendaftar
                </div>
                <div class="flex flex-col items-center gap-4 text-[#2E7099]">
                    <div class="bg-[#89FFE7] bg-opacity-20 p-5 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 10a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                    </div>
                    <span class="text-7xl font-extrabold tracking-wide">{{ $jumlahPendaftar }}</span>
                    <span class="text-sm text-gray-500 font-medium">Siswa Terdaftar</span>
                </div>
            </div>

            <!-- Kuota Pendaftaran -->
            <div class="flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <div class="bg-[#2E7099] text-white font-extrabold text-xl px-16 py-6 rounded-full mb-8 shadow-lg">
                    Kuota Pendaftaran
                </div>
                <div class="flex flex-col items-center gap-4 text-[#2E7099]">
                    <div class="bg-[#89FFE7] bg-opacity-20 p-5 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-7xl font-extrabold tracking-wide">500</span>
                    <span class="text-sm text-gray-500 font-medium">Kuota Tersedia</span>
                </div>
            </div>
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