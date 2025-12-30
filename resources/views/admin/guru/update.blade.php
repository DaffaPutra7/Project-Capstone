<x-app-layout>
    <div class="max-w-xl mx-auto p-6">

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-xl border border-sky-100 p-6">

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-xl font-bold text-sky-700">Edit Guru</h1>
                    <p class="text-sm text-gray-500">
                        Perbarui data tenaga pendidik
                    </p>
                </div>

                <a href="{{ route('admin.guru.index') }}"
                    class="text-sm px-3 py-1.5 rounded-lg border
                 hover:bg-gray-100 transition">
                    ← Kembali
                </a>
            </div>

            <!-- FOTO PREVIEW -->
            <div class="flex justify-center mb-6">
                @if($guru->foto)
                <img src="{{ asset('storage/'.$guru->foto) }}"
                    class="w-32 h-32 rounded-full object-cover border-4 border-sky-200 shadow">
                @else
                <div class="w-32 h-32 rounded-full bg-gray-200"></div>
                @endif
            </div>

            <!-- FORM -->
            <form action="{{ route('admin.guru.update', $guru->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-5">

                @csrf
                @method('PUT')

                <!-- NAMA -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Nama Guru</label>
                    <input type="text" name="nama"
                        value="{{ $guru->nama }}"
                        class="mt-1 w-full border rounded-xl p-3 focus:ring focus:ring-sky-200">
                </div>

                <!-- JABATAN -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Jabatan</label>
                    <input type="text" name="jabatan"
                        value="{{ $guru->jabatan }}"
                        class="mt-1 w-full border rounded-xl p-3 focus:ring focus:ring-sky-200">
                </div>

                <!-- TEMPAT & TANGGAL -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir"
                            value="{{ $guru->tempat_lahir }}"
                            class="mt-1 w-full border rounded-xl p-3">
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir"
                            value="{{ $guru->tanggal_lahir }}"
                            class="mt-1 w-full border rounded-xl p-3">
                    </div>
                </div>

                <!-- DESKRIPSI -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="mt-1 w-full border rounded-xl p-3">{{ $guru->deskripsi }}</textarea>
                </div>

                <!-- FOTO -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Ganti Foto</label>
                    <input type="file" name="foto"
                        class="mt-1 w-full border rounded-xl p-2 bg-gray-50">
                </div>

                <!-- BUTTON -->
                <button
                    class="w-full py-3 rounded-xl font-semibold text-white
                 bg-gradient-to-r from-emerald-600 to-emerald-500
                 hover:scale-[1.02] transition shadow">
                    Update Data Guru
                </button>

            </form>
        </div>

    </div>
</x-app-layout>