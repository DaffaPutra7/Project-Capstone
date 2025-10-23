<x-app-layout>
    @php
        // ====== DUMMY DATA (sementara gantiin data dari DB) ======
        $profile = (object) [
            'visi' => 'Mewujudkan anak didik menjadi generasi yang berakhlakul karimah, aktif, kreatif, asik, dan bertanggung jawab.',
            'misi' => "1. Mencintai Al Qur’an melalui kegiatan tahfidzul qur’an.\n2. Pembiasaan 5S (senyum, salam, sapa, sopan, santun).\n3. Melaksanakan pembelajaran yang unggul dan kompeten.\n4. Memotivasi anak dalam kegiatan yang asik dan menyenangkan tanpa beban.\n5. Melatih anak menjadi pribadi yang mandiri, percaya diri, dan bertanggung jawab.",
            'tujuan' => "1. Mewujudkan generasi hafidz-hafidzah yang berakhlakul karimah.\n2. Membentuk generasi yang aktif, kreatif, asik, dan menyenangkan.\n3. Membentuk generasi yang berkepribadian serta tanggung jawab dalam menghadapi era globalisasi.",
            'motto' => 'Membentuk generasi “BAKAT” berakhlakul karimah, aktif, kreatif, asik, dan tanggung jawab.'
        ];
    @endphp

    <main class="max-w-6xl mx-auto p-6 space-y-10">
        <!-- Judul -->
        <section>
            <h1 class="text-5xl font-bold text-sky-700 mb-2">
                Profil TK - {{ $profil->nama_tk ?? 'Nama TK' }}
            </h1>
        </section>

        <!-- VISI & MISI -->
        <section class="grid md:grid-cols-2 gap-6">
            <!-- VISI -->
            <div class="bg-white border rounded-2xl shadow-sm p-6 border-[#89FFE7]">
                <h2 class="text-lg font-bold text-center text-white bg-sky-700 rounded-t-xl py-2 -mx-6 -mt-6 mb-4">
                    VISI
                </h2>
                <p class="text-gray-700 text-justify leading-relaxed">
                    {!! nl2br(e($profile->visi)) !!}
                </p>
            </div>

            <!-- MISI -->
            <div class="bg-white border rounded-2xl shadow-sm p-6 border-[#89FFE7]">
                <h2 class="text-lg font-bold text-center text-white bg-sky-700 rounded-t-xl py-2 -mx-6 -mt-6 mb-4">
                    MISI
                </h2>
                <ol class="list-decimal list-inside text-gray-700 space-y-2 leading-relaxed">
                    @foreach (explode("\n", $profile->misi) as $misi)
                        <li>{{ $misi }}</li>
                    @endforeach
                </ol>
            </div>
        </section>

        <!-- TUJUAN -->
        <section class="bg-white border rounded-2xl shadow-sm p-6 border-[#89FFE7]">
            <h2 class="text-lg font-bold text-center text-white bg-sky-700 rounded-t-xl py-2 -mx-6 -mt-6 mb-4">
                TUJUAN
            </h2>
            <ol class="list-decimal list-inside text-gray-700 space-y-2 leading-relaxed">
                @foreach (explode("\n", $profile->tujuan) as $tujuan)
                    <li>{{ $tujuan }}</li>
                @endforeach
            </ol>
        </section>

        <!-- MOTTO -->
        <section>
            <h2 class="text-lg font-bold text-gray-800 mb-2">MOTTO SEKOLAH</h2>
            <p class="text-gray-700">
                {!! nl2br(e($profile->motto)) !!}
            </p>
        </section>
    </main>
</x-app-layout>
