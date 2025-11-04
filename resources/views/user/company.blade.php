<x-app-layout>

    <main class="max-w-6xl mx-auto p-6 space-y-10">
        <!-- Judul -->
        <section>
            <h1 class="text-5xl font-bold text-sky-700 mb-2">
                Profil TK - {{ $profile->nama_tk ?? 'Nama TK' }}
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
    </main>
</x-app-layout>
