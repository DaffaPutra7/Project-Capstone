<x-app-layout>
    <main class="max-w-5xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold text-sky-700 mb-6 text-center">Formulir Pendaftaran — Data Orang Tua / Wali</h2>

        <form method="POST" action="{{ route('user.formulir.step2.store') }}" class="space-y-6">
            @csrf

            <!-- Data Ayah -->
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
                    <div>
                        <label class="block text-sm font-semibold mb-2">{{ $label }}</label>
                        <input
                            type="{{ str_contains($name, 'tanggal') ? 'date' : 'text' }}"
                            name="{{ $name }}"
                            value="{{ old($name, $anak->$name) }}"
                            class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Data Ibu -->
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
                    <div>
                        <label class="block text-sm font-semibold mb-2">{{ $label }}</label>
                        <input
                            type="{{ str_contains($name, 'tanggal') ? 'date' : 'text' }}"
                            name="{{ $name }}"
                            value="{{ old($name, $anak->$name) }}"
                            class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Data Wali -->
            <div class="bg-white border border-[#89FFE7] shadow-md rounded-[30px] p-8 space-y-4">
                <h4 class="text-sky-700 font-semibold">🧓 Data Wali (Opsional)</h4>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2">Nama Wali</label>
                        <input type="text" name="nama_wali" value="{{ old('nama_wali', $anak->nama_wali) }}" class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2">Pekerjaan Wali</label>
                        <input type="text" name="pekerjaan_wali" value="{{ old('pekerjaan_wali', $anak->pekerjaan_wali) }}" class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]">
                    </div>
                </div>
            </div>

            <div class="flex justify-between pt-6">
                <a href="{{ route('user.formulir.step1') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 rounded-full font-semibold">← Kembali</a>
                <button type="submit" class="px-10 py-3 bg-sky-600 text-white font-semibold rounded-full hover:bg-sky-700">Lanjut ke Step 3 →</button>
            </div>
        </form>
    </main>
</x-app-layout>