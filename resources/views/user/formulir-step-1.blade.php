<x-app-layout>
    <main class="max-w-5xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold text-sky-700 mb-6 text-center">
            Formulir Pendaftaran — Data Anak
        </h2>

        {{-- INFO BOX --}}
        <div class="flex items-start gap-3 bg-sky-50 border border-sky-200 text-sky-800 p-4 rounded-xl mb-6 shadow-sm">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 
                          0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <strong class="font-semibold">Data Anda Aman!</strong>
                <p class="text-sm">
                    Semua data yang Anda isi tersimpan otomatis. Anda tidak harus menyelesaikan semua sekarang dan bisa kembali ke
                    <a href="{{ route('user.dashboard') }}" class="font-bold underline hover:text-sky-900">
                        Dashboard
                    </a>
                    untuk melanjutkannya nanti.
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('user.formulir.step1.store') }}" enctype="multipart/form-data" class="space-y-6" novalidate>
            @csrf

            <div class="bg-white border border-[#89FFE7] shadow-md rounded-[30px] p-8 space-y-6">
                <h4 class="text-sky-700 font-semibold">Data Anak</h4>

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

                {{-- FOTO ANAK --}}
                <div x-data="{ hasTyped: false, fileName: 'Belum ada foto yang dipilih' }">
                    <label for="foto_anak" class="block text-sm font-semibold mb-2">
                        Foto Anak <span class="text-red-500">*</span>
                    </label>

                    @if ($anak->foto_anak)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $anak->foto_anak) }}"
                            alt="Foto saat ini"
                            class="w-24 h-24 rounded-lg object-cover border">
                        <p class="text-xs text-gray-500 mt-1">
                            Foto saat ini. Upload baru untuk mengganti.
                        </p>
                    </div>
                    @endif

                    <div class="relative">
                        <input
                            id="foto_anak"
                            type="file"
                            name="foto_anak"
                            accept="image/*"
                            class="hidden"
                            {{ !$anak->foto_anak ? 'required' : '' }}
                            @change="hasTyped = true; fileName = $event.target.files[0] ? $event.target.files[0].name : 'Belum ada foto yang dipilih'"
                        >
                        
                        <div class="flex items-center w-full border rounded-lg overflow-hidden bg-gray-50"
                             :class="(!hasTyped && {{ $errors->has('foto_anak') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'">
                            
                            {{-- Tombol Custom --}}
                            <label for="foto_anak" class="cursor-pointer bg-sky-600 text-white font-semibold py-3 px-4 hover:bg-sky-700 transition">
                                Pilih Foto
                            </label>
                            
                            {{-- Teks Nama File --}}
                            <span class="px-4 text-sm text-gray-600 truncate" x-text="fileName"></span>
                        </div>
                    </div>
                    
                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF. Maks: 2MB.</p>

                    <div x-show="!hasTyped">
                        @error('foto_anak')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- LOOP INPUT FIELD --}}
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
                            @if(!in_array($name, ['asal_sekolah', 'nisn']))
                            <span class="text-red-500">*</span>
                            @endif
                        </label>

                        @if($name === 'agama')
                        <select
                            id="{{ $name }}"
                            name="{{ $name }}"
                            required
                            @change="hasTyped = true"
                            class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                            :class="(!hasTyped && {{ $errors->has($name) ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'"
                            >
                            <option value="">-- Pilih Agama --</option>
                            @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'] as $agm)
                            <option value="{{ $agm }}" {{ old($name, $anak->$name) == $agm ? 'selected' : '' }}>
                                {{ $agm }}
                            </option>
                            @endforeach
                        </select>

                        @else
                        <input
                            id="{{ $name }}"
                            type="{{ $name === 'tanggal_lahir' ? 'date' : 
                                    ($name === 'berat_badan' || $name === 'tinggi_badan' || $name === 'anak_ke' ? 'number' : 'text') }}"
                            name="{{ $name }}"
                            value="{{ old($name, $anak->$name) }}"
                            @input="hasTyped = true"
                            {{ !in_array($name, ['asal_sekolah', 'nisn']) ? 'required' : '' }}

                            @if($name==='anak_ke' )
                            max="99"
                            oninput="if(this.value.length > 2) this.value = this.value.slice(0, 2);"
                            @elseif($name==='berat_badan' || $name==='tinggi_badan' )
                            max="999"
                            oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);"
                            @endif
                            
                            class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                            :class="(!hasTyped && {{ $errors->has($name) ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'"
                            >
                        @endif

                        <div x-show="!hasTyped">
                            @error($name)
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @endforeach

                    {{-- GOLONGAN DARAH --}}
                    <div x-data="{ hasTyped: false }">
                        <label for="golongan_darah" class="block text-sm font-semibold mb-2">
                            Golongan Darah <span class="text-red-500">*</span>
                        </label>
                        <select id="golongan_darah" name="golongan_darah" required
                            @change="hasTyped = true"
                            class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                            :class="(!hasTyped && {{ $errors->has('golongan_darah') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'"
                            >
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

                    {{-- JENIS KELAMIN --}}
                    <div x-data="{ hasTyped: false }">
                        <label for="jenis_kelamin" class="block text-sm font-semibold mb-2">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required
                            @change="hasTyped = true"
                            class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                            :class="(!hasTyped && {{ $errors->has('jenis_kelamin') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'"
                            >
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

                    {{-- KEWARGANEGARAAN --}}
                    <div x-data="{ hasTyped: false }">
                        <label for="kewarganegaraan" class="block text-sm font-semibold mb-2">
                            Kewarganegaraan <span class="text-red-500">*</span>
                        </label>
                        <select id="kewarganegaraan" name="kewarganegaraan" required
                            @change="hasTyped = true"
                            class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                            :class="(!hasTyped && {{ $errors->has('kewarganegaraan') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'"
                            >
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

                {{-- ALAMAT --}}
                <div x-data="{ hasTyped: false }">
                    <label for="alamat" class="block text-sm font-semibold mb-2">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alamat" name="alamat" rows="3" required
                        @input="hasTyped = true"
                        class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                        :class="(!hasTyped && {{ $errors->has('alamat') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'"
                        >{{ old('alamat', $anak->alamat) }}</textarea>
                    
                    <div x-show="!hasTyped">
                        @error('alamat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- RIWAYAT PENYAKIT --}}
                <div x-data="{ hasTyped: false }">
                    <label for="riwayat_penyakit" class="block text-sm font-semibold mb-2">Riwayat Penyakit (Opsional)</label>
                    <textarea id="riwayat_penyakit" name="riwayat_penyakit" rows="3"
                        @input="hasTyped = true"
                        class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                        >{{ old('riwayat_penyakit', $anak->riwayat_penyakit) }}</textarea>
                    
                    <div x-show="!hasTyped">
                        @error('riwayat_penyakit')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- TOMBOL LANJUT --}}
            <div class="text-right pt-4">
                <button type="submit"
                    class="bg-sky-600 hover:bg-sky-700 text-white font-semibold py-3 px-10 rounded-full transition">
                    Lanjut ke Step 2 →
                </button>
            </div>
        </form>
    </main>

    @if (session('error'))
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Akses Ditolak',
            text: "{{ session('error') }}",
            confirmButtonColor: '#0ea5e9',
        });
    </script>
    @endif

</x-app-layout>