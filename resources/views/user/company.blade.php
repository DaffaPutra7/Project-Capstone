<x-app-layout>
    <main class="max-w-6xl mx-auto p-6 space-y-10">
        <!-- Judul -->
        <section>
            <h1 class="text-5xl font-bold text-sky-700 mb-2">
                Profil TK - {{ $profil->nama_tk ?? 'Nama TK' }}
            </h1>
        </section>

        <!-- Visi & Misi -->
        <section class="grid md:grid-cols-2 gap-6">
            <!-- Visi -->
            <div class="bg-white border rounded-2xl shadow-sm p-6 border-[#89FFE7]">
                <h2 class="text-lg font-bold text-center text-white bg-sky-700 rounded-t-xl py-2 -mx-6 -mt-6 mb-4">
                    VISI
                </h2>
                <p class="text-gray-700 text-justify leading-relaxed">
                    {{ $profil->visi ?? 'Visi belum diatur.' }}
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-white border rounded-2xl shadow-sm p-6 border-[#89FFE7]">
                <h2 class="text-lg font-bold text-center text-white bg-sky-700 rounded-t-xl py-2 -mx-6 -mt-6 mb-4">
                    MISI
                </h2>
                <ol class="list-decimal list-inside text-gray-700 space-y-2 leading-relaxed">
                    {!! $profil->misi ?? 'Misi belum diatur.' !!}
                </ol>
            </div>
        </section>

        <!-- Tujuan -->
        <section class="bg-white border rounded-2xl shadow-sm p-6 border-[#89FFE7]">
            <h2 class="text-lg font-bold text-center text-white bg-sky-700 rounded-t-xl py-2 -mx-6 -mt-6 mb-4">
                TUJUAN
            </h2>
            <ol class="list-decimal list-inside text-gray-700 space-y-2 leading-relaxed">
                {!! $profil->tujuan ?? 'Tujuan belum diatur.' !!}
            </ol>
        </section>

        <!-- Motto -->
        <section>
            <h2 class="text-lg font-bold text-gray-800 mb-2">MOTTO SEKOLAH</h2>
            <p class="text-gray-700">
                {!! $profil->motto ?? 'Moto belum diatur.' !!}
            </p>
        </section>
    </main>
</x-app-layout>