<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 space-y-8">

        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-sky-700">Data Guru</h1>
                <p class="text-sm text-gray-500">
                    Kelola data tenaga pendidik sekolah
                </p>
            </div>

            <a href="{{ route('admin.guru.create') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5
                bg-gradient-to-r from-sky-600 to-sky-500
                text-white text-sm font-semibold rounded-xl
                shadow hover:shadow-lg hover:scale-105 transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                Tambah Guru
            </a>
        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($guru as $g)
            <div
                class="group bg-white rounded-3xl border border-sky-100
                    shadow-md hover:shadow-xl transition-all duration-300
                    overflow-hidden">

                <!-- TOP LINE -->
                <div class="h-1.5 bg-gradient-to-r from-sky-500 to-cyan-400"></div>

                <div class="p-6 text-center">

                    <!-- FOTO -->
                    <div class="relative w-24 h-24 mx-auto">
                        @if($g->foto)
                        <img src="{{ asset('storage/'.$g->foto) }}"
                            class="w-24 h-24 rounded-full object-cover
                                    border-4 border-white shadow">
                        @else
                        <div class="w-24 h-24 rounded-full bg-gray-200"></div>
                        @endif
                    </div>

                    <!-- INFO -->
                    <h3 class="mt-4 text-lg font-bold text-gray-800">
                        {{ $g->nama }}
                    </h3>

                    <p class="text-sm font-medium text-sky-600">
                        {{ $g->jabatan }}
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        {{ $g->tempat_lahir }},
                        {{ \Carbon\Carbon::parse($g->tanggal_lahir)->format('d M Y') }}
                    </p>

                    <!-- DESKRIPSI (LIMIT AMAN) -->
                    @if($g->deskripsi)
                    <p class="text-sm text-gray-600 mt-3 leading-relaxed">
                        {{ \Illuminate\Support\Str::limit($g->deskripsi, 80) }}
                    </p>
                    @endif

                    <!-- ACTION -->
                    <div class="flex justify-center gap-3 mt-5">
                        <a href="{{ route('admin.guru.edit', $g->id) }}"
                            class="px-4 py-1.5 text-sm font-medium
                                bg-yellow-400 hover:bg-yellow-500
                                text-white rounded-lg transition">
                            Edit
                        </a>

                        <form action="{{ route('admin.guru.destroy', $g->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin hapus guru ini?')">
                            @csrf
                            @method('DELETE')

                            <button
                                class="px-4 py-1.5 text-sm font-medium
                                    bg-red-500 hover:bg-red-600
                                    text-white rounded-lg transition">
                                Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-app-layout>