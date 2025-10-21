<x-app-layout>
    <main class="max-w-6xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold text-sky-700 mb-2">
            Pendaftaran TK - Aisyiyah<br>
            Bustanul Athfal Banjareja
        </h1>

        <section class="bg-white border border-[#89FFE7] shadow-sm rounded-[50px] p-8">
            <h3 class="text-sky-700 font-semibold mb-4">Formulir Pendaftaran</h3>

            <form action="#" method="POST" class="space-y-8">
                @csrf

                <!-- Data Anak -->
                <div>
                    <h4 class="text-sky-700 font-semibold mb-3">Data Anak</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kolom Kiri -->
                        <div class="space-y-3">
                            @foreach ([
                                'Nama Lengkap',
                                'Nama Panggilan',
                                'NIK Anak',
                                'Tempat Tanggal Lahir',
                                'Anak Ke-',
                                'Berdasarkan Akte Kelahiran No.',
                                'Asal Sekolah (bila ada)',
                                'Nomor NISN (bila ada)',
                                'Penyakit yang Pernah Diderita'
                            ] as $label)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                                    <input type="text" name="{{ Str::slug($label, '_') }}"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        @if (!Str::contains($label, 'bila ada')) required @endif />
                                </div>
                            @endforeach

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Alamat Tempat Tinggal</label>
                                <textarea name="alamat"
                                    class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                    required></textarea>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="space-y-3">
                            <div>
                                <span class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</span>
                                <div class="flex items-center space-x-4">
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="gender" value="Laki-laki"
                                            class="text-[#89FFE7] focus:ring-[#89FFE7]" required />
                                        <span>Laki-laki</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="gender" value="Perempuan"
                                            class="text-[#89FFE7] focus:ring-[#89FFE7]" required />
                                        <span>Perempuan</span>
                                    </label>
                                </div>
                            </div>

                            @foreach ([
                                'Agama',
                                'Kewarganegaraan',
                                'Banyak Saudara Kandung',
                                'Banyak Saudara Tiri',
                                'Banyak Saudara Angkat',
                                'Bahasa Sehari-hari'
                            ] as $label)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                                    <input type="text" name="{{ Str::slug($label, '_') }}"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                            @endforeach

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Berat Badan (kg)</label>
                                    <input type="number" name="berat_badan"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tinggi Badan (cm)</label>
                                    <input type="number" name="tinggi_badan"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Golongan Darah</label>
                                <input type="text" name="golongan_darah"
                                    class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                    required />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua / Wali -->
                <div class="border-t pt-6">
                    <h4 class="text-sky-700 font-semibold mb-3">Data Orang Tua / Wali</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            @foreach ([
                                'Nama Ayah Kandung',
                                'Tempat Tanggal Lahir Ayah',
                                'Nama Ibu Kandung',
                                'Tempat Tanggal Lahir Ibu',
                                'Penyakit yang Pernah Diderita',
                                'No. HP (No. WA)'
                            ] as $label)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                                    <input type="text" name="{{ Str::slug($label, '_') }}"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                            @endforeach
                        </div>

                        <div class="space-y-3">
                            @foreach ([
                                'Pendidikan Terakhir Ayah',
                                'Pendidikan Terakhir Ibu',
                                'Pekerjaan Ayah',
                                'Pekerjaan Ibu',
                                'Nama Wali (jika ada)'
                            ] as $label)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                                    <input type="text" name="{{ Str::slug($label, '_') }}"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        @if (!Str::contains($label, 'jika ada')) required @endif />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Pilihan Reguler / Full Day -->
                <div class="border-t pt-6">
                    <h4 class="text-sky-700 font-semibold mb-3">Pilihan Program</h4>
                    <div class="flex items-center space-x-6">
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="program" value="Reguler"
                                class="text-[#89FFE7] focus:ring-[#89FFE7]" required />
                            <span>Reguler</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="radio" name="program" value="Full Day"
                                class="text-[#89FFE7] focus:ring-[#89FFE7]" required />
                            <span>Full Day</span>
                        </label>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="pt-8 text-center">
                    <button type="submit"
                        class="bg-sky-600 hover:bg-sky-700 text-white font-semibold py-3 px-10 rounded-[50px] shadow-md transition">
                        Kirim Data
                    </button>
                </div>
            </form>
        </section>
    </main>
</x-app-layout>
