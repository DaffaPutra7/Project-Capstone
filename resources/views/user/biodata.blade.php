<x-app-layout>
    <main class="max-w-4xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold text-sky-700 mb-6">Biodata Siswa</h1>

        <section x-data="{ showDetail: false }" class="relative bg-white border border-[#89FFE7] shadow-sm rounded-[40px] p-8 space-y-4">

            <!-- Status siswa (pojok kanan atas) -->
            @php
                // Dummy status, nanti dari admin/controller
                $status = $siswa['status'] ?? 'proses'; // nilai: diterima / proses / ditolak
            @endphp
            <div class="absolute top-4 right-4 px-3 py-1 rounded-full text-white font-semibold"
                :class="{
                    'bg-green-500': '{{ $status }}' === 'diterima',
                    'bg-yellow-500': '{{ $status }}' === 'proses',
                    'bg-red-500': '{{ $status }}' === 'ditolak'
                }">
                {{ ucfirst($status) }}
            </div>

            <!-- Ringkasan -->
            <div class="space-y-2">
                <h3 class="text-sky-700 font-semibold mb-2">Ringkasan Data</h3>
                <p><span class="font-semibold">Nama:</span> {{ $anak['nama_lengkap'] ?? 'Ahmad Rafi' }}</p>
                <p><span class="font-semibold">Jenis Kelamin:</span> {{ $anak['jk'] ?? 'Laki-laki' }}</p>
                <p><span class="font-semibold">Tempat, Tanggal Lahir:</span> {{ $anak['ttl'] ?? 'Cilacap, 14 Mei 2020' }}</p>
                <p><span class="font-semibold">Jenis Program:</span> {{ $program['jenis'] ?? 'Full Day' }}</p>
            </div>

            <!-- Detail -->
            <div x-show="showDetail" class="mt-4 space-y-2 text-gray-700 border-t border-gray-200 pt-4">
                <h3 class="text-sky-700 font-semibold mb-2">Detail Data Lengkap</h3>
                
                <!-- Data Anak -->
                <p>Nama Panggilan: {{ $anak['nama_panggilan'] ?? 'Rafi' }}</p>
                <p>NIK Anak: {{ $anak['nik'] ?? '3275011234567890' }}</p>
                <p>Agama: {{ $anak['agama'] ?? 'Islam' }}</p>
                <p>Kewarganegaraan: {{ $anak['kewarganegaraan'] ?? 'Indonesia' }}</p>
                <p>Anak ke-: {{ $anak['anak_ke'] ?? '2' }}</p>
                <p>Golongan Darah: {{ $anak['gol_darah'] ?? 'O' }}</p>
                <p>Bahasa Sehari-hari: {{ $anak['bahasa'] ?? 'Bahasa Indonesia' }}</p>
                <p>No. HP (WA): {{ $anak['hp'] ?? '08123456789' }}</p>
                <p>Alamat: {{ $anak['alamat'] ?? 'Jl. Merdeka No. 12, Banjareja' }}</p>

                <!-- Data Orang Tua -->
                <p class="mt-4 font-semibold text-sky-700">Data Ayah</p>
                <p>Nama: {{ $ortu['ayah']['nama'] ?? 'Budi Santoso' }}</p>
                <p>TTL: {{ $ortu['ayah']['ttl'] ?? 'Cilacap, 10 Juli 1985' }}</p>
                <p>Pendidikan: {{ $ortu['ayah']['pendidikan'] ?? 'S1' }}</p>
                <p>Pekerjaan: {{ $ortu['ayah']['pekerjaan'] ?? 'Guru' }}</p>

                <p class="mt-4 font-semibold text-sky-700">Data Ibu</p>
                <p>Nama: {{ $ortu['ibu']['nama'] ?? 'Siti Aminah' }}</p>
                <p>TTL: {{ $ortu['ibu']['ttl'] ?? 'Banyumas, 20 April 1987' }}</p>
                <p>Pendidikan: {{ $ortu['ibu']['pendidikan'] ?? 'SMA' }}</p>
                <p>Pekerjaan: {{ $ortu['ibu']['pekerjaan'] ?? 'Ibu Rumah Tangga' }}</p>

                <!-- Program -->
                <p class="mt-4 font-semibold text-sky-700">Program Pendidikan</p>
                <p>Jenis Program: {{ $program['jenis'] ?? 'Full Day' }}</p>
            </div>

            <!-- Tombol -->
            <div class="pt-4 flex justify-center gap-4">
                <button @click="showDetail = !showDetail"
                        class="bg-sky-600 hover:bg-sky-700 text-white font-semibold py-2 px-6 rounded-[40px] shadow transition">
                    <span x-text="showDetail ? 'Sembunyikan Detail' : 'Detail'"></span>
                </button>

                <a href="/formulir"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-[40px] shadow transition">
                    Edit Data
                </a>
            </div>
        </section>
    </main>

    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
