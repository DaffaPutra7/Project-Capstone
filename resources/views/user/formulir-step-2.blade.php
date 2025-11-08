<x-app-layout>
    <main class="max-w-5xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold text-sky-700 mb-6 text-center">Formulir Pendaftaran — Data Orang Tua / Wali</h2>

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

        <form method="POST" action="{{ route('user.formulir.step2.store') }}" class="space-y-6">
            @csrf

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

            <div class="bg-white border border-[#89FFE7] shadow-md rounded-[30px] p-8 space-y-4">
                <h4 class="text-sky-700 font-semibold">👨 Data Ayah</h4>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach([
                    'nama_ayah' => 'Nama Ayah',
                    'tempat_lahir_ayah' => 'Tempat Lahir',
                    'tanggal_lahir_ayah' => 'Tanggal Lahir',
                    'pendidikan_ayah' => 'Pendidikan',
                    'pekerjaan_ayah' => 'Pekerjaan',
                    ] as $name => $label)
                    <div x-data="{ hasTyped: false }">
                        <label for="{{ $name }}" class="block text-sm font-semibold mb-2">{{ $label }}</label>
                        <input
                            id="{{ $name }}"
                            type="{{ str_contains($name, 'tanggal') ? 'date' : 'text' }}"
                            name="{{ $name }}"
                            value="{{ old($name, $anak->$name) }}"
                            @input="hasTyped = true"
                            class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7] @error($name) border-red-500 @enderror">
                        
                        <div x-show="!hasTyped">
                            @error($name)
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white border border-[#89FFE7] shadow-md rounded-[30px] p-8 space-y-4">
                <h4 class="text-sky-700 font-semibold">👩 Data Ibu</h4>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach([
                    'nama_ibu' => 'Nama Ibu',
                    'tempat_lahir_ibu' => 'Tempat Lahir',
                    'tanggal_lahir_ibu' => 'Tanggal Lahir',
                    'pendidikan_ibu' => 'Pendidikan',
                    'pekerjaan_ibu' => 'Pekerjaan',
                    ] as $name => $label)
                    <div x-data="{ hasTyped: false }">
                        <label for="{{ $name }}" class="block text-sm font-semibold mb-2">{{ $label }}</label>
                        <input
                            id="{{ $name }}"
                            type="{{ str_contains($name, 'tanggal') ? 'date' : 'text' }}"
                            name="{{ $name }}"
                            value="{{ old($name, $anak->$name) }}"
                            @input="hasTyped = true"
                            class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7] @error($name) border-red-500 @enderror">
                        
                        <div x-show="!hasTyped">
                            @error($name)
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white border border-[#89FFE7] shadow-md rounded-[30px] p-8 space-y-4">
                <h4 class="text-sky-700 font-semibold">🧓 Data Wali (Opsional)</h4>
                <div class="grid md:grid-cols-2 gap-6">
                    <div x-data="{ hasTyped: false }">
                        <label for="nama_wali" class="block text-sm font-semibold mb-2">Nama Wali</label>
                        <input id="nama_wali" type="text" name="nama_wali" value="{{ old('nama_wali', $anak->nama_wali) }}" 
                                @input="hasTyped = true"
                                class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7] @error('nama_wali') border-red-500 @enderror">
                        
                        <div x-show="!hasTyped">
                            @error('nama_wali')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div x-data="{ hasTyped: false }">
                        <label for="pekerjaan_wali" class="block text-sm font-semibold mb-2">Pekerjaan Wali</label>
                        <input id="pekerjaan_wali" type="text" name="pekerjaan_wali" value="{{ old('pekerjaan_wali', $anak->pekerjaan_wali) }}" 
                                @input="hasTyped = true"
                                class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7] @error('pekerjaan_wali') border-red-500 @enderror">
                        
                        <div x-show="!hasTyped">
                            @error('pekerjaan_wali')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between pt-6">
                <a href="{{ route('user.formulir.step1') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 rounded-full font-semibold">← Kembali</a>
                <button type="submit" class="px-10 py-3 bg-sky-600 text-white font-semibold rounded-full hover:bg-sky-700">Lanjut ke Step 3 →</button>
            </div>
        </form>
    </main>

    {{-- SCRIPT ALPINE.JS --}}
    <script src="//unpkg.com/alpinejs" defer></script>

</x-app-layout>