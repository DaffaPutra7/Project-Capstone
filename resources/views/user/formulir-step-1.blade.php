<x-app-layout>
    <main class="max-w-5xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold text-sky-700 mb-6 text-center">Formulir Pendaftaran — Data Anak</h2>

        {{-- ====================================================== --}}
        {{-- == TAMBAHAN: Boks Info "Jalan Keluar" == --}}
        {{-- ====================================================== --}}
        <div class="flex items-start gap-3 bg-sky-50 border border-sky-200 text-sky-800 p-4 rounded-xl mb-6 shadow-sm">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <strong class="font-semibold">Data Anda Aman!</strong>
                <p class="text-sm">
                    Semua data yang Anda isi tersimpan otomatis. Anda tidak harus menyelesaikan semua sekarang dan bisa kembali ke 
                    <a href="{{ route('user.dashboard') }}" class="font-bold underline hover:text-sky-900">Dashboard</a> 
                    untuk melanjutkannya nanti.
                </p>
            </div>
        </div>
        {{-- ====================================================== --}}
        {{-- == BATAS TAMBAHAN == --}}
        {{-- ====================================================== --}}

        <form method="POST" action="{{ route('user.formulir.step1.store') }}" class="space-y-6">
            @csrf

            <div class="bg-white border border-[#89FFE7] shadow-md rounded-[30px] p-8 space-y-6">
                <h4 class="text-sky-700 font-semibold">Data Anak</h4>

                {{-- TAMPILKAN SEMUA ERROR DI ATAS (UNTUK DEBUGGING) --}}
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-300 text-red-700 p-4 rounded-xl">
                        <strong class="font-bold">Oops! Ada yang salah:</strong>
                        <ul class="list-disc list-inside mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid md:grid-cols-2 gap-6">
                    @foreach([
                    'nama_lengkap'=>'Nama Lengkap',
                    'nama_panggilan'=>'Nama Panggilan',
                    'nik_anak'=>'NIK Anak',
                    'anak_ke'=>'Anak ke-',
                    'nomor_akte'=>'Nomor Akte',
                    'asal_sekolah'=>'Asal Sekolah',
                    'nisn'=>'NISN',
                    'tempat_lahir'=>'Tempat Lahir',
                    'tanggal_lahir'=>'Tanggal Lahir',
                    'agama'=>'Agama',
                    'bahasa_sehari_hari'=>'Bahasa Sehari-hari',
                    'berat_badan'=>'Berat Badan (kg)',
                    'tinggi_badan'=>'Tinggi Badan (cm)',
                    ] as $name => $label)
                    {{-- 1. Tambahkan x-data --}}
                    <div x-data="{ hasTyped: false }">
                        <label for="{{ $name }}" class="block text-sm font-semibold mb-2">{{ $label }}</label>
                        <input
                            id="{{ $name }}"
                            type="{{ $name === 'tanggal_lahir' ? 'date' : ($name === 'berat_badan' || $name === 'tinggi_badan' || $name === 'anak_ke' ? 'number' : 'text') }}"
                            name="{{ $name }}"
                            value="{{ old($name, $anak->$name) }}"
                            @input="hasTyped = true" {{-- 2. Tambahkan @input --}}
                            class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7] @error($name) border-red-500 @enderror">
                        
                        {{-- 3. Bungkus error dengan x-show --}}
                        <div x-show="!hasTyped">
                            @error($name)
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @endforeach

                    <div x-data="{ hasTyped: false }">
                            <label for="golongan_darah" class="block text-sm font-semibold mb-2">Golongan Darah</label>
                            <select id="golongan_darah" name="golongan_darah" 
                                    @change="hasTyped = true" {{-- Gunakan @change untuk select --}}
                                    class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7] @error('golongan_darah') border-red-500 @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="A" {{ old('golongan_darah', $anak->golongan_darah) == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('golongan_darah', $anak->golongan_darah) == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('golongan_darah', $anak->golongan_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('golongan_darah', $anak->golongan_darah) == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                            
                            <div x-show="!hasTyped">
                                @error('golongan_darah')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    {{-- Lakukan hal yang sama untuk <select> --}}
                    <div x-data="{ hasTyped: false }">
                        <label for="jenis_kelamin" class="block text-sm font-semibold mb-2">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" 
                                @change="hasTyped = true" {{-- Gunakan @change untuk select --}}
                                class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7] @error('jenis_kelamin') border-red-500 @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $anak->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        
                        <div x-show="!hasTyped">
                            @error('jenis_kelamin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div x-data="{ hasTyped: false }">
                        <label for="kewarganegaraan" class="block text-sm font-semibold mb-2">Kewarganegaraan</label>
                        <select id="kewarganegaraan" name="kewarganegaraan"
                                @change="hasTyped = true" {{-- Gunakan @change untuk select --}}
                                class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7] @error('kewarganegaraan') border-red-500 @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="Indonesia" {{ old('kewarganegaraan', $anak->kewarganegaraan) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                            <option value="WNA" {{ old('kewarganegaraan', $anak->kewarganegaraan) == 'WNA' ? 'selected' : '' }}>WNA</option>
                        </select>
                        
                        <div x-show="!hasTyped">
                            @error('kewarganegaraan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Lakukan hal yang sama untuk <textarea> --}}
                <div x-data="{ hasTyped: false }">
                    <label for="alamat" class="block text-sm font-semibold mb-2">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3"
                                @input="hasTyped = true"
                                class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7] @error('alamat') border-red-500 @enderror">{{ old('alamat', $anak->alamat) }}</textarea>
                    
                    <div x-show="!hasTyped">
                        @error('alamat')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div x-data="{ hasTyped: false }">
                    <label for="riwayat_penyakit" class="block text-sm font-semibold mb-2">Riwayat Penyakit</label>
                    <textarea id="riwayat_penyakit" name="riwayat_penyakit" rows="3"
                                @input="hasTyped = true"
                                class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7] @error('riwayat_penyakit') border-red-500 @enderror">{{ old('riwayat_penyakit', $anak->riwayat_penyakit) }}</textarea>
                    
                    <div x-show="!hasTyped">
                        @error('riwayat_penyakit')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="text-right pt-4">
                <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white font-semibold py-3 px-10 rounded-full transition">
                    Lanjut ke Step 2 →
                </button>
            </div>
        </form>
    </main>
    
    {{-- SCRIPT ALPINE.JS --}}
    <script src="//unpkg.com/alpinejs" defer></script>

</x-app-layout>