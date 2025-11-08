<x-app-layout>
    <main class="max-w-3xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold text-sky-700 mb-6 text-center">Formulir Pendaftaran — Pilihan Program</h2>

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
                <strong class="font-semibold">Satu Langkah Terakhir!</strong>
                <p class="text-sm">
                    Pastikan data Anda sudah benar sebelum mengirim. Anda masih bisa kembali ke 
                    <a href="{{ route('user.dashboard') }}" class="font-bold underline hover:text-sky-900">Dashboard</a> 
                    jika belum siap mengirim.
                </p>
            </div>
        </div>
        {{-- ====================================================== --}}
        {{-- == BATAS TAMBAHAN == --}}
        {{-- ====================================================== --}}

        <form method="POST" action="{{ route('user.formulir.step3.store') }}" class="space-y-8" id="formStep3">
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

            <div class="bg-white border border-[#89FFE7] shadow-md rounded-[30px] p-8 space-y-6">
                
                <div x-data="{ hasTyped: false }">
                    <label for="no_hp" class="block text-sm font-semibold mb-2">Nomor HP (Aktif)</label>
                    <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp', $pendaftaran->no_hp) }}" 
                           @input="hasTyped = true"
                           class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7] @error('no_hp') border-red-500 @enderror">
                    
                    <div x-show="!hasTyped">
                        @error('no_hp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div x-data="{ hasTyped: false }">
                    <label class="block text-sm font-semibold mb-2">Pilih Program</label>
                    <div class="flex gap-6 mt-2">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="jenis_program" value="Reguler" 
                                   @change="hasTyped = true"
                                   {{ old('jenis_program', $pendaftaran->jenis_program) == 'Reguler' ? 'checked' : '' }}> Reguler
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="jenis_program" value="Full Day" 
                                   @change="hasTyped = true"
                                   {{ old('jenis_program', $pendaftaran->jenis_program) == 'Full Day' ? 'checked' : '' }}> Full Day
                        </label>
                    </div>
                    
                    <div x-show="!hasTyped">
                        @error('jenis_program')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-between pt-6">
                <a href="{{ route('user.formulir.step2') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 rounded-full font-semibold">← Kembali</a>
                <button type="button" 
                        onclick="confirmSubmit()" 
                        class="px-10 py-3 bg-emerald-600 text-white font-semibold rounded-full hover:bg-emerald-700">
                    ✅ Kirim Formulir
                </button>
            </div>
        </form>
    </main>
    
    {{-- SCRIPT ALPINE.JS --}}
    <script src="//unpkg.com/alpinejs" defer></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSubmit() {
            Swal.fire({
                title: 'Konfirmasi Pengiriman',
                text: "Apakah Anda yakin ingin mengirim data ini? Data tidak akan bisa diubah lagi setelah dikirim.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#10B981', // emerald-600
                cancelButtonColor: '#6B7280', // gray-500
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, submit form-nya
                    document.getElementById('formStep3').submit();
                }
            })
        }
    </script>

</x-app-layout>