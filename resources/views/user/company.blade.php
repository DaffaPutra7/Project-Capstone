<x-app-layout>
    <main class="max-w-6xl mx-auto px-4 py-10 space-y-12">

        <!-- JUDUL -->
        <section class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-sky-700 to-sky-500 bg-clip-text text-transparent">
                Profil TK
            </h1>
            <p class="mt-2 text-gray-600 text-lg font-medium">
                {{ $profile->nama_tk ?? 'Nama TK' }}
            </p>
        </section>

        <!-- SEJARAH -->
        <section class="rounded-3xl shadow-xl border-2 border-[#89FFE7] bg-white overflow-hidden">
            <div class="bg-gradient-to-r from-sky-600 to-cyan-500 px-8 py-5 flex items-center justify-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-2xl font-bold text-white tracking-wide">SEJARAH</h3>
            </div>

            <div class="p-8">
                <p class="text-gray-800 leading-relaxed text-lg font-medium text-center">
                    {!! nl2br(e($profile->sejarah ?? 'Sejarah TK belum diatur.')) !!}
                </p>
            </div>
        </section>

        <!-- VISI & MISI -->
        <section class="grid md:grid-cols-2 gap-8">

            <!-- VISI -->
            <div class="rounded-3xl shadow-xl border-2 border-[#89FFE7] bg-white overflow-hidden">
                <div class="bg-gradient-to-r from-sky-600 to-cyan-500 px-8 py-5 flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <h3 class="text-2xl font-bold text-white tracking-wide">VISI</h3>
                </div>

                <div class="p-8">
                    <p class="text-gray-800 leading-relaxed text-lg font-medium text-center">
                        {!! nl2br(e($profile->visi ?? 'Visi belum diatur.')) !!}
                    </p>
                </div>
            </div>

            <!-- MISI -->
            <div class="rounded-3xl shadow-xl border-2 border-[#89FFE7] bg-white overflow-hidden">
                <div class="bg-gradient-to-r from-sky-600 to-cyan-500 px-8 py-5 flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4" />
                    </svg>
                    <h3 class="text-2xl font-bold text-white tracking-wide">MISI</h3>
                </div>

                <div class="p-8">
                    <ul class="space-y-3 text-gray-800 text-lg font-medium">
                        @if(!empty($profile->misi))
                        @foreach (explode("\n", $profile->misi) as $misi)
                        @if (trim($misi))
                        <li class="flex items-start gap-3">
                            <span class="w-3 h-3 mt-2 border-2 border-sky-600 rounded-full shrink-0"></span>
                            <span>{{ trim($misi, "•- ") }}</span>
                        </li>
                        @endif
                        @endforeach
                        @else
                        <li class="text-center text-gray-500">Belum ada data misi.</li>
                        @endif
                    </ul>
                </div>
            </div>
        </section>

        <!-- TUJUAN -->
        <section class="rounded-3xl shadow-xl border-2 border-[#89FFE7] bg-white overflow-hidden">
            <div class="bg-gradient-to-r from-sky-600 to-cyan-500 px-8 py-5 flex items-center justify-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2z" />
                </svg>
                <h3 class="text-2xl font-bold text-white tracking-wide">TUJUAN</h3>
            </div>

            <div class="p-8">
                <ul class="space-y-3 text-gray-800 text-lg font-medium">
                    @if(!empty($profile->tujuan))
                    @foreach (explode("\n", $profile->tujuan) as $tujuan)
                    @if (trim($tujuan))
                    <li class="flex items-start gap-3 justify-center text-center">
                        <span class="w-3 h-3 mt-2 border-2 border-sky-600 rounded-full shrink-0"></span>
                        <span>{{ trim($tujuan, "•- ") }}</span>
                    </li>
                    @endif
                    @endforeach
                    @else
                    <li class="text-center text-gray-500">Belum ada data tujuan.</li>
                    @endif
                </ul>
            </div>
        </section>

        <!-- GALERI -->
        <section class="rounded-3xl shadow-xl border-2 border-[#89FFE7] bg-white overflow-hidden">
            <div class="bg-gradient-to-r from-sky-600 to-cyan-500 px-8 py-5 text-center">
                <h3 class="text-2xl font-bold text-white tracking-wide">GALERI FOTO</h3>
            </div>

            <div class="p-8">
                @if ($profile && $profile->foto && $profile->foto->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach ($profile->foto as $foto)
                    <figure class="overflow-hidden rounded-2xl shadow-md bg-gray-50 border">
                        <img src="{{ asset('storage/' . $foto->path_foto) }}"
                            class="w-full h-48 object-cover">
                    </figure>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500 text-center">Belum ada foto di galeri.</p>
                @endif
            </div>
        </section>

        <!-- LOKASI -->
        {{-- bagian lokasi lu aman, gak disentuh --}}

    </main>
</x-app-layout>