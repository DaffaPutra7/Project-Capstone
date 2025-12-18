<x-app-layout>
    <main class="max-w-4xl mx-auto p-6 space-y-6">
        <h1 class="text-3xl font-bold text-sky-700 mb-4">Edit Profil Sekolah</h1>

        {{-- Alert sukses --}}
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        {{--Form UTAMA--}}
        <form method="POST" action="{{ route('admin.profil.update') }}" class="space-y-6" enctype="multipart/form-data">
            @csrf

            {{-- Visi --}}
            <div>
                <label class="block font-semibold mb-1">Visi</label>
                <textarea name="visi" class="w-full border border-gray-300 rounded-xl p-3 min-h-[100px]">{{ old('visi', $profil->visi) }}</textarea>
            </div>

            {{-- Misi --}}
            <div>
                <label class="block font-semibold mb-1">Misi</label>
                <textarea name="misi" class="w-full border border-gray-300 rounded-xl p-3 min-h-[150px]">{{ old('misi', $profil->misi) }}</textarea>
            </div>

            {{-- Tujuan --}}
            <div>
                <label class="block font-semibold mb-1">Tujuan</label>
                <textarea name="tujuan" class="w-full border border-gray-300 rounded-xl p-3 min-h-[100px]">{{ old('tujuan', $profil->tujuan) }}</textarea>
            </div>

            {{-- Motto --}}
            <div>
                <label class="block font-semibold mb-1">Motto</label>
                <textarea name="motto" class="w-full border border-gray-300 rounded-xl p-3 min-h-[80px]">{{ old('motto', $profil->motto) }}</textarea>
            </div>

            <hr>

            {{-- Bagian Galeri Foto --}}
            <div>
                <h2 class="text-xl font-semibold text-sky-700 mb-2">Galeri Foto</h2>

                {{-- Form Upload Foto Baru --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Tambah Foto Galeri</label>
                    <input type="file" name="galeri[]" multiple class="w-full border border-gray-300 rounded-xl p-2 file:border-0 file:bg-sky-100 file:text-sky-700 file:rounded-lg file:py-2 file:px-4">
                    <p class="text-sm text-gray-500 mt-1">Bisa pilih lebih dari satu foto (Ctrl/Cmd + Klik).</p>
                    @error('galeri.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Galeri Foto Saat Ini --}}
                <label class="block font-semibold mb-1">Foto Saat Ini</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    @forelse ($profil->foto as $foto)
                    <div class="relative group border rounded-lg p-2 space-y-2">

                        {{-- (PERUBAHAN) Tombol Hapus sekarang BUKAN form --}}
                        <button
                            type="button" {{-- Ubah dari "submit" ke "button" --}}
                            {{-- Panggil JavaScript saat diklik --}}
                            onclick="submitDeleteForm('{{ $foto->id_foto }}')"
                            class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full h-6 w-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-10 cursor-pointer">
                            &times;
                        </button>

                        {{-- Gambar --}}
                        <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="Galeri" class="w-full h-32 object-cover rounded-lg shadow-md">

                        {{-- Input Deskripsi (Ini bagian dari form UTAMA) --}}
                        <div>
                            <label for="deskripsi_{{ $foto->id_foto }}" class="text-sm font-medium text-gray-700">Deskripsi</label>
                            <input type="text"
                                name="deskripsi[{{ $foto->id_foto }}]"
                                id="deskripsi_{{ $foto->id_foto }}"
                                value="{{ old('deskripsi.' . $foto->id_foto, $foto->deskripsi) }}"
                                placeholder="Keterangan foto..."
                                class="w-full border border-gray-300 rounded-md p-1.5 text-sm mt-1">
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 col-span-full">Belum ada foto galeri.</p>
                    @endforelse
                </div>
            </div>

            <hr>

            {{-- Tombol "Simpan Perubahan" ini sekarang akan berfungsi --}}
            <button
                type="submit"
                class="bg-sky-700 text-white px-6 py-2 rounded-xl hover:bg-sky-800 transition">
                Simpan Perubahan
            </button>
        </form>

        {{-- (BARU) Form Hapus diletakkan di luar (tersembunyi) --}}
        @foreach ($profil->foto as $foto)
        <form
            action="{{ route('admin.profil.foto.hapus', $foto->id_foto) }}"
            method="POST"
            id="form-hapus-{{ $foto->id_foto }}"
            style="display: none;">
            @csrf
            @method('DELETE')
        </form>
        @endforeach

    </main>

    {{-- Tambahkan script di akhir --}}
    @push('scripts')
    <script>
        function submitDeleteForm(id) {
            if (confirm('Yakin ingin hapus foto ini?')) {
                document.getElementById('form-hapus-' + id).submit();
            }
        }
    </script>
    @endpush

</x-app-layout>