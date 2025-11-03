<x-app-layout>
    <main class="max-w-3xl mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold text-sky-700 mb-6 text-center">Formulir Pendaftaran — Pilihan Program</h2>

        <form method="POST" action="{{ route('user.formulir.step3.store') }}" class="space-y-8">
            @csrf

            <div class="bg-white border border-[#89FFE7] shadow-md rounded-[30px] p-8 space-y-6">
                <div>
                    <label class="block text-sm font-semibold mb-2">Nomor HP (Aktif)</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $pendaftaran->no_hp) }}" class="w-full border border-[#89FFE7] rounded-xl p-3 focus:ring-2 focus:ring-[#89FFE7]">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">Pilih Program</label>
                    <div class="flex gap-6 mt-2">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="jenis_program" value="Reguler" {{ $pendaftaran->jenis_program == 'Reguler' ? 'checked' : '' }}> Reguler
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="jenis_program" value="Full Day" {{ $pendaftaran->jenis_program == 'Full Day' ? 'checked' : '' }}> Full Day
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-between pt-6">
                <a href="{{ route('user.formulir.step2') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 rounded-full font-semibold">← Kembali</a>
                <button type="submit" class="px-10 py-3 bg-emerald-600 text-white font-semibold rounded-full hover:bg-emerald-700">
                    ✅ Kirim Formulir
                </button>
            </div>
        </form>
    </main>
</x-app-layout>