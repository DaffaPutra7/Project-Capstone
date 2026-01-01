<x-app-layout>
    <main class="max-w-4xl mx-auto p-6 space-y-6">
        <h1 class="text-3xl font-bold text-sky-700 mb-4">Edit Profil Sekolah</h1>

        {{-- Alert sukses --}}
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        {{-- Form UTAMA (Update Profil & Upload Foto) --}}
        <form method="POST" action="{{ route('admin.profil.update') }}" class="space-y-6" enctype="multipart/form-data">
            @csrf

            {{-- Sejarah --}}
            <div>
                <label class="block font-semibold mb-1">Sejarah</label>
                <textarea
                    name="sejarah"
                    class="w-full border border-gray-300 rounded-xl p-3 min-h-[150px]"
                    placeholder="Sejarah singkat sekolah...">{{ old('sejarah', $profil->sejarah) }}</textarea>
            </div>

            {{-- Visi --}}
            <div>
                <label class="block font-semibold mb-1">Visi</label>
                <textarea name="visi" class="w-full border border-gray-300 rounded-xl p-3 min-h-[100px] focus:ring-sky-500 focus:border-sky-500">{{ old('visi', $profil->visi) }}</textarea>
            </div>

            {{-- Misi --}}
            <div>
                <label class="block font-semibold mb-1">Misi</label>
                <textarea name="misi" class="w-full border border-gray-300 rounded-xl p-3 min-h-[150px] focus:ring-sky-500 focus:border-sky-500">{{ old('misi', $profil->misi) }}</textarea>
            </div>

            {{-- Tujuan --}}
            <div>
                <label class="block font-semibold mb-1">Tujuan</label>
                <textarea name="tujuan" class="w-full border border-gray-300 rounded-xl p-3 min-h-[100px] focus:ring-sky-500 focus:border-sky-500">{{ old('tujuan', $profil->tujuan) }}</textarea>
            </div>

            {{-- Motto --}}
            <div>
                <label class="block font-semibold mb-1">Motto</label>
                <textarea name="motto" class="w-full border border-gray-300 rounded-xl p-3 min-h-[80px] focus:ring-sky-500 focus:border-sky-500">{{ old('motto', $profil->motto) }}</textarea>
            </div>

            <hr>

            {{-- Bagian Galeri Foto --}}
            <div>
                <h2 class="text-xl font-semibold text-sky-700 mb-2">Galeri Foto</h2>

                {{-- Form Upload Foto Baru --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Tambah Foto Galeri</label>
                    <input type="file" name="galeri[]" multiple class="w-full border border-gray-300 rounded-xl p-2 file:border-0 file:bg-sky-100 file:text-sky-700 file:rounded-lg file:py-2 file:px-4 hover:file:bg-sky-200 transition">
                    <p class="text-sm text-gray-500 mt-1">Bisa pilih lebih dari satu foto (Ctrl/Cmd + Klik).</p>
                    @error('galeri.*')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Galeri Foto Saat Ini --}}
                <label class="block font-semibold mb-1">Foto Saat Ini</label>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    @forelse ($profil->foto as $foto)
                    <div class="relative group border rounded-lg p-2 space-y-2 bg-white shadow-sm hover:shadow-md transition">

                        {{-- Tombol Hapus (Silang Merah) --}}
                        <button 
                            type="button" 
                            onclick="submitDeleteForm('{{ $foto->id_foto }}')" 
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full h-7 w-7 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity z-10 cursor-pointer hover:bg-red-600 shadow-md"
                            title="Hapus Foto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        {{-- Gambar --}}
                        <div class="overflow-hidden rounded-lg">
                            <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="Galeri" class="w-full h-32 object-cover hover:scale-105 transition duration-300">
                        </div>

                        {{-- Input Deskripsi --}}
                        <div>
                            <label for="deskripsi_{{ $foto->id_foto }}" class="text-xs font-medium text-gray-500 uppercase">Deskripsi</label>
                            <input type="text" 
                                name="deskripsi[{{ $foto->id_foto }}]" 
                                id="deskripsi_{{ $foto->id_foto }}" 
                                value="{{ old('deskripsi.' . $foto->id_foto, $foto->deskripsi) }}" 
                                placeholder="Keterangan foto..." 
                                class="w-full border border-gray-300 rounded-md p-1.5 text-sm mt-1 focus:ring-sky-500 focus:border-sky-500">
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-8 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                        <p class="text-gray-500">Belum ada foto galeri yang diunggah.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <hr>

            {{-- Tombol Simpan Perubahan Utama --}}
            <button type="submit" class="bg-sky-700 text-white px-6 py-2.5 rounded-xl hover:bg-sky-800 transition shadow-lg font-medium flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                Simpan Perubahan
            </button>
        </form>

        {{-- FORM HAPUS TERSEMBUNYI (Looping) --}}
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

    {{-- Import SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Script Custom Alert --}}
    <script>
        function submitDeleteForm(id) {
            Swal.fire({
                title: 'Hapus Foto?',
                text: "Anda yakin ingin menghapus foto ini? Tindakan ini tidak dapat dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33', 
                cancelButtonColor: '#3085d6', 
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true 
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user klik 'Ya', submit form
                    var form = document.getElementById('form-hapus-' + id);
                    if (form) {
                        form.submit();
                    } else {
                        Swal.fire('Error!', 'Form tidak ditemukan.', 'error');
                    }
                }
            });
        }
    </script>

</x-app-layout>