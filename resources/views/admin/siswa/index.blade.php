<x-app-layout>
    <main class="max-w-none p-6 space-y-8">
        <section class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-4xl font-bold text-sky-700 mb-2">
                    Data Pendaftar Siswa
                </h1>
                <p class="text-gray-600">
                    Daftar semua calon siswa yang telah mengirimkan formulir pendaftaran.
                </p>
            </div>
        </section>

        <section>
            {{-- FORM SORTING --}}
            <div class="mt-2">
                <form action="{{ route('admin.siswa.index') }}" method="GET">
                    <div class="flex items-center gap-3 max-w-sm">
                        <label for="sort" class="text-sm font-medium text-gray-700 flex-shrink-0">
                            Urutkan berdasarkan:
                        </label>
                        <select name="sort" id="sort"
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm"
                            onchange="this.form.submit()">

                            <option value="terbaru" {{ $sort == 'terbaru' ? 'selected' : '' }}>
                                Pendaftar Terbaru
                            </option>
                            <option value="nama_asc" {{ $sort == 'nama_asc' ? 'selected' : '' }}>
                                Nama (A - Z)
                            </option>
                            <option value="usia_syarat" {{ $sort == 'usia_syarat' ? 'selected' : '' }}>
                                Usia (Memenuhi Syarat)
                            </option>
                        </select>
                    </div>
                </form>
            </div>
        </section>

        <section class="bg-white shadow-lg rounded-2xl border border-[#89FFE7] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>

                            {{-- KOLOM NAMA --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Lengkap
                            </th>

                            {{-- KOLOM TIPE DAFTAR (BARU) --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipe
                            </th>

                            {{-- KOLOM TANGGAL LAHIR --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tgl. Lahir
                            </th>

                            {{-- KOLOM USIA --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Usia (Status)
                            </th>

                            {{-- KOLOM TGL. DAFTAR --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tgl. Daftar
                            </th>

                            {{-- KOLOM PROGRAM --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Program
                            </th>

                            {{-- KOLOM STATUS --}}
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>

                            {{-- KOLOM AKSI --}}
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($pendaftaranSiswa as $pendaftaran)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pendaftaranSiswa->firstItem() + $loop->index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $pendaftaran->anak->nama_lengkap ?? 'Data Belum Lengkap' }}
                            </td>

                            {{-- KOLOM TIPE DAFTAR --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($pendaftaran->tipe_daftar == 'Online')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">
                                        🌐 Online
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200">
                                        🏢 Offline
                                    </span>
                                @endif
                            </td>

                            {{-- DATA TANGGAL LAHIR --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($pendaftaran->anak && $pendaftaran->anak->tanggal_lahir)
                                {{ \Carbon\Carbon::parse($pendaftaran->anak->tanggal_lahir)->format('d M Y') }}
                                @else
                                -
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if ($pendaftaran->anak && $pendaftaran->anak->tanggal_lahir)
                                    <div>{{ $pendaftaran->anak->usia_detail }}</div>
                                    @php
                                        $statusUsia = $pendaftaran->anak->status_usia;
                                        $statusClass = match($statusUsia) {
                                            'Memenuhi Syarat' => 'text-green-700 font-semibold',
                                            'Tidak Memenuhi Syarat' => 'text-red-700 font-semibold',
                                            default => 'text-gray-500'
                                        };
                                    @endphp
                                    <span class="{{ $statusClass }}">{{ $statusUsia }}</span>
                                @else
                                    <span class="text-gray-500">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pendaftaran->tanggal_daftar ? \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $pendaftaran->jenis_program ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                $statusClass = match($pendaftaran->status){
                                    'Formulir Dikirim' => 'bg-blue-100 text-blue-800',
                                    'Proses Seleksi' => 'bg-yellow-100 text-yellow-800',
                                    'Diterima' => 'bg-green-100 text-green-800',
                                    'Ditolak' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $pendaftaran->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('admin.siswa.updateStatus', $pendaftaran->id_pendaftaran) }}" method="POST" class="flex items-center justify-end gap-2">
                                    
                                    {{-- Tombol Detail (Selalu Ada) --}}
                                    <a href="{{ route('admin.siswa.show', $pendaftaran->id_pendaftaran) }}"
                                       class="px-3 py-1 text-xs font-medium text-sky-700 bg-sky-100 rounded-md hover:bg-sky-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition">
                                        Detail
                                    </a>
                                    
                                    @csrf

                                    {{-- KONDISI LOGIKA UPDATE STATUS --}}
                                    {{-- 1. Jika Offline: Hilangkan dropdown, karena status biasanya diatur manual / final --}}
                                    @if($pendaftaran->tipe_daftar == 'Offline')
                                        {{-- Jika offline, kita kasih opsi sederhana atau disable saja, tergantung kebutuhan. 
                                             Di sini saya berikan opsi tombol ubah status Manual via form terpisah jika mau, 
                                             tapi sesuai permintaan "hilangin dropdown", saya ganti jadi label saja atau tombol edit khusus. 
                                             Untuk simpelnya, saya hilangkan form update cepatnya. --}}
                                        
                                        {{-- Opsional: Info text --}}
                                        <span class="text-xs text-gray-400 italic ml-2">(Offline)</span>

                                    @else
                                        {{-- 2. Jika Online: Tampilkan dropdown update progress --}}
                                        <select name="status" class="block w-36 text-sm py-1 px-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-sky-500 focus:border-sky-500 transition">
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

                                        <button type="submit" class="px-3 py-1 text-xs font-medium text-white bg-sky-600 rounded-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition">
                                            Update
                                        </button>
                                    @endif

                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span>Belum ada data pendaftar yang masuk.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION LINKS --}}
            <div class="p-4 border-t border-gray-200">
                {{ $pendaftaranSiswa->appends(request()->query())->links() }}
            </div>

        </section>
    </main>
</x-app-layout>