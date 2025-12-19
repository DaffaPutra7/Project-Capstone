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

        <!-- VISI & MISI -->
        <section class="grid md:grid-cols-2 gap-8">

            <!-- VISI -->
            <div class="rounded-3xl shadow-xl border-2 border-[#89FFE7] bg-white overflow-hidden">
                <div class="bg-gradient-to-r from-sky-600 to-cyan-500 px-8 py-5 flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <h3 class="text-2xl font-bold text-white tracking-wide">VISI</h3>
                </div>

                <div class="p-8">
                    <p class="text-gray-800 leading-relaxed text-lg font-medium text-center">
                        {!! nl2br(e($profile->visi)) !!}
                    </p>
                </div>
            </div>

            <!-- MISI -->
            <div class="rounded-3xl shadow-xl border-2 border-[#89FFE7] bg-white overflow-hidden">
                <div class="bg-gradient-to-r from-sky-600 to-cyan-500 px-8 py-5 flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4" />
                    </svg>
                    <h3 class="text-2xl font-bold text-white tracking-wide">MISI</h3>
                </div>

                <div class="p-8">
                    <ul class="space-y-3 text-gray-800 text-lg font-medium">
                        @foreach (explode("\n", $profile->misi) as $misi)
                        @if (trim($misi))
                        <li class="flex items-start gap-3">
                            <span class="w-3 h-3 mt-2 border-2 border-sky-600 rounded-full shrink-0"></span>
                            <span>{{ trim($misi, "•- ") }}</span>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        <!-- TUJUAN -->
        <section class="rounded-3xl shadow-xl border-2 border-[#89FFE7] bg-white overflow-hidden">
            <div class="bg-gradient-to-r from-sky-600 to-cyan-500 px-8 py-5 flex items-center justify-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2z" />
                </svg>
                <h3 class="text-2xl font-bold text-white tracking-wide">TUJUAN</h3>
            </div>

            <div class="p-8">
                <ul class="space-y-3 text-gray-800 text-lg font-medium">
                    @foreach (explode("\n", $profile->tujuan) as $tujuan)
                    @if (trim($tujuan))
                    <li class="flex items-start gap-3 justify-center text-center">
                        <span class="w-3 h-3 mt-2 border-2 border-sky-600 rounded-full shrink-0"></span>
                        <span>{{ trim($tujuan, "•- ") }}</span>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </section>

        <!-- GALERI -->
        <section class="rounded-3xl shadow-xl border-2 border-[#89FFE7] bg-white overflow-hidden">
            <div class="bg-gradient-to-r from-sky-600 to-cyan-500 px-8 py-5 text-center">
                <h3 class="text-2xl font-bold text-white tracking-wide">GALERI FOTO</h3>
            </div>

            <div class="p-8">
                @if ($profile->foto && $profile->foto->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach ($profile->foto as $foto)
                    <figure class="overflow-hidden rounded-2xl shadow-md bg-gray-50 border">
                        <img src="{{ asset('storage/' . $foto->path_foto) }}"
                            alt="{{ $foto->deskripsi ?? 'Galeri ' . $profile->nama_tk }}"
                            class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                        @if ($foto->deskripsi)
                        <figcaption class="p-3 text-center text-sm text-gray-800 bg-white border-t">
                            {{ $foto->deskripsi }}
                        </figcaption>
                        @endif
                    </figure>
                    @endforeach
                </div>
                @else
                <p class="text-gray-500 text-center">Belum ada foto di galeri.</p>
                @endif
            </div>
        </section>

        <!-- LOKASI -->
        <section class="rounded-3xl shadow-xl border-2 border-[#89FFE7] bg-white overflow-hidden">
            <h3 class="text-2xl font-bold text-center py-4 bg-gradient-to-r from-sky-700 to-sky-500 text-white">
                LOKASI TK
            </h3>

            <div class="p-6">
                <div class="w-full h-[350px] rounded-2xl overflow-hidden border">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.082100403435!2d109.5088804!3d-7.6477647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e654b9cc54bdb31%3A0xb081f85019b04085!2sTK%20Aisyiyah%20Bustanul%20Athfal%20Banjareja!5e0!3m2!1sid!2sid!4v1700000000000"
                        class="w-full h-full border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-6 px-6 py-6 border-t bg-sky-50">

                <!-- ALAMAT -->
                <div class="flex gap-3">
                    <div class="shrink-0">
                        <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 12.414a2 2 0 00-2.828 0l-4.243 4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-semibold text-sky-700 mb-1">Alamat</h4>
                        <p class="text-gray-700">
                            TK Aisyiyah Bustanul Athfal<br>
                            Banjareja
                        </p>
                    </div>
                </div>

                <!-- KONTAK -->
                <div class="flex gap-3">
                    <div class="shrink-0">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.128a11.042 11.042 0 005.516 5.516l1.128-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-semibold text-emerald-700 mb-1">Kontak</h4>
                        <p class="text-gray-700">
                            WhatsApp:
                            <a href="https://wa.me/6282294226428" target="_blank"
                                class="font-medium hover:text-emerald-600">
                                0822-9422-6428
                            </a><br>
                            Email:
                            <a href="mailto:tkababanjareja86@gmail.com"
                                class="font-medium hover:text-sky-600">
                                tkababanjareja86@gmail.com
                            </a>
                        </p>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="flex flex-col gap-3 justify-center">
                    <a href="https://maps.app.goo.gl/2zUEd5y5iTpwxfs99" target="_blank"
                        class="bg-gradient-to-r from-sky-500 to-cyan-500 text-white text-center font-semibold px-5 py-2.5 rounded-xl shadow hover:scale-105 transition">
                        Buka Google Maps
                    </a>
                    <a href="https://wa.me/6282294226428" target="_blank"
                        class="bg-gradient-to-r from-emerald-500 to-green-500 text-white text-center font-semibold px-5 py-2.5 rounded-xl shadow hover:scale-105 transition">
                        Chat WhatsApp
                    </a>
                </div>
            </div>
        </section>

    </main>
</x-app-layout>