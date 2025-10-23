<x-app-layout>
    @php
        // DUMMY DATA sementara, pura-pura dari DB
        $profile = (object) [
            'visi' => 'Mewujudkan anak didik yang berakhlakul karimah.',
            'misi' => "1. Mencintai Al Qur’an melalui tahfidz.\n2. Pembiasaan 5S (senyum, salam, sapa, sopan, santun).\n3. Belajar dengan senang dan tanpa beban.",
            'tujuan' => "1. Generasi berakhlakul karimah.\n2. Generasi aktif, kreatif, mandiri.",
            'motto' => 'Membentuk generasi “BAKAT”: berakhlakul karimah, aktif, kreatif, asik, tanggung jawab.'
        ];
    @endphp

    <main class="max-w-4xl mx-auto p-6 space-y-6">
        <h1 class="text-3xl font-bold text-sky-700 mb-4">Edit Profil Sekolah</h1>

        <form method="POST" class="space-y-6">
            {{-- gak perlu action karena dummy --}}
            {{-- @csrf --}}

            <div>
                <label class="block font-semibold mb-1">Visi</label>
                <textarea name="visi" class="w-full border border-gray-300 rounded-xl p-3 min-h-[100px]">{{ old('visi', $profile->visi) }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Misi</label>
                <textarea name="misi" class="w-full border border-gray-300 rounded-xl p-3 min-h-[150px]">{{ old('misi', $profile->misi) }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Tujuan</label>
                <textarea name="tujuan" class="w-full border border-gray-300 rounded-xl p-3 min-h-[100px]">{{ old('tujuan', $profile->tujuan) }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Motto</label>
                <textarea name="motto" class="w-full border border-gray-300 rounded-xl p-3 min-h-[80px]">{{ old('motto', $profile->motto) }}</textarea>
            </div>

            <button
                type="button"
                class="bg-sky-700 text-white px-6 py-2 rounded-xl hover:bg-sky-800 transition">
                Simpan (Dummy)
            </button>
        </form>
    </main>
</x-app-layout>
