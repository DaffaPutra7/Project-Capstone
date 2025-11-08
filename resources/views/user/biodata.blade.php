<x-app-layout>
    <main class="max-w-4xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold text-sky-700 mb-6">Biodata Siswa</h1>

        <section x-data="{ showDetail: false }" class="relative bg-white border border-[#89FFE7] shadow-sm rounded-[40px] p-8 space-y-4">

            <!-- Status siswa (pojok kanan atas) -->
            @php
            // Ganti $status dummy
            $status = $pendaftaran->status ?? 'Proses'; // nilai: diterima / proses / ditolak
            @endphp
            <div
                x-data="{ status: '{{ $status }}' }"
                class="absolute top-4 right-4 px-3 py-1 rounded-full text-white font-semibold"
                :class="{
                    'bg-green-500': status === 'diterima',
                    'bg-yellow-500': status === 'proses',
                    'bg-red-500': status === 'ditolak'
                }">
                <span x-text="status.charAt(0).toUpperCase() + status.slice(1)"></span>
            </div>

            <!-- Ringkasan -->
            <div class="space-y-2">
                <h3 class="text-sky-700 font-semibold mb-2">Ringkasan Data</h3>
                <p><span class="font-semibold">Nama:</span> {{ $anak->nama_lengkap ?? 'Belum Diisi' }}</p>
                <p><span class="font-semibold">Jenis Kelamin:</span> {{ $anak->jenis_kelamin ?? 'Belum Diisi' }}</p>
                <p><span class="font-semibold">Tempat, Tanggal Lahir:</span>
                    {{ $anak->tempat_lahir ?? '...' }},
                    {{ $anak->tanggal_lahir ? \Carbon\Carbon::parse($anak->tanggal_lahir)->isoFormat('D MMMM YYYY') : '...' }}
                </p>
                <p><span class="font-semibold">Jenis Program:</span> {{ $pendaftaran->jenis_program ?? 'Belum Dipilih' }}</p>
            </div>

            <!-- Detail -->
            <div x-show="showDetail" class="mt-4 space-y-2 text-gray-700 border-t border-gray-200 pt-4">
                <h3 class="text-sky-700 font-semibold mb-2">Detail Data Lengkap</h3>

                <!-- Data Anak -->
                <p>Nama Panggilan: {{ $anak->nama_panggilan ?? '...' }}</p>
                <p>NIK Anak: {{ $anak->nik_anak ?? '...' }}</p>
                <p>Agama: {{ $anak->agama ?? '...' }}</p>
                <p>Kewarganegaraan: {{ $anak->kewarganegaraan ?? '...' }}</p>
                <p>Anak ke-: {{ $anak->anak_ke ?? '...' }}</p>
                <p>Golongan Darah: {{ $anak->golongan_darah ?? '...' }}</p>
                <p>Bahasa Sehari-hari: {{ $anak->bahasa_sehari_hari ?? '...' }}</p>
                <p>No. HP (WA): {{ $pendaftaran->no_hp ?? '...' }}</p>
                <p>Alamat: {{ $anak->alamat ?? '...' }}</p>

                <!-- Data Orang Tua -->
                <p class="mt-4 font-semibold text-sky-700">Data Ayah</p>
                <p>Nama: {{ $anak->nama_ayah ?? '...' }}</p>
                <p>TTL: {{ $anak->tempat_lahir_ayah ?? '...' }}, {{ $anak->tanggal_lahir_ayah ? \Carbon\Carbon::parse($anak->tanggal_lahir_ayah)->isoFormat('D MMMM YYYY') : '...' }}</p>
                <p>Pendidikan: {{ $anak->pendidikan_ayah ?? '...' }}</p>
                <p>Pekerjaan: {{ $anak->pekerjaan_ayah ?? '...' }}</p>

                <p class="mt-4 font-semibold text-sky-700">Data Ibu</p>
                <p>Nama: {{ $anak->nama_ibu ?? '...' }}</p>
                <p>TTL: {{ $anak->tempat_lahir_ibu ?? '...' }}, {{ $anak->tanggal_lahir_ibu ? \Carbon\Carbon::parse($anak->tanggal_lahir_ibu)->isoFormat('D MMMM YYYY') : '...' }}</p>
                <p>Pendidikan: {{ $anak->pendidikan_ibu ?? '...' }}</p>
                <p>Pekerjaan: {{ $anak->pekerjaan_ibu ?? '...' }}</p>

                <!-- Program -->
                <p class="mt-4 font-semibold text-sky-700">Program Pendidikan</p>
                <p>Jenis Program: {{ $pendaftaran->jenis_program ?? 'Belum Dipilih' }}</p>
            </div>

            <!-- Tombol -->
            <div class="pt-4 flex justify-center gap-4">
                <button @click="showDetail = !showDetail"
                    class="bg-sky-600 hover:bg-sky-700 text-white font-semibold py-2 px-6 rounded-[40px] shadow transition">
                    <span x-text="showDetail ? 'Sembunyikan Detail' : 'Detail'"></span>
                </button>
                
                @if ($pendaftaran->status == 'Pengisian Formulir')
                    <a href="{{ route('user.formulir.step1') }}"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-[40px] shadow transition">
                        Edit Data
                    </a>
                @endif
            </div>
        </section>
    </main>

    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>