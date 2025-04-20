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
      <img src="{{ asset('assets/Home.png') }}" alt="home" class="w-9 h-8">
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
     <!-- @else -->
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

  <!-- Carousel -->
  <section class="relative w-full h-64 sm:h-80 md:h-96 overflow-hidden" id="carousel">
  <!-- Slides -->
  <div class="carousel-slides w-full h-full relative">
  @php
  $slides = [
    [
      'img' => 'https://indonesiakaya.com/wp-content/uploads/2025/03/SLIDER-BANNER.jpg',
      'link' => 'https://www.youtube.com/watch?v=sVAlntCnM0Q&list=PL-ZVYC7zvvypXJO9nYXQUVshzF5iJfxa7'
    ],
    [
      'img' => 'https://indonesiakaya.com/wp-content/uploads/2025/04/gik-19april-1519.jpg',
      'link' => 'https://indonesiakaya.com/agenda-budaya/'
    ],
    [
      'img' => 'https://indonesiakaya.com/wp-content/uploads/2025/01/download-74.jpeg',
      'link' => 'https://indonesiakaya.com/pustaka-indonesia/buku-indonesia-habis-gelap-terbitlah-terang-ra-kartini/'
    ]
  ];
@endphp

  @foreach ($slides as $index => $slide)
    <a href="{{ $slide['link'] }}" target="_blank" class="carousel-item absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100 z-20' : 'opacity-0 z-10' }}" style="background-image: url('{{ $slide['img'] }}');"> 
   </a>
  @endforeach


  </div>

  <!-- Panah -->
  <button id="prevBtn" class="absolute top-1/2 left-4 transform -translate-y-1/2 text-3xl text-white hover:text-purple-300 z-30">❮</button>
  <button id="nextBtn" class="absolute top-1/2 right-4 transform -translate-y-1/2 text-3xl text-white hover:text-purple-300 z-30">❯</button>

  <!-- Indikator -->
  <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2 z-30">
    @foreach ($slides as $index => $slide)
      <div class="carousel-dot w-3 h-3 rounded-full {{ $index === 0 ? 'bg-purple-500' : 'bg-gray-300' }}"></div>
    @endforeach
  </div>
</section>

  <!-- Tentang -->
  <section class="px-4 md:px-6 py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto text-center">
      <div class="flex flex-col items-center mb-6">
        <img src="{{ asset('assets/logo.png') }}" alt="Icon Anggur" class="w-36 h-auto mb-4 animate-bounce" />
        <h2 class="text-3xl font-bold text-purple-800">Tentang Nara Garden</h2>
      </div>
      <p class="text-gray-700 text-justify text-base md:text-lg leading-relaxed">
      Didirikan pada tahun 2021, Nara Garden Jember hadir sebagai destinasi wisata agro yang mengusung konsep petik buah langsung dari kebun. Terletak di Jember, Jawa Timur, tempat ini menawarkan pengalaman unik bagi pengunjung untuk memetik buah anggur langsung dari pohonnya sambil menikmati suasana kebun yang asri, sejuk, dan menyegarkan.
      Sejak dibuka, Nara Garden telah menjadi tempat favorit keluarga untuk menghabiskan waktu bersama. Aktivitas petik anggur tidak hanya seru, tetapi juga edukatif—terutama bagi anak-anak yang ingin mengenal lebih dekat proses budidaya tanaman buah.
      Selain area kebun, Nara Garden juga menyediakan fasilitas lengkap seperti area bermain anak, kafe dengan menu lokal, serta tempat bersantai yang cocok untuk berswafoto. Tempat ini ideal untuk dijadikan lokasi piknik keluarga, edutrip sekolah, foto prewedding, atau bahkan acara komunitas dan gathering.
      Dengan semangat memadukan wisata, edukasi, dan nuansa alam, Nara Garden terus berkembang menjadi salah satu ikon wisata agro terbaik di Jember.
      </p>
    </div>
  </section>

  <!-- Rekomendasi -->
  <section class="px-4 md:px-6 py-10">
    <h2 class="text-center text-lg font-bold mb-7">KONTEN SI-NARA</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
      @foreach ([
        ['img' => 'https://asset.kompas.com/crops/hDtvYX-grg8Xt-gyhAM5LKHEtW4=/100x67:900x600/1200x800/data/photo/2022/12/29/63ad0ce09d95a.jpg', 'title' => 'Panen Anggur'],
        ['img' => 'https://asset.kompas.com/crops/WN3Y6wXytRklh_u9QcuTfmJX3wk=/0x0:750x500/1200x800/data/photo/2022/02/26/6219a4e3e53c2.jpeg', 'title' => 'Tari Gandrung'],
        ['img' => 'https://asset.kompas.com/crops/57U1WwJNOTq5mopVfMRAn4toPnI=/29x29:705x480/1200x800/data/photo/2021/02/08/60211aa458180.jpg', 'title' => 'Tari Suwun'],
      ] as $item)
        @for ($i = 0; $i < 2; $i++) <!-- duplikat x2 -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden transform transition hover:scale-105">
          <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}" class="w-full h-48 object-cover">
          <p class="text-center py-2 font-semibold">{{ $item['title'] }}</p>
        </div>
        @endfor
      @endforeach
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-purple-900 text-white mt-10 py-8 px-4">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between">
      <div class="mb-6 md:mb-0">
        <div class="flex items-center mb-2">
          <img src="{{ asset('assets/logo sinara.png') }}" alt="Logo" class="w-36 h-auto">
        </div>
        <p>Jember, Indonesia</p>
        <p class="mt-2">Telepon: +62 81249494460</p>
        <p>Email: sinara.id@gmail.com</p>
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

  <script>
  const slides = document.querySelectorAll('.carousel-item');
  const dots = document.querySelectorAll('.carousel-dot');
  let currentIndex = 0;
  let intervalTime = 5000;
  let interval = setInterval(nextSlide, intervalTime);

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.toggle('opacity-100', i === index);
      slide.classList.toggle('z-20', i === index);
      slide.classList.toggle('opacity-0', i !== index);
      slide.classList.toggle('z-10', i !== index);
    });

    dots.forEach((dot, i) => {
      dot.classList.toggle('bg-purple-500', i === index);
      dot.classList.toggle('bg-gray-300', i !== index);
    });

    currentIndex = index;
  }

  function nextSlide() {
    let next = (currentIndex + 1) % slides.length;
    showSlide(next);
  }

  function prevSlide() {
    let prev = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(prev);
  }

  document.getElementById('nextBtn').addEventListener('click', () => {
    nextSlide();
    resetInterval();
  });

  document.getElementById('prevBtn').addEventListener('click', () => {
    prevSlide();
    resetInterval();
  });

  function resetInterval() {
    clearInterval(interval);
    interval = setInterval(nextSlide, intervalTime);
  }
</script>
</body>
</html>