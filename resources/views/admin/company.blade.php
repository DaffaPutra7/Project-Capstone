<x-app-layout>
    <main class="max-w-4xl mx-auto p-6 space-y-6">
        <h1 class="text-3xl font-bold text-sky-700 mb-4">Edit Profil Sekolah</h1>

        {{-- Alert sukses --}}
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.profil.update') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block font-semibold mb-1">Visi</label>
                <textarea name="visi" class="w-full border border-gray-300 rounded-xl p-3 min-h-[100px]">{{ old('visi', $profil->visi) }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Misi</label>
                <textarea name="misi" class="w-full border border-gray-300 rounded-xl p-3 min-h-[150px]">{{ old('misi', $profil->misi) }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Tujuan</label>
                <textarea name="tujuan" class="w-full border border-gray-300 rounded-xl p-3 min-h-[100px]">{{ old('tujuan', $profil->tujuan) }}</textarea>
            </div>

            <div>
                <label class="block font-semibold mb-1">Motto</label>
                <textarea name="motto" class="w-full border border-gray-300 rounded-xl p-3 min-h-[80px]">{{ old('motto', $profil->motto) }}</textarea>
            </div>

            <button
                type="submit"
                class="bg-sky-700 text-white px-6 py-2 rounded-xl hover:bg-sky-800 transition">
                Simpan
            </button>
        </form>
    </main>
</x-app-layout>