<x-app-layout>
    <main class="max-w-6xl mx-auto p-6 space-y-10">
        {{-- ... (Section Judul, Visi, Misi, Tujuan - Tidak ada perubahan) ... --}}
        <section>
            <h1 class="text-5xl font-bold text-sky-700 mb-2">
                Profil TK - {{ $profile->nama_tk ?? 'Nama TK' }}
            </h1>
        </section>

        <section class="grid md:grid-cols-2 gap-6">
            <div class="bg-white border rounded-2xl shadow-sm p-6 border-[#89FFE7]">
                <h2 class="text-lg font-bold text-center text-white bg-sky-700 rounded-t-xl py-2 -mx-6 -mt-6 mb-4">
                    VISI
                </h2>
                <p class="text-gray-700 text-justify leading-relaxed">
                    {!! nl2br(e($profile->visi)) !!}
                </p>
            </div>

            <div class="bg-white border rounded-2xl shadow-sm p-6 border-[#89FFE7]">
                <h2 class="text-lg font-bold text-center text-white bg-sky-700 rounded-t-xl py-2 -mx-6 -mt-6 mb-4">
                    MISI
                </h2>
                <ol class="list-decimal list-inside text-gray-700 space-y-2 leading-relaxed">
                    @foreach (explode("\n", $profile->misi) as $misi)
                    @if (trim($misi))
                    <li>{{ $misi }}</li>
                    @endif
                    @endforeach
                </ol>
            </div>
        </section>

        <section class="bg-white border rounded-2xl shadow-sm p-6 border-[#89FFE7]">
            <h2 class="text-lg font-bold text-center text-white bg-sky-700 rounded-t-xl py-2 -mx-6 -mt-6 mb-4">
                TUJUAN
            </h2>
            <ol class="list-decimal list-inside text-gray-700 space-y-2 leading-relaxed">
                @foreach (explode("\n", $profile->tujuan) as $tujuan)
                @if (trim($tujuan))
                <li>{{ $tujuan }}</li>
                @endif
                @endforeach
            </ol>
        </section>

        <section class="bg-white border rounded-2xl shadow-sm p-6 border-[#89FFE7]">
            <h2 class="text-lg font-bold text-center text-white bg-sky-700 rounded-t-xl py-2 -mx-6 -mt-6 mb-4">
                GALERI FOTO
            </h2>

            @if ($profile->foto && $profile->foto->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($profile->foto as $foto)

                {{-- Gunakan <figure> dan <figcaption> --}}
                <figure class="overflow-hidden rounded-lg shadow-md flex flex-col bg-gray-50 border">
                    {{-- Gambar --}}
                    <img src="{{ asset('storage/' . $foto->path_foto) }}"
                        alt="{{ $foto->deskripsi ?? 'Galeri ' . $profile->nama_tk }}"
                        class="w-full h-48 object-cover transform transition-transform duration-300 hover:scale-110">

                    {{-- Deskripsi (hanya tampil jika ada) --}}
                    @if ($foto->deskripsi)
                    <figcaption class="p-3 text-center text-sm text-gray-800 border-t bg-white">
                        {{ $foto->deskripsi }}
                    </figcaption>
                    @endif
                </figure>

                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-center">Belum ada foto di galeri.</p>
            @endif
        </section>
        <section class="bg-white border rounded-2xl shadow-sm p-6 border-[#89FFE7] mt-8">
            <h2 class="text-lg font-bold text-center text-white bg-sky-700 rounded-t-xl py-2 -mx-6 -mt-6 mb-4">
                LOKASI TK
            </h2>

            <div class="space-y-4">
                <div class="w-full h-[350px] rounded-xl overflow-hidden border">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.082100403435!2d109.5088804!3d-7.6477647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e654b9cc54bdb31%3A0xb081f85019b04085!2sTK%20’Aisyiyah%20Bustanul%20Athfal%20Banjareja!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid"
                        class="w-full h-full border-0"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="text-center">
                    <a href="https://maps.app.goo.gl/2zUEd5y5iTpwxfs99"
                        target="_blank"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-sky-500 to-cyan-500 text-white font-semibold px-6 py-3 rounded-xl shadow hover:scale-105 transition">
                        Buka dengan Google Maps
                    </a>
                </div>
            </div>
        </section>

    </main>
</x-app-layout>