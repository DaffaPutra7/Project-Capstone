<x-app-layout>
    <main class="max-w-7xl mx-auto p-6 space-y-8">
        <section>
            <h1 class="text-4xl font-bold text-sky-700 mb-4">
                Data Pendaftar Siswa
            </h1>
            <p class="text-gray-600">
                Daftar semua calon siswa yang telah mengirimkan formulir pendaftaran.
            </p>
        </section>

        <section class="bg-white shadow-lg rounded-2xl border border-[#89FFE7] overflow-hidden">
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
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                Belum ada data pendaftar yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

    </main>
</x-app-layout>