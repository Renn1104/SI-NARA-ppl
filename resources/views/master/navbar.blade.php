<!-- Navbar -->
<nav class="sticky top-0 z-50 bg-white shadow-md">
  <div class="flex items-center justify-between px-4 md:px-6 py-4">
    <!-- Kiri -->
    <div class="flex items-center gap-4">
      <img src="{{ asset('assets/Menu.png') }}" alt="menu" class="w-10 h-10">
      <img src="{{ asset('assets/Home.png') }}" alt="home" class="w-9 h-8">
    </div>

    <!-- Tengah -->
    <div class="flex-1 flex justify-center items-center">
      <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-12 object-contain">
    </div>

    <!-- Kanan -->
    <div class="flex items-center gap-4">
      <a href="{{ route('V_Login') }}" class="px-4 py-2 border-2 border-purple-800 text-purple-800 font-semibold rounded hover:bg-purple-200 transition">
        Masuk
      </a>
      <a href="{{ route('V_Register') }}" class="px-4 py-2.5 bg-purple-800 text-white font-semibold rounded hover:bg-purple-900 transition">
        Daftar
      </a>
    </div>
  </div>

  <!-- Navigasi -->
  <div class="bg-white border-t border-gray-200">
    <ul class="flex flex-wrap justify-center gap-4 md:gap-6 py-3 font-semibold text-gray-700 text-sm md:text-base">
      <li>
        <a href="{{ route('V_konten') }}" class="{{ request()->routeIs('V_konten') ? 'text-black border-b-4 border-purple-800 pb-1' : 'hover:text-purple-700' }}">Konten</a>
      </li>
      <li>
        <a href="{{ route('V_kalenderevent') }}" class="{{ request()->routeIs('V_kalenderevent') ? 'text-black border-b-4 border-purple-800 pb-1' : 'hover:text-purple-700' }}">Kalender Event</a>
      </li>
      <li><a href="#" class="hover:text-purple-700">Reservasi</a></li>
      <li><a href="#" class="hover:text-purple-700">Produk</a></li>
      <li><a href="#" class="hover:text-purple-700">Transaksi</a></li>
    </ul>
  </div>
</nav>