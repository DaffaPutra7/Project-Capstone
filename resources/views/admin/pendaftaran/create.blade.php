<x-app-layout>
    <main class="max-w-5xl mx-auto p-6 space-y-6" x-data>
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-sky-700">Pendaftaran Siswa Baru (Offline)</h1>
            <a href="{{ route('admin.siswa.index') }}" class="text-gray-500 hover:text-sky-700">← Kembali</a>
        </div>

        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            {{ session('error') }}
        </div>
        @endif

        {{-- ERROR SUMMARY --}}
        @if ($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-700 p-4 rounded-xl">
            <strong class="font-bold">Oops! Ada kolom yang belum diisi:</strong>
            <ul class="list-disc list-inside mt-2 text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.pendaftaran.store') }}" enctype="multipart/form-data" class="space-y-8" novalidate>
            @csrf

            {{-- ====================
                 BAGIAN 1: DATA ANAK 
               ====================== --}}
            <section class="bg-white border border-[#89FFE7] rounded-[30px] p-8 shadow-sm space-y-6">
                <h2 class="text-xl font-bold text-sky-700 border-b pb-2">1. Data Lengkap Anak</h2>

                {{-- FOTO ANAK --}}
                <div x-data="{ hasTyped: false, fileName: 'Belum ada foto yang dipilih' }">
                    <label for="foto_anak" class="block text-sm font-semibold mb-2">
                        Foto Anak (3x4)
                    </label>

                    <div class="relative">
                        <input id="foto_anak" type="file" name="foto_anak" accept="image/*" class="hidden"
                            @change="hasTyped = true; fileName = $event.target.files[0] ? $event.target.files[0].name : 'Belum ada foto yang dipilih'">

                        <div class="flex items-center w-full border rounded-lg overflow-hidden bg-gray-50"
                            :class="(!hasTyped && {{ $errors->has('foto_anak') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">

                            <label for="foto_anak" class="cursor-pointer bg-sky-600 text-white font-semibold py-3 px-4 hover:bg-sky-700 transition">
                                Pilih Foto
                            </label>

                            <span class="px-4 text-sm text-gray-600 truncate" x-text="fileName"></span>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF. Maks: 2MB.</p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    @foreach([
                    'nama_lengkap'=>'Nama Lengkap',
                    'nama_panggilan'=>'Nama Panggilan',
                    'nik_anak'=>'NIK Anak',
                    'anak_ke'=>'Anak ke-',
                    'nomor_akte'=>'Nomor Akta Kelahiran',
                    'asal_sekolah'=>'Asal Sekolah (Opsional)',
                    'nisn'=>'NISN (Opsional)',
                    'tempat_lahir'=>'Tempat Lahir',
                    'tanggal_lahir'=>'Tanggal Lahir',
                    'agama'=>'Agama',
                    'bahasa_sehari_hari'=>'Bahasa Sehari-hari',
                    'berat_badan'=>'Berat Badan (kg)',
                    'tinggi_badan'=>'Tinggi Badan (cm)',
                    ] as $name => $label)

                    <div x-data="{ hasTyped: false }">
                        <label for="{{ $name }}" class="block text-sm font-semibold mb-2">
                            {{ $label }}
                            @if(!in_array($name, ['asal_sekolah', 'nisn'])) <span class="text-red-500">*</span> @endif
                        </label>

                        @if($name === 'agama')
                        <select id="{{ $name }}" name="{{ $name }}" required @change="hasTyped = true"
                            class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                            :class="(!hasTyped && {{ $errors->has($name) ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                            <option value="">-- Pilih Agama --</option>
                            @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'] as $agm)
                            <option value="{{ $agm }}" {{ old($name) == $agm ? 'selected' : '' }}>{{ $agm }}</option>
                            @endforeach
                        </select>

                        @else
                        <input id="{{ $name }}"
                            type="{{ $name === 'tanggal_lahir' ? 'date' : ($name === 'berat_badan' || $name === 'tinggi_badan' || $name === 'anak_ke' ? 'number' : 'text') }}"
                            name="{{ $name }}" value="{{ old($name) }}" @input="hasTyped = true"
                            {{ !in_array($name, ['asal_sekolah', 'nisn']) ? 'required' : '' }}
                            
                            {{-- Validasi Khusus Angka (Max 3 Digit untuk BB/TB, Max 2 Digit untuk Anak ke-) --}}
                            @if($name === 'berat_badan' || $name === 'tinggi_badan')
                                max="999" min="0" oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);"
                            @elseif($name === 'anak_ke')
                                max="99" min="1" oninput="if(this.value.length > 2) this.value = this.value.slice(0, 2);"
                            @elseif($name === 'nik_anak')
                                oninput="if(this.value.length > 16) this.value = this.value.slice(0, 16);"
                            @endif

                            class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                            :class="(!hasTyped && {{ $errors->has($name) ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                        @endif

                        <div x-show="!hasTyped">
                            @error($name) <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    @endforeach

                    {{-- GOLONGAN DARAH --}}
                    <div x-data="{ hasTyped: false }">
                        <label for="golongan_darah" class="block text-sm font-semibold mb-2">Golongan Darah <span class="text-red-500">*</span></label>
                        <select id="golongan_darah" name="golongan_darah" required @change="hasTyped = true"
                            class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                            :class="(!hasTyped && {{ $errors->has('golongan_darah') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                            <option value="">-- Pilih --</option>
                            <option value="A" {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>B</option>
                            <option value="AB" {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>AB</option>
                            <option value="O" {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>O</option>
                        </select>
                    </div>

                    {{-- JENIS KELAMIN --}}
                    <div x-data="{ hasTyped: false }">
                        <label for="jenis_kelamin" class="block text-sm font-semibold mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required @change="hasTyped = true"
                            class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                            :class="(!hasTyped && {{ $errors->has('jenis_kelamin') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- KEWARGANEGARAAN --}}
                    <div x-data="{ hasTyped: false }">
                        <label for="kewarganegaraan" class="block text-sm font-semibold mb-2">Kewarganegaraan <span class="text-red-500">*</span></label>
                        <select id="kewarganegaraan" name="kewarganegaraan" required @change="hasTyped = true"
                            class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                            :class="(!hasTyped && {{ $errors->has('kewarganegaraan') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                            <option value="">-- Pilih --</option>
                            <option value="Indonesia" {{ old('kewarganegaraan') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                            <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA</option>
                        </select>
                    </div>
                </div>

                {{-- ALAMAT & RIWAYAT PENYAKIT --}}
                <div class="space-y-4">
                    <div x-data="{ hasTyped: false }">
                        <label for="alamat" class="block text-sm font-semibold mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea id="alamat" name="alamat" rows="2" required @input="hasTyped = true"
                            class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                            :class="(!hasTyped && {{ $errors->has('alamat') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">{{ old('alamat') }}</textarea>
                    </div>

                    <div x-data="{ hasTyped: false }">
                        <label for="riwayat_penyakit" class="block text-sm font-semibold mb-2">Riwayat Penyakit (Opsional)</label>
                        <textarea id="riwayat_penyakit" name="riwayat_penyakit" rows="2" @input="hasTyped = true"
                            class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]">{{ old('riwayat_penyakit') }}</textarea>
                    </div>
                </div>
            </section>

            {{-- =========================
                 BAGIAN 2: DATA ORANG TUA
               =========================== --}}
            <section class="bg-white border border-[#89FFE7] rounded-[30px] p-8 shadow-sm space-y-8">
                <h2 class="text-xl font-bold text-sky-700 border-b pb-2">2. Data Orang Tua / Wali</h2>

                {{-- DATA AYAH --}}
                <div class="space-y-4">
                    <h4 class="text-sky-700 font-semibold border-l-4 border-sky-400 pl-3">👨 Data Ayah</h4>
                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach([
                        'nama_ayah' => 'Nama Ayah',
                        'tempat_lahir_ayah' => 'Tempat Lahir',
                        'tanggal_lahir_ayah' => 'Tanggal Lahir',
                        'pendidikan_ayah' => 'Pendidikan',
                        'pekerjaan_ayah' => 'Pekerjaan (Opsional)',
                        ] as $name => $label)
                        <div x-data="{ hasTyped: false }">
                            <label for="{{ $name }}" class="block text-sm font-semibold mb-2">
                                {{ $label }} @if(!str_contains($label, 'Opsional')) <span class="text-red-500">*</span> @endif
                            </label>

                            @if(str_contains($name, 'pendidikan'))
                            <select id="{{ $name }}" name="{{ $name }}" required @change="hasTyped = true"
                                class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                                :class="(!hasTyped && {{ $errors->has($name) ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                                <option value="">-- Pilih Pendidikan --</option>
                                @foreach(['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3', 'Tidak Sekolah'] as $edu)
                                <option value="{{ $edu }}" {{ old($name) == $edu ? 'selected' : '' }}>{{ $edu }}</option>
                                @endforeach
                            </select>
                            @else
                            <input id="{{ $name }}" type="{{ str_contains($name, 'tanggal') ? 'date' : 'text' }}"
                                name="{{ $name }}" value="{{ old($name) }}" @input="hasTyped = true"
                                {{ !str_contains($label, 'Opsional') ? 'required' : '' }}
                                class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                                :class="(!hasTyped && {{ $errors->has($name) ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-dashed border-gray-300"></div>

                {{-- DATA IBU --}}
                <div class="space-y-4">
                    <h4 class="text-sky-700 font-semibold border-l-4 border-pink-400 pl-3">👩 Data Ibu</h4>
                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach([
                        'nama_ibu' => 'Nama Ibu',
                        'tempat_lahir_ibu' => 'Tempat Lahir',
                        'tanggal_lahir_ibu' => 'Tanggal Lahir',
                        'pendidikan_ibu' => 'Pendidikan',
                        'pekerjaan_ibu' => 'Pekerjaan (Opsional)',
                        ] as $name => $label)
                        <div x-data="{ hasTyped: false }">
                            <label for="{{ $name }}" class="block text-sm font-semibold mb-2">
                                {{ $label }} @if(!str_contains($label, 'Opsional')) <span class="text-red-500">*</span> @endif
                            </label>

                            @if(str_contains($name, 'pendidikan'))
                            <select id="{{ $name }}" name="{{ $name }}" required @change="hasTyped = true"
                                class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                                :class="(!hasTyped && {{ $errors->has($name) ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                                <option value="">-- Pilih Pendidikan --</option>
                                @foreach(['SD', 'SMP', 'SMA', 'S1', 'S2', 'S3', 'Tidak Sekolah'] as $edu)
                                <option value="{{ $edu }}" {{ old($name) == $edu ? 'selected' : '' }}>{{ $edu }}</option>
                                @endforeach
                            </select>
                            @else
                            <input id="{{ $name }}" type="{{ str_contains($name, 'tanggal') ? 'date' : 'text' }}"
                                name="{{ $name }}" value="{{ old($name) }}" @input="hasTyped = true"
                                {{ !str_contains($label, 'Opsional') ? 'required' : '' }}
                                class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                                :class="(!hasTyped && {{ $errors->has($name) ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-dashed border-gray-300"></div>

                {{-- DATA WALI --}}
                <div class="space-y-4">
                    <h4 class="text-sky-700 font-semibold border-l-4 border-gray-400 pl-3">🧓 Data Wali (Opsional)</h4>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div x-data="{ hasTyped: false }">
                            <label for="nama_wali" class="block text-sm font-semibold mb-2">Nama Wali</label>
                            <input id="nama_wali" type="text" name="nama_wali" value="{{ old('nama_wali') }}" @input="hasTyped = true"
                                class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                                :class="(!hasTyped && {{ $errors->has('nama_wali') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                        </div>
                        <div x-data="{ hasTyped: false }">
                            <label for="pekerjaan_wali" class="block text-sm font-semibold mb-2">Pekerjaan Wali</label>
                            <input id="pekerjaan_wali" type="text" name="pekerjaan_wali" value="{{ old('pekerjaan_wali') }}" @input="hasTyped = true"
                                class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                                :class="(!hasTyped && {{ $errors->has('pekerjaan_wali') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                        </div>
                    </div>
                </div>
            </section>

            {{-- ==========================
                 BAGIAN 3: PROGRAM SEKOLAH
               ============================ --}}
            <section class="bg-white border border-[#89FFE7] rounded-[30px] p-8 shadow-sm space-y-6">
                <h2 class="text-xl font-bold text-sky-700 border-b pb-2">3. Pilih Program & Kontak</h2>

                {{-- NOMOR HP --}}
                <div x-data="{ hasTyped: false }">
                    <label for="no_hp" class="block text-sm font-semibold mb-2">Nomor HP (Aktif) <span class="text-red-500">*</span></label>
                    <input id="no_hp" type="text" inputmode="numeric" name="no_hp" value="{{ old('no_hp') }}" required @input="hasTyped = true"
                        placeholder="Contoh: 081234567890"
                        oninput="if(this.value.length > 20) this.value = this.value.slice(0, 20);"
                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                        :class="(!hasTyped && {{ $errors->has('no_hp') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                </div>

                {{-- JENIS PROGRAM --}}
                <div x-data="{ hasTyped: false }">
                    <label class="block text-sm font-semibold mb-2">Pilih Program <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2"
                        :class="(!hasTyped && {{ $errors->has('jenis_program') ? 'true' : 'false' }}) ? 'p-2 border border-red-500 rounded-xl bg-red-50' : ''">

                        {{-- REGULER --}}
                        <div class="relative rounded-xl border p-4 transition-all {{ $isRegulerFull ? 'bg-gray-100 border-gray-200 opacity-60 cursor-not-allowed' : 'bg-white border-gray-200 hover:border-sky-400 hover:shadow-md cursor-pointer' }}">
                            <label class="flex items-start gap-3 w-full h-full {{ $isRegulerFull ? 'pointer-events-none' : 'cursor-pointer' }}">
                                <input type="radio" name="jenis_program" value="Reguler" required @change="hasTyped = true" {{ $isRegulerFull ? 'disabled' : '' }}
                                    class="mt-1 text-sky-600 focus:ring-sky-500 {{ $isRegulerFull ? 'text-gray-400' : '' }}" {{ old('jenis_program') == 'Reguler' ? 'checked' : '' }}>
                                <div class="flex-1">
                                    <span class="font-bold block text-gray-800 text-lg">Reguler</span>
                                    <p class="text-xs text-gray-500 mb-2">Program belajar standar Senin - Jumat.</p>
                                    @if($isRegulerFull)
                                    <span class="inline-block text-[10px] font-bold text-white bg-red-500 px-2 py-1 rounded">KUOTA PENUH</span>
                                    @else
                                    <span class="inline-block text-[10px] font-bold text-emerald-700 bg-emerald-100 border border-emerald-200 px-2 py-1 rounded">
                                        Sisa Kuota: {{ $sisaReguler }}
                                    </span>
                                    @endif
                                </div>
                            </label>
                        </div>

                        {{-- FULL DAY --}}
                        <div class="relative rounded-xl border p-4 transition-all {{ $isFullDayFull ? 'bg-gray-100 border-gray-200 opacity-60 cursor-not-allowed' : 'bg-white border-gray-200 hover:border-sky-400 hover:shadow-md cursor-pointer' }}">
                            <label class="flex items-start gap-3 w-full h-full {{ $isFullDayFull ? 'pointer-events-none' : 'cursor-pointer' }}">
                                <input type="radio" name="jenis_program" value="Full Day" required @change="hasTyped = true" {{ $isFullDayFull ? 'disabled' : '' }}
                                    class="mt-1 text-sky-600 focus:ring-sky-500 {{ $isFullDayFull ? 'text-gray-400' : '' }}" {{ old('jenis_program') == 'Full Day' ? 'checked' : '' }}>
                                <div class="flex-1">
                                    <span class="font-bold block text-gray-800 text-lg">Full Day</span>
                                    <p class="text-xs text-gray-500 mb-2">Program belajar + pengasuhan sore.</p>
                                    @if($isFullDayFull)
                                    <span class="inline-block text-[10px] font-bold text-white bg-red-500 px-2 py-1 rounded">KUOTA PENUH</span>
                                    @else
                                    <span class="inline-block text-[10px] font-bold text-emerald-700 bg-emerald-100 border border-emerald-200 px-2 py-1 rounded">
                                        Sisa Kuota: {{ $sisaFullDay }}
                                    </span>
                                    @endif
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </section>

            <div class="flex justify-end gap-4">
                <a href="{{ route('admin.siswa.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-10 py-3 bg-sky-700 text-white font-bold rounded-xl hover:bg-sky-800 shadow-lg transition">
                    Simpan Pendaftaran
                </button>
            </div>

        </form>
    </main>
    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>