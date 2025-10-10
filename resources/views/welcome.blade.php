<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PPDB-TK | TK Aisyiyah Bustanul Athfal Banjareja</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-sky-50 to-white min-h-screen font-sans text-gray-800">

  <!-- 🌈 HEADER -->
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

        <!-- Tombol Login -->
        <a href="{{ route('login') }}" class="flex items-center gap-1 hover:text-[#1f4f6e] transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
          </svg>
          <span class="font-semibold text-sm">Login</span>
        </a>
      </div>
    </div>
  </header>

  <!-- 🌸 MAIN -->
  <main class="max-w-6xl mx-auto px-4 mt-10 space-y-12">

    <!-- 🪴 Card Selamat Datang -->
    <section class="bg-white shadow-md rounded-2xl p-6 border border-[#89FFE7] flex flex-col sm:flex-row items-center justify-between gap-6">
      <div class="flex-1">
        <h2 class="text-xl font-bold text-sky-700">SELAMAT DATANG</h2>
        <p class="text-gray-600 mt-1 leading-relaxed">
          Penerimaan Peserta Didik Baru (PPDB) TK Aisyiyah Bustanul Athfal Banjareja
        </p>
        <div class="mt-4">
          <label class="text-sm font-medium text-gray-600">Tahun Ajaran</label>
          <select class="ml-2 border border-[#89FFE7] rounded-lg px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-sky-400">
            <option>2025/2026</option>
          </select>
        </div>
      </div>

      <img src="{{ asset('images/logo-TK-Aisyiyah.png') }}" alt="Logo" class="w-24 sm:w-28 h-auto">
    </section>

    <!-- 🌼 Visi Misi Tujuan -->
    <section class="space-y-8">
      <!-- Visi & Misi -->
      <div class="grid md:grid-cols-2 gap-6">
        <!-- Visi -->
        <div class="bg-white border border-[#89FFE7] rounded-2xl shadow-md overflow-hidden">
          <div class="bg-sky-600 text-white font-semibold text-center py-2 text-lg">VISI</div>
          <div class="p-5 text-gray-700 leading-relaxed">
            <p>
              Mewujudkan anak didik menjadi generasi yang berakhlakul karimah, aktif, kreatif, asik, dan bertanggung jawab.
            </p>
          </div>
        </div>

        <!-- Misi -->
        <div class="bg-white border border-[#89FFE7] rounded-2xl shadow-md overflow-hidden">
          <div class="bg-sky-600 text-white font-semibold text-center py-2 text-lg">MISI</div>
          <div class="p-5 text-gray-700 leading-relaxed">
            <ol class="list-decimal list-inside space-y-2">
              <li>Mencintai Al-Qur’an melalui kegiatan tahfidzul Qur’an.</li>
              <li>Pembiasaan 5S (senyum, salam, sapa, sopan, santun).</li>
              <li>Melaksanakan pembelajaran yang unggul dan kompeten.</li>
              <li>Memotivasi anak dalam kegiatan yang asik dan menyenangkan tanpa beban.</li>
              <li>Melatih anak menjadi pribadi yang mandiri, percaya diri, dan bertanggung jawab.</li>
            </ol>
          </div>
        </div>
      </div>

      <!-- Tujuan -->
      <div class="bg-white border border-[#89FFE7] rounded-2xl shadow-md overflow-hidden">
        <div class="bg-sky-700 text-white font-semibold text-center py-2 text-lg">TUJUAN</div>
        <div class="p-5 text-gray-700 leading-relaxed">
          <ol class="list-decimal list-inside space-y-2">
            <li>Mewujudkan generasi hafidz-hafidzah yang berakhlakul karimah.</li>
            <li>Membentuk generasi yang aktif, kreatif, asik, dan menyenangkan.</li>
            <li>Membentuk generasi yang berkepribadian serta tanggung jawab dalam menghadapi era globalisasi.</li>
          </ol>
        </div>
      </div>

      <!-- Motto -->
      <div class="text-center mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-1">MOTTO SEKOLAH</h3>
        <p class="text-gray-700 leading-relaxed">
          Membentuk generasi <span class="font-semibold">“BAKAT”</span> berakhlakul karimah, aktif, kreatif, asik, dan tanggung jawab.
        </p>
      </div>
    </section>

    <!-- 📊 Statistik -->
    <section class="flex flex-wrap justify-center gap-20 mt-10">
      
      <!-- Jumlah Pendaftar -->
      <div class="flex flex-col items-center">
        <div class="bg-[#2E7099] text-white font-semibold text-sm px-14 py-5 rounded-full mb-2 shadow">
          Jumlah Pendaftar
        </div>
        <div class="flex items-center gap-2 text-[#2E7099]">
          <!-- Icon orang -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 10a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 100-8 4 4 0 000 8z" />
          </svg>
          <span class="text-3xl font-bold">2500</span>
        </div>
      </div>

      <!-- Kuota Pendaftaran -->
      <div class="flex flex-col items-center">
        <div class="bg-[#2E7099] text-white font-semibold text-sm px-14 py-5 rounded-full mb-2 shadow">
          Kuota Pendaftaran
        </div>
        <div class="flex items-center gap-2 text-[#2E7099]">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 10a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 100-8 4 4 0 000 8z" />
          </svg>
          <span class="text-3xl font-bold">2500</span>
        </div>
      </div>

    </section>

  </main>

  <!-- 🌿 Footer -->
  <footer class="mt-16 py-4 bg-[#2E7099] text-center text-white text-sm">
    &copy; 2025 TK Aisyiyah Bustanul Athfal Banjareja. All rights reserved.
  </footer>

</body>
</html>
