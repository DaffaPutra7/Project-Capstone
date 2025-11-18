<x-app-layout>
    <main class="max-w-none p-6 space-y-8">
        <section>
            <h1 class="text-4xl font-bold text-sky-700 mb-4">
                Data Pendaftar Siswa
            </h1>
            <p class="text-gray-600">
                Daftar semua calon siswa yang telah mengirimkan formulir pendaftaran.
            </p>

            {{-- FORM SORTING --}}
            <div class="mt-6">
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

                            {{-- KOLOM BARU: TANGGAL LAHIR --}}
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
                                {{-- Nomor urut sesuai pagination --}}
                                {{ $pendaftaranSiswa->firstItem() + $loop->index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{-- Akses data anak melalui relasi --}}
                                {{ $pendaftaran->anak->nama_lengkap ?? 'Data Belum Lengkap' }}
                            </td>

                            {{-- DATA TANGGAL LAHIR (Kolom Baru) --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($pendaftaran->anak && $pendaftaran->anak->tanggal_lahir)
                                {{ \Carbon\Carbon::parse($pendaftaran->anak->tanggal_lahir)->format('d M Y') }}
                                @else
                                -
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm">
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
                                default: $statusClass = 'bg-gray-100 text-gray-800'; break; // Tambahkan default
                                }
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $pendaftaran->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('admin.siswa.updateStatus', $pendaftaran->id_pendaftaran) }}" method="POST" class="flex items-center justify-end gap-2">

                                    <a href="{{ route('admin.siswa.show', $pendaftaran->id_pendaftaran) }}"
                                        class="px-3 py-1 text-xs font-medium text-sky-700 bg-sky-100 rounded-md hover:bg-sky-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                                        Detail
                                    </a>
                                    @csrf

                                    {{-- Dropdown untuk memilih status --}}
                                    <select name="status" class="block w-36 text-sm py-1 px-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-sky-500 focus:border-sky-500">
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
                            {{-- Colspan diubah menjadi 8 karena ada penambahan kolom Tgl. Lahir --}}
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                Belum ada data pendaftar yang masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION LINKS --}}
            <div class="p-4 border-t border-gray-200">
                {{-- 'appends' penting agar parameter 'sort' tidak hilang saat pindah halaman --}}
                {{ $pendaftaranSiswa->appends(request()->query())->links() }}
            </div>

        </section>

    </main>
</x-app-layout>