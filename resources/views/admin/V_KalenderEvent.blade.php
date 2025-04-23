<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SI-NARA Homepage</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="font-sans bg-white">

  <!-- Navbar -->
<nav class="sticky top-0 z-50 bg-white shadow-md">
  <div class="flex items-center justify-between px-4 md:px-6 py-4">
    <!-- Kiri -->
    <div class="flex items-center gap-4">
      <img src="{{ asset('assets/Menu.png') }}" alt="menu" class="w-10 h-10">
      <a href="{{ route('V_Landing') }}">
            <img src="{{ asset('assets/Home.png') }}" alt="Home Icon" class="w-9 h-8 hover:opacity-80 transition duration-300">
        </a>
    </div>

    <!-- Tengah -->
    <div class="flex-1 flex justify-center items-center">
      <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-12 object-contain">
    </div>

  <!-- Kanan -->
     <!-- @uf(Auth::user()->roles != 'admin'); -->
 @if (Auth::user()) 
    {{-- tampilkan dropdown user --}}
     <div class="flex items-center">
        <div class="flex items-center ms-3">
            <!-- <div class=" mr-2.5 bg-[#178948] rounded-lg"> -->
              <p class="px-4 py-1 text-white">{{Auth::user()->name}}</p>
            </div>
                    <div>
                        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{Auth::user()->name}}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{Auth::user()->email}}
                            </p>
                        </div>
                                 <ul class="py-1" role="none">
                   <li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
     @else
      <div class="flex items-center gap-4">
      <a href="{{ route('V_Login') }}" class="px-4 py-2 border-2 border-purple-800 text-purple-800 font-semibold rounded hover:bg-purple-200 transition">
        Masuk
      </a>
      <a href="{{ route('V_Register') }}" class="px-4 py-2.5 bg-purple-800 text-white font-semibold rounded hover:bg-purple-900 transition">
        Daftar
      </a>
    </div>
    @endif
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
      </ul>
    </div>
  </nav>


  <!-- <--Tombol Tambah Event -->
  <div class="flex justify-end mt-6 px-6"> 
    <a href="#"
       class="flex items-center space-x-2 bg-purple-800 text-white px-4 py-2 rounded-full shadow hover:bg-purple-700 transition">
      <span class="text-lg"></span>
      <span class="text-sm md:text-base font-medium">Tambah Kalender Event</span>
      <span class="text-lg">＋</span>
    </a>
  </div>

  <!-- Konten Kalender + Detail Event -->
  <div class="flex flex-col md:flex-row gap-4 p-6 bg-white max-w-7xl mx-auto">

    <!-- Kalender -->
    <div class="w-full md:w-2/3 bg-white rounded-md shadow-md">
      <!-- Header Kalender -->
      <div class="flex items-center justify-between bg-purple-700 text-white px-4 py-3 rounded-t-md">
        <h2 class="text-lg font-semibold">JULI 2024</h2>
        <button class="text-2xl">📅</button>
      </div>

      <!-- Hari -->
      <div class="grid grid-cols-7 text-center text-sm py-2 font-semibold text-gray-700 border-b">
        <div>M</div><div>S</div><div>S</div><div>R</div><div>K</div><div>J</div><div>S</div>
      </div>

      <!-- Tanggal -->
      <div class="grid grid-cols-7 text-center gap-y-4 py-4 text-sm">
        <!-- Minggu 1 -->
        <div class="text-gray-400">1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div><div>7</div>
        <!-- Minggu 2 -->
        <div>8</div>
        <div class="relative">
          <div class="cursor-pointer hover:bg-purple-100 rounded-full w-8 h-8 flex items-center justify-center mx-auto">9</div>
          <div class="w-2 h-2 bg-purple-700 rounded-full absolute bottom-0 left-1/2 -translate-x-1/2"></div>
        </div>
        <div class="relative">
          <div class="cursor-pointer hover:bg-purple-100 rounded-full w-8 h-8 flex items-center justify-center mx-auto">10</div>
          <div class="w-2 h-2 bg-purple-700 rounded-full absolute bottom-0 left-1/2 -translate-x-1/2"></div>
        </div>
        <div>11</div><div>12</div>
        <div class="relative">
          <div class="cursor-pointer hover:bg-purple-100 rounded-full w-8 h-8 flex items-center justify-center mx-auto">13</div>
          <div class="w-2 h-2 bg-purple-700 rounded-full absolute bottom-0 left-1/2 -translate-x-1/2"></div>
        </div>
        <div class="relative">
          <div class="cursor-pointer hover:bg-purple-100 rounded-full w-8 h-8 flex items-center justify-center mx-auto">14</div>
          <div class="w-2 h-2 bg-purple-700 rounded-full absolute bottom-0 left-1/2 -translate-x-1/2"></div>
        </div>
        <!-- Minggu 3 -->
        <div class="cursor-pointer border border-purple-600 bg-purple-100 text-purple-800 font-semibold rounded-full w-8 h-8 flex items-center justify-center mx-auto">15</div>
        <div class="relative">
          <div class="cursor-pointer hover:bg-purple-100 rounded-full w-8 h-8 flex items-center justify-center mx-auto">16</div>
          <div class="w-2 h-2 bg-purple-700 rounded-full absolute bottom-0 left-1/2 -translate-x-1/2"></div>
        </div>
        <div>17</div><div>18</div><div>19</div><div>20</div><div>21</div>
        <!-- Minggu 4 -->
        <div>22</div><div>23</div><div>24</div><div>25</div><div>26</div><div>27</div><div>28</div>
        <!-- Minggu 5 -->
        <div>29</div><div>30</div><div>31</div><div></div><div></div><div></div><div></div>
      </div>

      <!-- Deskripsi Event -->
      <div class="mt-6 px-2 text-center">
        <h3 class="text-lg font-semibold italic">Festival Budaya Nusantara</h3>
        <p class="text-sm text-gray-700 mt-2 leading-relaxed">
        Siap-siap terpukau dalam Festival budaya dari seluruh penjuru Indonesia? Festival ini akan dimeriahkan oleh beragam pertunjukan seni yang seru dan autentik, dibawakan langsung oleh para ahli di bidangnya.
        Mulai dari tarian tradisional, musik etnik, hingga atraksi budaya khas tiap daerah, semuanya hadir dalam satu panggung spektakuler yang sayang banget untuk dilewatkan.
        </p>
      </div>
    </div>

    <!-- Detail Poster & Waktu -->
    <div class="w-full md:w-1/3 bg-white flex flex-col items-center">
        <img src="https://i.pinimg.com/originals/31/d7/31/31d731a44c0068d5ec359002084fbb0e.png" alt="Poster Festival Budaya" class="w-full h-auto rounded-lg shadow object-cover">
    <div class="mt-4 text-sm space-y-2">
        <div class="flex items-center space-x-2">
        <!-- <img src="{{ asset('assets/Calender event.png') }}" alt="kalender event" class="w-full rounded-lg shadow"> -->
          <span class="text-xl">📅</span>
          <span class="text-base font-medium">16 Juli 2024</span>
        </div>
        <div class="flex items-center space-x-2">
          <span class="text-xl">⏰</span>
          <span class="text-base font-medium">08.00 - selesai</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-purple-900 text-white mt-10 py-8 px-4">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between">
      <div class="mb-6 md:mb-0">
        <div class="flex items-center mb-2">
          <img src="{{ asset('assets/logo sinara.png') }}" alt="Logo" class="w-36 h-auto">
        </div>
        <p>Jember, Indonesia</p>
        <p class="mt-2">Telepon: +62 823-3532-2371</p>
        <p>Email: selobonang@gmail.com</p>
      </div>
      <div>
        <h3 class="font-semibold mb-2">Kunjungi kami di:</h3>
        <div class="flex gap-4 mt-2">
          <a href="https://www.instagram.com/nara_garden_jember" target="_blank">
            <img src="{{ asset('assets/ig.png') }}" alt="Instagram" class="w-10 h-10">
          </a>
          <a href="https://www.tiktok.com/@nara_jember" target="_blank">
            <img src="{{ asset('assets/tt.png') }}" alt="TikTok" class="w-10 h-10">
          </a>
          <a href="https://youtube.com/@hadi_poernomo" target="_blank">
            <img src="{{ asset('assets/Youtube.png') }}" alt="YouTube" class="w-10 h-10">
          </a>
        </div>
      </div>
    </div>
    <div class="text-center mt-6 text-sm">
      &copy; 2025 SI-NARA
    </div>
  </footer>

</body>
</html>
