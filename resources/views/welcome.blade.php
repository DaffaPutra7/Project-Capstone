<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PPDB-TK | TK Aisyiyah Bustanul Athfal Banjareja</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-sky-50 to-white min-h-screen font-sans">
  <!-- Navbar -->
 <header>
  <!-- BAGIAN ATAS (Gradient Header) -->
  <div class="bg-gradient-to-r from-[rgba(137,255,231,0.4)] to-[#2E7099] text-white shadow">
    <div class="max-w-7xl mx-auto flex items-center justify-center px-6 py-3 relative">
      <!-- Teks Tengah -->
      <div class="flex flex-col items-center">
        <h1 class="text-lg font-bold">PPDB-TK</h1>
        <p class="text-xs opacity-90">TK AISYIYAH BUSTANUL ATHFAL BANJAREJA</p>
      </div>
    </div>
  </div>

  <!-- BAGIAN BAWAH (Abu-abu dengan Beranda & Login) -->
  <div class="bg-[#CDCDCD] text-[#2E7099]">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-2 relative">
      
      <!-- Tombol Beranda (kiri) -->
      <a href="#" class="flex items-center gap-1 hover:text-[#1f4f6e] transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h6m8-11v10a1 1 0 01-1 1h-6" />
        </svg>
        <span class="font-semibold text-sm">Beranda</span>
      </a>

      <!-- Tombol Login (kanan) -->
      <a href="#" class="flex items-center gap-1 hover:text-[#1f4f6e] transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
        </svg>
        <span class="font-semibold text-sm">Login</span>
      </a>
    </div>
  </div>
</header>


  <!-- Main -->
  <main class="max-w-6xl mx-auto px-4 mt-8">
    <!-- Card Selamat Datang -->
    <div class="bg-white shadow-md rounded-2xl p-6 border border-gray-100">
      <h2 class="text-lg font-semibold text-sky-700">SELAMAT DATANG</h2>
      <p class="text-gray-600 mt-1">
        Penerimaan Peserta Didik Baru (PPDB) TK Aisyiyah Bustanul Athfal Banjareja
      </p>
      <div class="mt-3">
        <label class="text-sm font-medium text-gray-600">Tahun Ajaran</label>
        <select class="ml-2 border border-gray-300 rounded-lg px-2 py-1 text-sm">
          <option>2025/2026</option>
        </select>
      </div>
    </div>

    <!-- Tombol Navigasi -->
    <div class="flex flex-wrap justify-center gap-6 mt-8">
      <button class="bg-white shadow-md border border-gray-100 rounded-xl px-8 py-4 hover:bg-sky-50 transition flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-600" viewBox="0 0 20 20" fill="currentColor">
          <path d="M8 9a3 3 0 106 0 3 3 0 00-6 0z" />
          <path fill-rule="evenodd" d="M2 10a8 8 0 1114.32 4.906L18 19l-2 2-3.674-3.674A8 8 0 012 10z" clip-rule="evenodd" />
        </svg>
        <span class="font-medium text-gray-700">Pendaftaran</span>
      </button>

      <button class="bg-white shadow-md border border-gray-100 rounded-xl px-8 py-4 hover:bg-sky-50 transition flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-600" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 2a6 6 0 016 6v2a6 6 0 01-12 0V8a6 6 0 016-6zm0 12a8 8 0 008-8V8a8 8 0 11-16 0v-.001A8 8 0 0010 14z" clip-rule="evenodd" />
        </svg>
        <span class="font-medium text-gray-700">Biodata</span>
      </button>

      <button class="bg-white shadow-md border border-gray-100 rounded-xl px-8 py-4 hover:bg-sky-50 transition flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.419 0 4.676.574 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span class="font-medium text-gray-700">Profil TK</span>
      </button>
    </div>

    <!-- Statistik -->
    <div class="flex flex-wrap justify-center gap-10 mt-12">
      <!-- Jumlah Pendaftar -->
      <div class="bg-sky-600 text-white rounded-2xl px-10 py-6 text-center shadow-md">
        <h3 class="font-semibold text-lg mb-2">Jumlah Pendaftar</h3>
        <div class="flex flex-col items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 10a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 100-8 4 4 0 000 8z" />
          </svg>
          <p class="text-3xl font-bold">2500</p>
        </div>
      </div>

      <!-- Kuota Pendaftaran -->
      <div class="bg-sky-600 text-white rounded-2xl px-10 py-6 text-center shadow-md">
        <h3 class="font-semibold text-lg mb-2">Kuota Pendaftaran</h3>
        <div class="flex flex-col items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M9 10a4 4 0 11-8 0 4 4 0 018 0zm6 0a4 4 0 100-8 4 4 0 000 8z" />
          </svg>
          <p class="text-3xl font-bold">2500</p>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
