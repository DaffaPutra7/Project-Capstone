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

                            <!-- Tempat & Tanggal Lahir -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                            </div>

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

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Agama</label>
                                <input type="text" name="agama"
                                    class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                    required />
                            </div>

                            <!-- Kewarganegaraan (Radio Button) -->
                            <div>
                                <span class="block text-sm font-medium text-gray-700 mb-1">Kewarganegaraan</span>
                                <div class="flex items-center space-x-4">
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="kewarganegaraan" value="Indonesia"
                                            class="text-[#89FFE7] focus:ring-[#89FFE7]" required />
                                        <span>Indonesia</span>
                                    </label>
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="kewarganegaraan" value="WNA"
                                            class="text-[#89FFE7] focus:ring-[#89FFE7]" required />
                                        <span>Warga Negara Asing (WNA)</span>
                                    </label>
                                </div>
                            </div>

                            @foreach ([
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

                    <div class="space-y-8">
                        <!-- Data Ayah -->
                        <div>
                            <h5 class="text-sky-600 font-semibold mb-3">Data Ayah</h5>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama Ayah Kandung</label>
                                    <input type="text" name="nama_ayah_kandung"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tempat Lahir Ayah</label>
                                    <input type="text" name="tempat_lahir_ayah"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tanggal Lahir Ayah</label>
                                    <input type="date" name="tanggal_lahir_ayah"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Pendidikan Terakhir Ayah</label>
                                    <input type="text" name="pendidikan_terakhir_ayah"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                                    <input type="text" name="pekerjaan_ayah"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                            </div>
                        </div>

                        <!-- Data Ibu -->
                        <div class="border-t pt-6">
                            <h5 class="text-sky-600 font-semibold mb-3">Data Ibu</h5>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama Ibu Kandung</label>
                                    <input type="text" name="nama_ibu_kandung"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tempat Lahir Ibu</label>
                                    <input type="text" name="tempat_lahir_ibu"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tanggal Lahir Ibu</label>
                                    <input type="date" name="tanggal_lahir_ibu"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Pendidikan Terakhir Ibu</label>
                                    <input type="text" name="pendidikan_terakhir_ibu"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                                    <input type="text" name="pekerjaan_ibu"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                        required />
                                </div>
                            </div>
                        </div>

                        <!-- Data Wali -->
                        <div class="border-t pt-6">
                            <h5 class="text-sky-600 font-semibold mb-3">Data Wali (jika ada)</h5>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama Wali</label>
                                    <input type="text" name="nama_wali"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Pekerjaan Wali</label>
                                    <input type="text" name="pekerjaan_wali"
                                        class="w-full rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]" />
                                </div>
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div class="border-t pt-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No. HP (No. WA)</label>
                                <input type="text" name="no_hp"
                                    class="w-full sm:w-1/2 rounded-[50px] border-gray-300 shadow-sm focus:border-[#89FFE7] focus:ring-[#89FFE7]"
                                    required />
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Pilihan Program -->
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
