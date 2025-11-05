<x-app-layout>
    <main class="max-w-4xl mx-auto py-10 px-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-sky-700">
                Detail Pendaftaran Siswa
            </h1>
            
            {{-- Tombol Kembali --}}
            <a href="{{ route('admin.siswa.index') }}"
               class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-[40px] shadow transition text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        <section class="relative bg-white border border-[#89FFE7] shadow-sm rounded-[40px] p-8 space-y-4">

            @php
                $status = $pendaftaran->status ?? 'Proses';
                $statusClass = '';
                switch ($status) {
                    case 'Formulir Dikirim': $statusClass = 'bg-blue-100 text-blue-800'; break;
                    case 'Proses Seleksi': $statusClass = 'bg-yellow-100 text-yellow-800'; break;
                    case 'Diterima': $statusClass = 'bg-green-100 text-green-800'; break;
                    case 'Ditolak': $statusClass = 'bg-red-100 text-red-800'; break;
                    default: $statusClass = 'bg-gray-100 text-gray-800'; break;
                }
            @endphp
            <div class="absolute top-4 right-4 px-3 py-1 rounded-full text-sm font-semibold {{ $statusClass }}">
                {{ $status }}
            </div>

            <div class="space-y-2">
                <h3 class="text-lg text-sky-700 font-semibold mb-2 border-b pb-2">Ringkasan Data</h3>
                <p><span class="font-semibold w-36 inline-block">Nama Siswa:</span> {{ $anak->nama_lengkap ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Jenis Kelamin:</span> {{ $anak->jenis_kelamin ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Tempat, Tgl Lahir:</span>
                    {{ $anak->tempat_lahir ?? '...' }},
                    {{ $anak->tanggal_lahir ? \Carbon\Carbon::parse($anak->tanggal_lahir)->isoFormat('D MMMM YYYY') : '...' }}
                </p>
                <p><span class="font-semibold w-36 inline-block">Jenis Program:</span> {{ $pendaftaran->jenis_program ?? '...' }}</p>
            </div>

            <div class="mt-4 space-y-2 text-gray-700 border-t border-gray-200 pt-4">
                <h3 class="text-lg text-sky-700 font-semibold mb-2 border-b pb-2">Data Anak</h3>
                <p><span class="font-semibold w-36 inline-block">Nama Panggilan:</span> {{ $anak->nama_panggilan ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">NIK Anak:</span> {{ $anak->nik_anak ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Agama:</span> {{ $anak->agama ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Kewarganegaraan:</span> {{ $anak->kewarganegaraan ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Anak ke-:</span> {{ $anak->anak_ke ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Golongan Darah:</span> {{ $anak->golongan_darah ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Bahasa:</span> {{ $anak->bahasa_sehari_hari ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">No. HP (WA):</span> {{ $pendaftaran->no_hp ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Alamat:</span> {{ $anak->alamat ?? '...' }}</p>
            </div>

            <div class="mt-4 space-y-2 text-gray-700 border-t border-gray-200 pt-4">
                <h3 class="text-lg text-sky-700 font-semibold mb-2 border-b pb-2">Data Orang Tua</h3>
                
                <p class="mt-4 font-semibold text-gray-800">Data Ayah</p>
                <p><span class="font-semibold w-36 inline-block">Nama:</span> {{ $anak->nama_ayah ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">TTL:</span> {{ $anak->tempat_lahir_ayah ?? '...' }}, {{ $anak->tanggal_lahir_ayah ? \Carbon\Carbon::parse($anak->tanggal_lahir_ayah)->isoFormat('D MMMM YYYY') : '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Pendidikan:</span> {{ $anak->pendidikan_ayah ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Pekerjaan:</span> {{ $anak->pekerjaan_ayah ?? '...' }}</p>

                <p class="mt-4 font-semibold text-gray-800">Data Ibu</p>
                <p><span class="font-semibold w-36 inline-block">Nama:</span> {{ $anak->nama_ibu ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">TTL:</span> {{ $anak->tempat_lahir_ibu ?? '...' }}, {{ $anak->tanggal_lahir_ibu ? \Carbon\Carbon::parse($anak->tanggal_lahir_ibu)->isoFormat('D MMMM YYYY') : '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Pendidikan:</span> {{ $anak->pendidikan_ibu ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Pekerjaan:</span> {{ $anak->pekerjaan_ibu ?? '...' }}</p>
                
                @if($anak->nama_wali)
                <p class="mt-4 font-semibold text-gray-800">Data Wali</p>
                <p><span class="font-semibold w-36 inline-block">Nama:</span> {{ $anak->nama_wali ?? '...' }}</p>
                <p><span class="font-semibold w-36 inline-block">Pekerjaan:</span> {{ $anak->pekerjaan_wali ?? '...' }}</p>
                @endif
            </div>

        </section>
    </main>

    </x-app-layout>