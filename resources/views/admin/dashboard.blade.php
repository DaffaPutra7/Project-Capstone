<x-app-layout>
    {{-- Kita bungkus main content dengan x-data untuk state modal --}}
    <main class="space-y-14" x-data="{ showModalTahun: false }">

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

                        <form method="GET" action="{{ route('admin.dashboard') }}" class="relative inline-block mt-6">
                            <select id="tahun" name="tahun" onchange="this.form.submit()"
                                class="block w-full max-w-xs appearance-none rounded-[50px] border-2 border-[#89FFE7] px-4 py-2.5 pr-10 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-sky-400 bg-white hover:bg-gray-50 transition-all cursor-pointer shadow-sm">

                                {{-- $semuaTahun berasal dari Controller (Data DB) --}}
                                @foreach($semuaTahun as $th)
                                <option value="{{ $th->tahun }}" {{ ($tahunAktif && $tahunAktif->tahun == $th->tahun) ? 'selected' : '' }}>
                                    {{ $th->tahun }}
                                </option>
                                @endforeach

                            </select>

                            <div class="absolute inset-y-0 right-0 flex items-center px-3 text-[#2E7099] pointer-events-none">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </form>
                    </div>
                    <img src="{{ asset('images/logo-TK-Aisyiyah.png') }}" alt="Logo Sekolah" class="w-24 sm:w-28 h-auto">
                </section>

                <section class="flex flex-col sm:flex-row justify-start items-start sm:items-center flex-wrap gap-2 text-sm bg-white border-x border-b border-[#89FFE7] rounded-b-2xl shadow-md px-6 py-3">
                    <div class="flex items-center gap-2 bg-sky-100 text-sky-800 px-4 py-2 rounded-xl shadow-sm border border-sky-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 10a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                        <span><strong>Jumlah Pendaftar:</strong> {{ $jumlahPendaftar }} Orang</span>
                    </div>

                    <div class="flex items-center gap-2 bg-emerald-100 text-emerald-800 px-4 py-2 rounded-xl shadow-sm border border-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z" />
                        </svg>
                        <span><strong>Kuota Tersedia:</strong> {{ $sisaKuota }} Peserta</span>
                    </div>
                </section>
            </div>

            {{-- TABEL PENDAFTAR --}}
            <section class="max-w-6xl mx-auto mt-10">
                <div class="bg-white border-2 border-[#89FFE7] rounded-[40px] p-8 shadow-lg">

                    <div class="flex items-center gap-3 mb-6">
                        <h3 class="text-2xl font-bold text-[#2E7099]">Pendaftar Terbaru</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
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
                                    <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 whitespace-nowrap">
                                        {{ $pendaftaran->anak->nama_lengkap ?? 'Data Belum Lengkap' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 whitespace-nowrap">
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
                                    <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $pendaftaran->tanggal_daftar ? \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500 whitespace-nowrap">
                                        {{ $pendaftaran->jenis_program ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @php
                                        $statusBadge = match($pendaftaran->status){
                                        'Formulir Dikirim' => 'bg-blue-100 text-blue-800',
                                        'Proses Seleksi' => 'bg-yellow-100 text-yellow-800',
                                        'Diterima' => 'bg-green-100 text-green-800',
                                        'Ditolak' => 'bg-red-100 text-red-800',
                                        default => '',
                                        };
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusBadge }}">
                                            {{ $pendaftaran->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-right text-sm font-medium whitespace-nowrap w-48">
                                        <form action="{{ route('admin.siswa.updateStatus', $pendaftaran->id_pendaftaran) }}" method="POST" class="flex items-center justify-end gap-2">
                                            @csrf
                                            <select name="status" class="block w-32 text-xs py-1 px-2 border border-gray-300 rounded-md shadow-sm">
                                                <option value="Proses Seleksi" {{ $pendaftaran->status=='Proses Seleksi'?'selected':'' }}>Proses Seleksi</option>
                                                <option value="Diterima" {{ $pendaftaran->status=='Diterima'?'selected':'' }}>Diterima</option>
                                                <option value="Ditolak" {{ $pendaftaran->status=='Ditolak'?'selected':'' }}>Ditolak</option>
                                            </select>
                                            <button type="submit" class="px-3 py-1 text-xs font-medium text-white bg-sky-600 rounded-md hover:bg-sky-700">Update</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                        <div class="flex flex-col items-center gap-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <span>Belum ada data pendaftar pada tahun ajaran ini</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 text-center">
                        <a href="{{ route('admin.siswa.index') }}" class="inline-flex items-center gap-2 text-[#2E7099] font-semibold hover:text-[#1a5577]">
                            Lihat Semua Pendaftar
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>

            <section class="max-w-6xl mx-auto pt-8 pb-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 justify-center items-stretch">

                    <a href="{{ route('admin.company') }}"
                        class="group relative flex items-center gap-4 bg-white border-2 border-[#89FFE7] rounded-[30px] px-8 py-6 w-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:border-sky-300">
                        <div class="bg-[#89FFE7] bg-opacity-20 p-4 rounded-full group-hover:bg-opacity-40 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#2E7099]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9-4 9 4-9 4-9-4zm0 0v10a2 2 0 002 2h14a2 2 0 002-2V7M9 21h6" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <span class="text-xl text-[#2E7099] font-bold block mb-1">Edit Profil TK</span>
                            <span class="text-sm text-gray-500 block">Perbarui informasi sekolah, alamat, dan kontak.</span>
                        </div>
                    </a>

                    <button type="button" @click="showModalTahun = true"
                        class="group relative flex items-center gap-4 bg-white border-2 border-[#89FFE7] rounded-[30px] px-8 py-6 w-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 hover:border-sky-300 text-left cursor-pointer">
                        <div class="bg-[#89FFE7] bg-opacity-20 p-4 rounded-full group-hover:bg-opacity-40 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#2E7099]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="text-left w-full">
                            <span class="text-xl text-[#2E7099] font-bold block mb-1">Kelola Tahun Ajaran</span>
                            <span class="text-sm text-gray-500 block">
                                {{ $tahunAktif ? 'Aktif: '.$tahunAktif->tahun : 'Atur Tahun Ajaran Baru' }}
                            </span>
                        </div>
                    </button>

                    <a href="{{ route('admin.guru.index') }}"
                        class="group relative flex items-center gap-4 bg-white border-2 border-[#89FFE7]
          rounded-[30px] px-8 py-6 w-full shadow-lg hover:shadow-xl
          transition-all duration-300 transform hover:-translate-y-1 hover:border-sky-300">

                        <div class="bg-[#89FFE7] bg-opacity-20 p-4 rounded-full
                group-hover:bg-opacity-40 transition-all shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-8 w-8 text-[#2E7099]"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 10a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 100-8 4 4 0 000 8z" />
                            </svg>
                        </div>

                        <div class="text-left">
                            <span class="text-xl text-[#2E7099] font-bold block mb-1">
                                Kelola Guru
                            </span>
                            <span class="text-sm text-gray-500 block">
                                Tambah, edit, dan atur data guru
                            </span>
                        </div>
                    </a>

                </div>
            </section>
        </main>

        {{-- MODAL KELOLA TAHUN AJARAN --}}
        <div x-show="showModalTahun"
            style="display: none;"
            class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">

            <div x-show="showModalTahun"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                @click="showModalTahun = false"></div>

            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">

                <div x-show="showModalTahun"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border-2 border-[#89FFE7]">

                    {{-- Form mengarah ke route baru (Save/UpdateOrCreate) --}}
                    <form action="{{ route('admin.tahun-ajaran.save') }}" method="POST">
                        @csrf

                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-[#89FFE7] bg-opacity-30 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-[#2E7099]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-xl font-bold leading-6 text-[#2E7099]" id="modal-title">
                                        Kelola Kuota Tahun Ajaran
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1">Pilih tahun ajaran untuk diedit atau tambahkan tahun baru.</p>

                                    <div class="mt-4 space-y-4">

                                        <div>
                                            <label for="tahun" class="block text-sm font-medium leading-6 text-gray-900">Tahun Ajaran</label>
                                            <select name="tahun" id="tahun_modal" class="mt-1 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">
                                                {{-- $semuaOpsiTahun dikirim dari AdminController (Isinya tahun DB + 3 tahun kedepan) --}}
                                                @foreach($semuaOpsiTahun as $opt)
                                                <option value="{{ $opt }}" {{ ($tahunAktif && $tahunAktif->tahun == $opt) ? 'selected' : '' }}>
                                                    {{ $opt }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label for="kuota_full_day" class="block text-sm font-medium leading-6 text-gray-900">Kuota Full Day</label>
                                            <div class="mt-1">
                                                <input type="number" name="kuota_full_day" id="kuota_full_day"
                                                    value="{{ $tahunAktif->kuota_full_day ?? 0 }}"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">
                                            </div>
                                        </div>

                                        {{-- Input Kuota Reguler --}}
                                        <div>
                                            <label for="kuota_reguler" class="block text-sm font-medium leading-6 text-gray-900">Kuota Reguler</label>
                                            <div class="mt-1">
                                                <input type="number" name="kuota_reguler" id="kuota_reguler"
                                                    value="{{ $tahunAktif->kuota_reguler ?? 0 }}"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 rounded-b-2xl">
                            <button type="submit" class="inline-flex w-full justify-center rounded-md bg-[#2E7099] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sky-700 sm:ml-3 sm:w-auto">Simpan / Buat Baru</button>
                            <button type="button" @click="showModalTahun = false" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

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

    </main>
</x-app-layout>