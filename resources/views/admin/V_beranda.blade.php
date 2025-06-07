@extends('layouts.layouts')
@section('title','Landing')
@section('content')

  <!-- Carousel -->
  <section class="relative w-full h-64 sm:h-80 md:h-96 overflow-hidden" id="carousel">
  <!-- Slides -->
  <div class="carousel-slides w-full h-full relative">
  @php
  $slides = [
    [
      'img' => asset('assets/Cr1.png'),
      'link' => 'https://www.youtube.com/watch?v=Z1I3R8FDwgM'
    ],
    [
      'img' => asset('assets/Carousel 2.png'),
      'link' => 'https://www.youtube.com/watch?v=ZX7UhT65ePY/'
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

<!-- Section Tentang Nara Garden -->
<section class="px-4 md:px-6 py-16 bg-gray-50">
  <div class="max-w-6xl mx-auto">
    <div class="flex flex-col md:flex-row items-center md:items-start gap-8">

      <!-- Gambar dengan slide dari kiri & efek hover -->
      <div class="flex-shrink-0 w-full md:w-1/2 mt-6 md:mt-12 transform transition duration-700 ease-in-out animate-slide-in-left">
        <img
          src="{{ asset('assets/owner.jpg') }}"
          alt="Pemilik Nara Garden"
          class="w-full rounded-lg shadow-lg hover:scale-105 hover:shadow-2xl transition-transform duration-500"
        >
      </div>

      <!-- Konten teks -->
      <div class="w-full md:w-1/2">
        <div class="flex flex-col items-start mb-4">
          {{-- <img src="{{ asset('assets/logo.png') }}" alt="Icon Anggur" class="w-28 h-auto mb-4 animate-bounce" /> --}}
          <h2 class="text-3xl font-bold text-purple-800">Tentang Nara Garden</h2>
        </div>
        <p class="text-gray-700 text-justify text-base md:text-lg leading-relaxed">
          Didirikan pada tahun 2021, Nara Garden Jember hadir sebagai destinasi wisata agro yang mengusung konsep petik buah langsung dari kebun. Terletak di Jember, Jawa Timur, tempat ini menawarkan pengalaman unik bagi pengunjung untuk memetik buah anggur langsung dari pohonnya sambil menikmati suasana kebun yang asri, sejuk, dan menyegarkan.
          Sejak dibuka, Nara Garden telah menjadi tempat favorit keluarga untuk menghabiskan waktu bersama. Aktivitas petik anggur tidak hanya seru, tetapi juga edukatif terutama bagi anak-anak yang ingin mengenal lebih dekat proses budidaya tanaman buah.
        </p>
      </div>
    </div>
  </div>
</section>

<style>
  @keyframes slideInLeft {
    0% {
      opacity: 0;
      transform: translateX(-50px);
    }
    100% {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .animate-slide-in-left {
    animation: slideInLeft 2s ease-out forwards;
  }
</style>


<section class="py-12 px-4 md:px-8 bg-white text-center animate-fade-in-up">
<h2 class="text-2xl md:text-3xl font-bold mb-12 text-purple-800">
  Fitur Utama dari
  <img
    src="{{ asset('assets/logo.png') }}"
    alt="Logo Nara"
    class="w-35 h-20 inline-block align-middle ml-2 animate-bounce"
  />
</h2>


  <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto">
    <!-- KONTEN -->
    <div class="flex flex-col items-center p-6 bg-white rounded-xl shadow-md outline outline-purple-500 transition-transform duration-300 hover:scale-105 hover:shadow-xl">
      <img src="{{ asset('assets/content.png') }}" alt="KONTEN" class="w-16 h-16 mb-4 outline outline-purple-500 rounded-full p-2">
      <h3 class="text-xl font-bold mb-2">KONTEN</h3>
      <p class="text-gray-600 max-w-xs">
        Kami menyediakan konten seputar kegiatan apa saja yang dilakukan oleh SI-NARA
      </p>
    </div>

    <!-- KALENDER EVENT -->
    <div class="flex flex-col items-center p-6 bg-white rounded-xl shadow-md outline outline-purple-500 transition-transform duration-300 hover:scale-105 hover:shadow-xl">
      <img src="{{ asset('assets/schedule.png') }}" alt="KALENDER EVENT" class="w-16 h-16 mb-4 outline outline-purple-500 rounded-full p-2">
      <h3 class="text-xl font-bold mb-2">KALENDER EVENT</h3>
      <p class="text-gray-600 max-w-xs">
        Dengan kalender event ini jadwal acara SI-NARA lebih teratur
      </p>
    </div>

    <!-- BELANJA -->
    <div class="flex flex-col items-center p-6 bg-white rounded-xl shadow-md outline outline-purple-500 transition-transform duration-300 hover:scale-105 hover:shadow-xl">
      <img src="{{ asset('assets/shopping-bag.png') }}" alt="BELANJA" class="w-16 h-16 mb-4 outline outline-purple-500 rounded-full p-2">
      <h3 class="text-xl font-bold mb-2">BELANJA</h3>
      <p class="text-gray-600 max-w-xs">
        Kami siap membantu Anda menemukan bibit Anggur yang cocok untuk budidaya.
      </p>
    </div>
  </div>
</section>

<!-- Tambahkan CSS Animasi Fade In Up -->
<style>
  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(30px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fade-in-up {
    animation: fadeInUp 1s ease-out forwards;
  }
</style>



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
@endsection
