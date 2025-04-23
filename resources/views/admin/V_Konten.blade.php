<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SI-NARA konten</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="font-sans bg-white">

  <!-- Navbar -->
  <nav class="sticky top-0 z-50 bg-white shadow-md">
    <div class="flex items-center justify-between px-6 py-4">
      <!-- Kiri: Icon menu & home -->
      <div class="flex items-center gap-4">
        <!-- <a href="{{ route('V_Landing') }}"> -->
          <img src="{{ asset('assets/Menu.png') }}" alt="humberger" class="w-10 h-10">
        <!-- </a> -->
        <a href="{{ route('V_Landing') }}">
            <img src="{{ asset('assets/Home.png') }}" alt="Home Icon" class="w-9 h-8 hover:opacity-80 transition duration-300">
        </a>
      </div>

      <!-- Tengah: Logo -->
      <div class="flex items-center gap-2 text-purple-800 font-bold text-xl">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="w-24 h-auto max-h-12">
      </div>

      <!-- Kanan: Icon user & cart -->
      <div class="flex items-center gap-4 text-2xl">
        <!-- <a href="{{ route('V_Login') }}"><img src="{{ asset('assets/cart.png') }}" alt="user icon" class="w-9 h-9 hover:opacity-80 transition duration-300"></a> -->
        <a href="{{ route('V_Login') }}"><img src="{{ asset('assets/user.png') }}" alt="user icon" class="w-10 h-10 hover:opacity-80 transition duration-300"></a>
      </div>
    </div>

    <!-- Menu Navigasi -->
    <div class="bg-white border-t border-gray-200">
      <ul class="flex justify-center gap-6 py-3 font-semibold text-gray-700">
        <li>
          <a href="{{ route('V_Konten') }}" 
             class="{{ request()->routeIs('V_Konten') ? 'text-black border-b-4 border-purple-800 pb-1' : 'hover:text-purple-700' }}">
             Konten
          </a>
        </li>
        <li>
          <a href="{{ route('V_KalenderEvent') }}" 
             class="{{ request()->routeIs('V_KalenderEvent') ? 'text-black border-b-4 border-purple-800 pb-1' : 'hover:text-purple-700' }}">
             Kalender Event
          </a>
        </li>
        <li>
          <a href="#" class="hover:text-purple-700">Reservasi</a>
        </li>
        <li>
          <a href="#" class="hover:text-purple-700">Produk</a>
        </li>
        <li>
          <a href="#" class="hover:text-purple-700">Transaksi</a>
        </li>
        <li>
          <a href="#" class="hover:text-purple-700">Transaksi</a>
        </li>
      </ul>
    </div>
  </nav>

      <!-- Tombol Tambah Event -->
      @if(Auth::user()->role == 'admin')
  <div class="flex justify-end mt-6 px-6">
    <a href="{{route('konten.create')}}"
       class="flex items-center space-x-2 bg-purple-800 text-white px-4 py-2 rounded-full shadow hover:bg-purple-700 transition">
      <span class="text-lg"></span>
        <span class="text-sm md:text-base font-medium">Tambah Konten</span>
        
        <span class="text-lg">＋</span>
      </a>
    </div>
    @else
    @endif


  <!-- Rekomendasi -->
<section class="px-4 md:px-6 py-10">
  <h2 class="text-center text-lg font-bold mb-7">KONTEN SI-NARA</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
  @php
    $items = [
      ['img' => 'assets/Konten1.png', 'title' => 'Panen Anggur Hitam'],
      ['img' => 'assets/Konten2.png', 'title' => 'Tari Tradisional'],
      ['img' => 'assets/Konten3.png', 'title' => 'Tari Suwun'],
      ['img' => 'assets/Konten4.png', 'title' => 'Panen Anggur Hijau'],
      ['img' => 'assets/Konten5.png', 'title' => 'Tari Gandrung'],
      ['img' => 'assets/Konten6.png', 'title' => 'Hijau Lestari'],
    ];
    @endphp
    return view('admin.konten.index', compact('items'));
      @foreach ($items as $item)
      <div class="bg-white shadow-md rounded-xl overflow-hidden transform transition hover:scale-105">
        <img src="{{ asset($item['img']) }}" alt="{{ $item['title'] }}" class="w-full h-48 object-cover">
        <p class="text-center py-2 font-semibold">{{ $item['title'] }}</p>
      </div>
    @endforeach

  </div>
</section>


  <!-- Footer -->
  <footer class="bg-purple-900 text-white mt-10 py-8 px-4">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-start">
      <div>
        <div class="flex items-center mb-2">
        <img src="{{ asset('assets/logo sinara.png') }}" alt="Poster budaya" class="w-50 h-20 mr-2">
          <!-- <img src="https://i.imgur.com/uqA0GMc.png" class="w-6 h-6 mr-2" /> -->
          <span class="font-bold text-lg"></span>
        </div>
        <p>Jember<br>Indonesia</p>
        <p class="mt-2">Telepon: +62 81249494460</p>
        <p>Email: sinara.id@gmail.com</p>
      </div>
      <div class="mt-4 md:mt-0">
        <h3 class="font-semibold mb-2">Kunjungi kami di:</h3>
        <br>
        <div class="flex space-x-4 text-2xl">
        <a href="https://www.instagram.com/nara_garden_jember?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="hover:opacity-75 transition duration-300"><img src="{{ asset('assets/ig.png') }}" alt="instagram" class="w-10 h-10 mr-10"></a>
        <a href="https://www.tiktok.com/@nara_jember?is_from_webapp=1&sender_device=pc" target="_blank" class="hover:opacity-75 transition duration-300"><img src="{{ asset('assets/tt.png') }}" alt="tiktok" class="w-10 h-10 mr-10"></a>
        <a href="https://youtube.com/@hadi_poernomo?si=F12sY3DziCDUbE8k" target="_blank" class="hover:opacity-75 transition duration-300"><img src="{{ asset('assets/Youtube.png') }}" alt="youtube" class="w-10 h-10 mr-10"></a>
        </div>
      </div>
    </div>
    <div class="text-center mt-4 text-sm">
      @CopyRight by SI-NARA
    </div>
  </footer>
</body>
</html>