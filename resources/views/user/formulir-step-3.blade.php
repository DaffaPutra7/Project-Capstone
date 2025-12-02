<x-app-layout>
    <main class="max-w-3xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold text-sky-700 mb-6 text-center">Formulir Pendaftaran — Pilihan Program</h2>

        {{-- Boks Info "Jalan Keluar" --}}
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

        {{-- FORM UTAMA --}}
        <form method="POST" action="{{ route('user.formulir.step3.store') }}" class="space-y-8" id="formStep3" novalidate>
            @csrf

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

            <div class="bg-white border border-[#89FFE7] shadow-md rounded-[30px] p-8 space-y-6">
                
                {{-- NOMOR HP --}}
                <div x-data="{ hasTyped: false }">
                    <label for="no_hp" class="block text-sm font-semibold mb-2">
                        Nomor HP (Aktif) <span class="text-red-500">*</span>
                    </label>
                    <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp', $pendaftaran->no_hp) }}" required
                           @input="hasTyped = true"
                           class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]"
                           :class="(!hasTyped && {{ $errors->has('no_hp') ? 'true' : 'false' }}) ? 'border-red-500' : 'border-[#89FFE7]'"
                           >
                    
                    <div x-show="!hasTyped">
                        @error('no_hp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- JENIS PROGRAM --}}
                <div x-data="{ hasTyped: false }">
                    <label class="block text-sm font-semibold mb-2">
                        Pilih Program <span class="text-red-500">*</span>
                    </label>
                    
                    <div class="flex gap-6 mt-2 p-3 rounded-xl border"
                         :class="(!hasTyped && {{ $errors->has('jenis_program') ? 'true' : 'false' }}) ? 'border-red-500 bg-red-50' : 'border-transparent'">
                        
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_program" value="Reguler" required
                                   @change="hasTyped = true"
                                   class="text-sky-600 focus:ring-sky-500"
                                   {{ old('jenis_program', $pendaftaran->jenis_program) == 'Reguler' ? 'checked' : '' }}> 
                            <span>Reguler</span>
                        </label>
                        
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="jenis_program" value="Full Day" required
                                   @change="hasTyped = true"
                                   class="text-sky-600 focus:ring-sky-500"
                                   {{ old('jenis_program', $pendaftaran->jenis_program) == 'Full Day' ? 'checked' : '' }}> 
                            <span>Full Day</span>
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
    
    <script src="//unpkg.com/alpinejs" defer></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSubmit() {
            var form = document.getElementById('formStep3');
            if (!form.checkValidity()) {
                form.submit();
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Pengiriman',
                text: "Apakah Anda yakin ingin mengirim data ini? Data tidak akan bisa diubah lagi setelah dikirim.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#10B981', 
                cancelButtonColor: '#6B7280', 
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
    </script>
</x-app-layout>