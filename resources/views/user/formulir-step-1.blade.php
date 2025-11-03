<x-app-layout>
    <main class="max-w-5xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold text-sky-700 mb-6 text-center">Formulir Pendaftaran — Data Anak</h2>

        <form method="POST" action="{{ route('user.formulir.step1.store') }}" class="space-y-6">
            @csrf

            <div class="bg-white border border-[#89FFE7] shadow-md rounded-[30px] p-8 space-y-6">
                <h4 class="text-sky-700 font-semibold">Data Anak</h4>

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
                    'golongan_darah'=>'Golongan Darah'
                    ] as $name => $label)
                    <div>
                        <label class="block text-sm font-semibold mb-2">{{ $label }}</label>
                        <input
                            type="{{ $name === 'tanggal_lahir' ? 'date' : ($name === 'berat_badan' || $name === 'tinggi_badan' || $name === 'anak_ke' ? 'number' : 'text') }}"
                            name="{{ $name }}"
                            value="{{ old($name, $anak->$name) }}"
                            class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]">
                    </div>
                    @endforeach

                    <div>
                        <label class="block text-sm font-semibold mb-2">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ $anak->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $anak->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Kewarganegaraan</label>
                        <select name="kewarganegaraan" class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]">
                            <option value="">-- Pilih --</option>
                            <option value="Indonesia" {{ $anak->kewarganegaraan == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                            <option value="WNA" {{ $anak->kewarganegaraan == 'WNA' ? 'selected' : '' }}>WNA</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Alamat</label>
                    <textarea name="alamat" rows="3" class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]">{{ old('alamat', $anak->alamat) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Riwayat Penyakit</label>
                    <textarea name="riwayat_penyakit" rows="3" class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]">{{ old('riwayat_penyakit', $anak->riwayat_penyakit) }}</textarea>
                </div>
            </div>

            <div class="text-right pt-4">
                <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white font-semibold py-3 px-10 rounded-full transition">
                    Lanjut ke Step 2 →
                </button>
            </div>
        </form>
    </main>
</x-app-layout>