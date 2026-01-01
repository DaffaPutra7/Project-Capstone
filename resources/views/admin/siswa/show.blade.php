<x-app-layout>
    <main class="max-w-4xl mx-auto py-10 px-6">
        {{-- Header Halaman --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-sky-700">
                Detail Pendaftaran Siswa
            </h1>

            {{-- Tombol Kembali --}}
            <a href="{{ route('admin.siswa.index') }}"
               class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-[40px] shadow transition text-sm">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        {{-- Konten Utama --}}
        <section class="relative bg-white border border-[#89FFE7] shadow-sm rounded-[40px] p-8 space-y-4">

            {{-- Ringkasan Data --}}
            <div class="flex flex-col md:flex-row items-center gap-6 mt-6 md:mt-0">
                {{-- Foto Anak --}}
                <div class="flex-shrink-0">
                    @if ($anak->foto_anak)
                        <img src="{{ asset('storage/' . $anak->foto_anak) }}"
                             alt="Foto {{ $anak->nama_lengkap }}"
                             class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow-sm">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 border-4 border-gray-200 text-sm text-center p-2">
                            <span>Belum ada foto</span>
                        </div>
                    @endif
                </div>

                {{-- Ringkasan Informasi --}}
                <div class="space-y-2 flex-1 w-full">
                    <h3 class="text-lg text-sky-700 font-semibold mb-2 border-b pb-2">Ringkasan Data</h3>
                    <p><span class="font-semibold w-36 inline-block">Nama Siswa:</span> {{ $anak->nama_lengkap ?? '...' }}</p>
                    <p><span class="font-semibold w-36 inline-block">Jenis Kelamin:</span> {{ $anak->jenis_kelamin ?? '...' }}</p>
                    <p>
                        <span class="font-semibold w-36 inline-block">Tempat, Tgl Lahir:</span>
                        {{ $anak->tempat_lahir ?? '...' }},
                        {{ $anak->tanggal_lahir ? \Carbon\Carbon::parse($anak->tanggal_lahir)->isoFormat('D MMMM YYYY') : '...' }}
                    </p>
                    <p><span class="font-semibold w-36 inline-block">Jenis Program:</span> {{ $pendaftaran->jenis_program ?? '...' }}</p>
                    
                    {{-- Status Penerimaan --}}
                    <p>
                        <span class="font-semibold w-36 inline-block">Status:</span> 
                        @php
                        $statusClass = match($pendaftaran->status){
                            'Diterima' => 'text-green-600',
                            'Ditolak' => 'text-red-600',
                            default => 'text-yellow-600',
                        };
                        @endphp
                        <span class="font-bold {{ $statusClass }}">{{ $pendaftaran->status }}</span>
                    </p>

                    {{-- Tipe Pendaftaran (Info Tambahan) --}}
                    <p>
                        <span class="font-semibold w-36 inline-block">Tipe Daftar:</span>
                        @if($pendaftaran->tipe_daftar == 'Online')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">
                                🌐 Online
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 border border-orange-200">
                                🏢 Offline
                            </span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- Data Anak --}}
            <div class="mt-4 space-y-2 text-gray-700 border-t border-gray-200 pt-4">
                <h3 class="text-lg text-sky-700 font-semibold mb-2 border-b pb-2">Data Anak</h3>
                <div class="grid md:grid-cols-2 gap-x-4 gap-y-2">
                    <p><span class="font-semibold text-gray-900">Nama Panggilan:</span> <br> {{ $anak->nama_panggilan ?? '-' }}</p>
                    <p><span class="font-semibold text-gray-900">NIK Anak:</span> <br> {{ $anak->nik_anak ?? '-' }}</p>
                    <p><span class="font-semibold text-gray-900">Agama:</span> <br> {{ $anak->agama ?? '-' }}</p>
                    <p><span class="font-semibold text-gray-900">Kewarganegaraan:</span> <br> {{ $anak->kewarganegaraan ?? '-' }}</p>
                    <p><span class="font-semibold text-gray-900">Anak ke-:</span> <br> {{ $anak->anak_ke ?? '-' }}</p>
                    <p><span class="font-semibold text-gray-900">Golongan Darah:</span> <br> {{ $anak->golongan_darah ?? '-' }}</p>
                    <p><span class="font-semibold text-gray-900">Bahasa:</span> <br> {{ $anak->bahasa_sehari_hari ?? '-' }}</p>
                    <p><span class="font-semibold text-gray-900">No. HP (WA):</span> <br> {{ $pendaftaran->no_hp ?? '-' }}</p>
                    <div class="col-span-full">
                        <p><span class="font-semibold text-gray-900">Alamat:</span> <br> {{ $anak->alamat ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Data Orang Tua --}}
            <div class="mt-4 space-y-2 text-gray-700 border-t border-gray-200 pt-4">
                <h3 class="text-lg text-sky-700 font-semibold mb-2 border-b pb-2">Data Orang Tua</h3>
                
                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Data Ayah --}}
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="font-bold text-sky-800 mb-2 border-b border-gray-200 pb-1">👨 Data Ayah</p>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-semibold block text-gray-500">Nama:</span> {{ $anak->nama_ayah ?? '-' }}</p>
                            <p>
                                <span class="font-semibold block text-gray-500">TTL:</span>
                                {{ $anak->tempat_lahir_ayah ?? '-' }},
                                {{ $anak->tanggal_lahir_ayah ? \Carbon\Carbon::parse($anak->tanggal_lahir_ayah)->isoFormat('D MMMM YYYY') : '' }}
                            </p>
                            <p><span class="font-semibold block text-gray-500">Pendidikan:</span> {{ $anak->pendidikan_ayah ?? '-' }}</p>
                            <p><span class="font-semibold block text-gray-500">Pekerjaan:</span> {{ $anak->pekerjaan_ayah ?? '-' }}</p>
                        </div>
                    </div>

                    {{-- Data Ibu --}}
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="font-bold text-pink-800 mb-2 border-b border-gray-200 pb-1">👩 Data Ibu</p>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-semibold block text-gray-500">Nama:</span> {{ $anak->nama_ibu ?? '-' }}</p>
                            <p>
                                <span class="font-semibold block text-gray-500">TTL:</span>
                                {{ $anak->tempat_lahir_ibu ?? '-' }},
                                {{ $anak->tanggal_lahir_ibu ? \Carbon\Carbon::parse($anak->tanggal_lahir_ibu)->isoFormat('D MMMM YYYY') : '' }}
                            </p>
                            <p><span class="font-semibold block text-gray-500">Pendidikan:</span> {{ $anak->pendidikan_ibu ?? '-' }}</p>
                            <p><span class="font-semibold block text-gray-500">Pekerjaan:</span> {{ $anak->pekerjaan_ibu ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Data Wali (opsional) --}}
                @if($anak->nama_wali)
                    <div class="mt-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="font-bold text-gray-800 mb-2 border-b border-gray-200 pb-1">🧓 Data Wali</p>
                        <div class="grid md:grid-cols-2 gap-4 text-sm">
                            <p><span class="font-semibold block text-gray-500">Nama:</span> {{ $anak->nama_wali ?? '-' }}</p>
                            <p><span class="font-semibold block text-gray-500">Pekerjaan:</span> {{ $anak->pekerjaan_wali ?? '-' }}</p>
                        </div>
                    </div>
                @endif
            </div>

        </section>
    </main>
</x-app-layout>