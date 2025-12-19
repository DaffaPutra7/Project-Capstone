<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PPDB-TK | TK Aisyiyah Bustanul Athfal Banjareja</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-sky-50 to-white min-h-screen font-sans text-gray-800 flex flex-col">

  <!-- HEADER -->
  <header class="shadow-md">
    <!-- Bagian Atas -->
    <div class="bg-gradient-to-r from-[rgba(137,255,231,0.4)] to-[#2E7099] text-white">
      <div class="max-w-7xl mx-auto flex flex-col items-center justify-center py-4">
        <h1 class="text-xl font-bold tracking-wide">PPDB-TK</h1>
        <p class="text-xs opacity-90">TK AISYIYAH BUSTANUL ATHFAL BANJAREJA</p>
      </div>
    </div>

    <!-- Bagian Bawah -->
    <div class="bg-[#CDCDCD] text-[#2E7099]">
      <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-2">
        <!-- Tombol Beranda -->
        <a href="#" class="flex items-center gap-1 hover:text-[#1f4f6e] transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h6m8-11v10a1 1 0 01-1 1h-6" />
          </svg>
          <span class="font-semibold text-sm">Beranda</span>
        </a>

        <!-- Tombol Masuk -->
        <a href="{{ route('login') }}" class="flex items-center gap-1 hover:text-[#1f4f6e] transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
          </svg>
          <span class="font-semibold text-sm">Masuk</span>
        </a>
      </div>
    </div>
  </header>

  <!-- MAIN -->
  <main class="max-w-6xl mx-auto px-4 mt-10 space-y-8 flex-grow">

    <!-- Card Selamat Datang + Statistik -->
    <div class="space-y-0">
      <!-- Card Selamat Datang -->
      <section class="bg-white shadow-md rounded-t-2xl p-6 border border-[#89FFE7] flex flex-col sm:flex-row items-center justify-between gap-6">
        <div class="flex-1">
          <div class="flex items-center gap-2 mb-2">
            <h2 class="text-xl font-bold text-sky-700">SELAMAT DATANG</h2>
          </div>
          <p class="text-gray-600 mt-1 leading-relaxed">
            Penerimaan Peserta Didik Baru (PPDB) Taman Kanak-Kanak Aisyiyah Bustanul Athfal Banjareja.
          </p>
        </div>
        <img src="{{ asset('images/logo-TK-Aisyiyah.png') }}" alt="Logo Sekolah" class="w-24 sm:w-28 h-auto">
      </section>

      <!-- Statistik -->
      <section class="flex flex-col sm:flex-row justify-start items-start sm:items-center flex-wrap gap-2 text-sm bg-white border-x border-b border-[#89FFE7] rounded-b-2xl shadow-md px-6 py-3">
        <!-- Jumlah Pendaftar -->
        <div class="flex items-center gap-2 bg-sky-100 text-sky-800 px-4 py-2 rounded-xl shadow-sm border border-sky-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 10a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 100-8 4 4 0 000 8z" />
          </svg>
          <span><strong>Jumlah Pendaftar:</strong> {{ $jumlahPendaftar }} Orang</span>
        </div>

        <!-- Sisa Kuota Reguler -->
        <div class="flex items-center gap-2 bg-cyan-100 text-sky-800 px-4 py-2 rounded-xl shadow-sm border border-sky-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M18 9a3 3 0 11-6 0 3 3 0 016 0zM6 11a3 3 0 100-6 3 3 0 000 6zm0 0c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm8 4c.34-1.17 1.38-2 2.7-2h1.3c2.21 0 4 1.79 4 4v1h-5" />
          </svg>
          <span>
            <strong>Sisa Kuota Reguler:</strong> {{ $sisaReguler }} Orang
          </span>
        </div>

        <!-- Sisa Kuota Full Day -->
        <div class="flex items-center gap-2 bg-emerald-100 text-emerald-800 px-4 py-2 rounded-xl shadow-sm border border-emerald-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M18 9a3 3 0 11-6 0 3 3 0 016 0zM6 11a3 3 0 100-6 3 3 0 000 6zm0 0c-2.21 0-4 1.79-4 4v1h8v-1c0-2.21-1.79-4-4-4zm8 4c.34-1.17 1.38-2 2.7-2h1.3c2.21 0 4 1.79 4 4v1h-5" />
          </svg>
          <span>
            <strong>Sisa Kuota Full Day:</strong> {{ $sisaFullDay }} Orang
          </span>
        </div>
      </section>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-5 flex flex-wrap gap-3 text-center">
      <!-- Tombol Daftar Sekarang -->
      <a href="{{ route('register') }}"
        class="bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 text-white font-bold px-7 py-3 rounded-xl shadow-lg shadow-orange-200 hover:scale-110 hover:shadow-orange-400 transition-all duration-200 ease-in-out flex items-center gap-2">
        <!-- Icon Clipboard -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        Daftar Sekarang
      </a>


      <!-- Tombol Lihat Status Pendaftaran -->
      <a href="{{ route('login') }}"
        class="bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-600 text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-emerald-200 hover:scale-105 hover:shadow-emerald-400 transition-transform duration-200 ease-in-out flex items-center gap-2">
        <!-- Icon Checklist -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
        </svg>
        Lihat Status Pendaftaran
      </a>
    </div>

    <section class="space-y-8">
      <div class="grid md:grid-cols-2 gap-8">

        <!-- VISI -->
        <div class="p-8 rounded-3xl shadow-xl border-2 border-[#89FFE7]">
          <div class="flex items-center justify-center gap-3 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <h3 class="text-2xl font-bold bg-gradient-to-r from-sky-700 to-sky-500 bg-clip-text text-transparent">
              VISI
            </h3>
          </div>

          <p class="text-gray-800 leading-relaxed text-lg font-medium text-center">
            {{ $profil->visi ?? 'Visi belum diatur oleh admin.' }}
          </p>
        </div>

        <!-- MISI -->
        <div class="p-8 rounded-3xl shadow-xl border-2 border-[#89FFE7]">
          <div class="flex items-center justify-center gap-3 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
            </svg>
            <h3 class="text-2xl font-bold bg-gradient-to-r from-sky-700 to-sky-500 bg-clip-text text-transparent">
              MISI
            </h3>
          </div>

          @if (!empty($profil->misi))
          <ul class="space-y-3 text-left text-gray-800 text-lg font-medium">
            @foreach(explode("\n", $profil->misi) as $item)
            @if(trim($item))
            <li class="flex items-start gap-3">
              <span class="w-3 h-3 mt-2 border-2 border-sky-600 rounded-full shrink-0"></span>
              <span>{{ trim($item, "•- ") }}</span>
            </li>
            @endif
            @endforeach
          </ul>
          @else
          <p class="text-gray-500 text-center">Misi belum diatur oleh admin.</p>
          @endif
        </div>
      </div>

      </div>

      <!-- TUJUAN -->
      <div class="p-8 rounded-3xl shadow-xl border-2 border-[#89FFE7]">
        <div class="flex items-center justify-center gap-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
          </svg>
          <h3 class="text-2xl font-bold bg-gradient-to-r from-sky-700 to-sky-500 bg-clip-text text-transparent">
            TUJUAN
          </h3>
        </div>

        @if (!empty($profil->tujuan))
        <ul class="space-y-3 text-gray-800 leading-relaxed text-lg font-medium">
          @foreach(explode("\n", $profil->tujuan) as $item)
          @if(trim($item))
          <li class="flex items-start gap-2 w-full justify-center text-center">
            <span class="w-2.5 h-2.5 mt-2 border-2 border-sky-600 rounded-full shrink-0"></span>
            <span>
              {{ trim($item, "•- ") }}
            </span>
          </li>
          @endif
          @endforeach
        </ul>
        @else
        <p class="text-gray-500 text-center">Tujuan belum diatur oleh admin.</p>
        @endif


      </div>

      <!-- MOTTO -->
      <div class="text-center mt-8 p-8 rounded-3xl shadow-xl border-2 border-[#89FFE7]">
        <div class="flex items-center justify-center gap-3 mb-4">
          <div class="float-animation">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-sky-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
          </div>
          <h3 class="text-2xl font-bold bg-gradient-to-r from-sky-700 to-sky-500 bg-clip-text text-transparent">
            MOTTO SEKOLAH
          </h3>
        </div>

        <p class="text-gray-800 leading-relaxed text-lg font-medium">
          {{ $profil->motto ?? 'Motto belum diatur oleh admin.' }}
        </p>
      </div>

    </section>

  </main>

  <!-- Footer -->
  {{-- KODE FOOTER BARU DIMULAI DI SINI --}}
  <footer class="mt-16 py-6 bg-[#2E7099] text-white text-sm">
    <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center gap-4">

      <!-- Kiri: Link Google Maps -->
      <div class="text-center sm:text-left">
        <a href="https://maps.app.goo.gl/DtEXPabjH8JkZc2w8?g_st=ipc"
          target="_blank"
          rel="noopener noreferrer"
          class="flex items-center justify-center sm:justify-start gap-2 hover:text-gray-300 transition-colors duration-200">

          <!-- Ikon Pin Lokasi -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <span>Lokasi TK AISYIYAH BUSTANUL ATHFAL BANJAREJA</span>
        </a>
      </div>

      <!-- Kanan: Copyright -->
      <div class="text-center sm:text-right flex items-center justify-center sm:justify-end gap-2">
        <!-- Icon Copyright -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p>2025 TK Aisyiyah Bustanul Athfal Banjareja. Seluruh hak cipta dilindungi.</p>
      </div>
    </div>
  </footer>

</body>

</html>