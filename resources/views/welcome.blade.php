<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PPDB-TK | TK Aisyiyah Bustanul Athfal Banjareja</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-sky-50 to-white min-h-screen font-sans text-gray-800">

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
  <main class="max-w-6xl mx-auto px-4 mt-10 space-y-8">

    <!-- 🏫 Card Selamat Datang + Statistik -->
    <div class="space-y-0">
      <!-- 🏫 Card Selamat Datang -->
      <section class="bg-white shadow-md rounded-t-2xl p-6 border border-[#89FFE7] flex flex-col sm:flex-row items-center justify-between gap-6">
        <div class="flex-1">
          <h2 class="text-xl font-bold text-sky-700">SELAMAT DATANG</h2>
          <p class="text-gray-600 mt-1 leading-relaxed">
            Penerimaan Peserta Didik Baru (PPDB) Taman Kanak-Kanak Aisyiyah Bustanul Athfal Banjareja.
          </p>
        </div>
        <img src="{{ asset('images/logo-TK-Aisyiyah.png') }}" alt="Logo Sekolah" class="w-24 sm:w-28 h-auto">
      </section>

      <!-- 📊 Statistik -->
      <section class="flex flex-col sm:flex-row justify-start items-start sm:items-center flex-wrap gap-2 text-sm bg-white border-x border-b border-[#89FFE7] rounded-b-2xl shadow-md px-6 py-3">
        <!-- Jumlah Pendaftar -->
        <div class="flex items-center gap-2 bg-sky-100 text-sky-800 px-4 py-2 rounded-xl shadow-sm border border-sky-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 10a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 100-8 4 4 0 000 8z" />
          </svg>
          <span><strong>Jumlah Pendaftar:</strong> 2500 Orang</span>
        </div>

        <!-- Kuota Pendaftaran -->
        <div class="flex items-center gap-2 bg-emerald-100 text-emerald-800 px-4 py-2 rounded-xl shadow-sm border border-emerald-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z" />
          </svg>
          <span><strong>Kuota Tersedia:</strong> 2500 Peserta</span>
        </div>
      </section>
    </div>

    <!-- Tombol Aksi -->
    <div class="mt-5 flex flex-wrap gap-3">
      <!-- Tombol Daftar Sekarang -->
      <a href="{{ route('register') }}"
        class="bg-gradient-to-r from-sky-500 via-sky-600 to-sky-700 text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-sky-200 hover:scale-105 hover:shadow-sky-400 transition-transform duration-200 ease-in-out">
        Daftar Sekarang
      </a>

      <!-- Tombol Lihat Status Pendaftaran -->
      <a href="{{ route('login') }}"
        class="bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-600 text-white font-semibold px-6 py-2.5 rounded-xl shadow-lg shadow-emerald-200 hover:scale-105 hover:shadow-emerald-400 transition-transform duration-200 ease-in-out">
        Lihat Status Pendaftaran
      </a>
    </div>

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
              <li>Menumbuhkan kecintaan terhadap Al-Qur’an melalui kegiatan tahfidzul Qur’an.</li>
              <li>Menanamkan pembiasaan 5S (Senyum, Salam, Sapa, Sopan, Santun).</li>
              <li>Melaksanakan pembelajaran yang unggul dan kompeten.</li>
              <li>Memotivasi anak agar belajar dalam suasana yang asik dan menyenangkan tanpa tekanan.</li>
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
            <li>Mewujudkan generasi hafidz dan hafidzah yang berakhlakul karimah.</li>
            <li>Membentuk generasi yang aktif, kreatif, asik, dan menyenangkan.</li>
            <li>Membentuk generasi yang berkepribadian kuat serta bertanggung jawab dalam menghadapi era globalisasi.</li>
          </ol>
        </div>
      </div>

      <!-- Motto -->
      <div class="text-center mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-1">MOTTO SEKOLAH</h3>
        <p class="text-gray-700 leading-relaxed">
          Membentuk generasi <span class="font-semibold">“BAKAT”</span> — Berakhlakul karimah, Aktif, Kreatif, Asik, dan Tanggung jawab.
        </p>
      </div>
    </section>

  </main>

  <!-- Footer -->
  <footer class="mt-16 py-4 bg-[#2E7099] text-center text-white text-sm">
    &copy; 2025 TK Aisyiyah Bustanul Athfal Banjareja. Seluruh hak cipta dilindungi.
  </footer>

</body>
</html>
