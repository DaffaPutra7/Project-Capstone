<x-app-layout>
    <main class="space-y-14">

        <main class="max-w-6xl mx-auto px-4 mt-10 space-y-8 flex-grow">

            <main class="max-w-6xl mx-auto px-4 mt-10 space-y-8 flex-grow">

                <div class="space-y-0">
                    <section class="bg-white shadow-md rounded-t-2xl p-6 border border-[#89FFE7] flex flex-col sm:flex-row items-center justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h2 class="text-2xl sm:text-3xl font-bold text-sky-700 mb-2">
                                    SELAMAT DATANG,<br>
                                    <span class="text-[#2E7099]">{{ Auth::user()->nama_lengkap ?? 'User' }}</span>
                                </h2>
                            </div>
                            <p>Lihat rekapitulasi jumlah pendaftar terbaru dan status kuota sekolah Anda.</p>

                            <div class="relative inline-block mt-6">
                                <select id="tahun" name="tahun"
                                    class="block w-full max-w-xs appearance-none rounded-[50px] border-2 border-[#89FFE7] px-4 py-2.5 pr-10 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-sky-400 bg-white hover:bg-gray-50 transition-all cursor-pointer shadow-sm">
                                    <option>2025/2026</option>
                                    <option>2024/2025</option>
                                    <option>2023/2024</option>
                                </select>

                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-3 text-[#2E7099] pointer-events-none">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('images/logo-TK-Aisyiyah.png') }}" alt="Logo Sekolah" class="w-24 sm:w-28 h-auto">
                    </section>

                    <section class="flex flex-col sm:flex-row justify-start items-start sm:items-center flex-wrap gap-2 text-sm bg-white border-x border-b border-[#89FFE7] rounded-b-2xl shadow-md px-6 py-3">
                        <div class="flex items-center gap-2 bg-sky-100 text-sky-800 px-4 py-2 rounded-xl shadow-sm border border-sky-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 10a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 100-8 4 4 0 000 8z" />
                            </svg>
                            <span><strong>Jumlah Pendaftar:</strong> {{ $jumlahPendaftar }} Orang</span>
                        </div>

                        <div class="flex items-center gap-2 bg-emerald-100 text-emerald-800 px-4 py-2 rounded-xl shadow-sm border border-emerald-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z" />
                            </svg>
                            <span><strong>Kuota Tersedia:</strong> {{ $sisaKuota }} Peserta</span>
                        </div>
                    </section>
                </div>

                <section class="max-w-6xl mx-auto mt-10">
                    <div class="bg-white border-2 border-[#89FFE7] rounded-[40px] p-8 shadow-lg">

                        <div class="flex items-center gap-3 mb-6">
                            <h3 class="text-2xl font-bold text-[#2E7099]">Pendaftar Terbaru</h3>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        {{-- Mengurangi padding menjadi px-4 py-3 --}}
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usia</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl. Daftar</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-48">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($pendaftaranSiswa as $pendaftaran)
                                    <tr>
                                        {{-- Menambah whitespace-nowrap dan mengurangi padding --}}
                                        <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">{{ $loop->iteration }}</td>

                                        <td class="px-4 py-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                                            {{ $pendaftaran->anak->nama_lengkap ?? 'Data Belum Lengkap' }}
                                        </td>

                                        <td class="px-4 py-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                                            @if ($pendaftaran->anak && $pendaftaran->anak->tanggal_lahir)
                                            {{-- Menampilkan usia detail dari accessor --}}
                                            <div>{{ $pendaftaran->anak->usia_detail }}</div>

                                            {{-- Logika warna untuk status usia --}}
                                            @php
                                            $statusUsia = $pendaftaran->anak->status_usia;
                                            $statusClass = '';
                                            if ($statusUsia == 'Memenuhi Syarat') {
                                            $statusClass = 'text-green-700 font-semibold';
                                            } elseif ($statusUsia == 'Tidak Memenuhi Syarat') {
                                            $statusClass = 'text-red-700 font-semibold';
                                            } else {
                                            $statusClass = 'text-gray-500';
                                            }
                                            @endphp
                                            <span class="{{ $statusClass }}">{{ $statusUsia }}</span>
                                            @else
                                            <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $pendaftaran->tanggal_daftar ? \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->format('d M Y') : '-' }}
                                        </td>

                                        <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">
                                            {{ $pendaftaran->jenis_program ?? '-' }}
                                        </td>

                                        <td class="px-4 py-3 whitespace-nowrap">
                                            @php
                                            $statusClass = match($pendaftaran->status){
                                            'Formulir Dikirim' => 'bg-blue-100 text-blue-800',
                                            'Proses Seleksi' => 'bg-yellow-100 text-yellow-800',
                                            'Diterima' => 'bg-green-100 text-green-800',
                                            'Ditolak' => 'bg-red-100 text-red-800',
                                            default => '',
                                            };
                                            @endphp

                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                                {{ $pendaftaran->status }}
                                            </span>
                                        </td>

                                        {{-- Mengatur lebar kolom Aksi dan menggunakan flex untuk elemen di dalamnya --}}
                                        <td class="px-4 py-3 text-right text-sm font-medium whitespace-nowrap w-48">
                                            <form action="{{ route('admin.siswa.updateStatus', $pendaftaran->id_pendaftaran) }}" method="POST" class="flex items-center justify-end gap-2">
                                                @csrf

                                                <select name="status" class="block w-32 text-xs py-1 px-2 border border-gray-300 rounded-md shadow-sm">
                                                    <option value="Proses Seleksi" {{ $pendaftaran->status=='Proses Seleksi'?'selected':'' }}>Proses Seleksi</option>
                                                    <option value="Diterima" {{ $pendaftaran->status=='Diterima'?'selected':'' }}>Diterima</option>
                                                    <option value="Ditolak" {{ $pendaftaran->status=='Ditolak'?'selected':'' }}>Ditolak</option>
                                                </select>

                                                <button type="submit"
                                                    class="px-3 py-1 text-xs font-medium text-white bg-sky-600 rounded-md hover:bg-sky-700">
                                                    Update
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        {{-- Mengurangi padding sel empty state --}}
                                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                            <div class="flex flex-col items-center gap-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
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
                            <a href="{{ route('admin.siswa.index') }}"
                                class="inline-flex items-center gap-2 text-[#2E7099] font-semibold hover:text-[#1a5577]">
                                Lihat Semua Pendaftar
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>

                    </div>
                </section>

                <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 pt-4">

                    <a href="{{ route('admin.company') }}"
                        class="group relative flex items-center gap-3 bg-white border-2 border-[#89FFE7] rounded-[40px] 
                            px-6 py-4 w-fit shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">

                        <div class="bg-[#89FFE7] bg-opacity-20 p-3 rounded-full group-hover:bg-opacity-40 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#2E7099]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7l9-4 9 4-9 4-9-4zm0 0v10a2 2 0 002 2h14a2 2 0 002-2V7M9 21h6" />
                            </svg>
                        </div>

                        <div class="text-left">
                            <span class="text-lg text-[#2E7099] font-bold block">Edit Profil TK</span>
                            <span class="text-xs text-gray-500 block">Edit informasi sekolah</span>
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
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
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