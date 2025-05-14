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
      'img' => asset('assets/Carousel 1.png'),
      'link' => 'https://www.youtube.com/watch?v=Z1I3R8FDwgM'
    ],
    [
      'img' => asset('assets/Carousel 2.png'),
      'link' => 'https://www.youtube.com/watch?v=ZX7UhT65ePY/'
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
          <img src="{{ asset('assets/logo.png') }}" alt="Icon Anggur" class="w-28 h-auto mb-4 animate-bounce" />
          <h2 class="text-3xl font-bold text-purple-800">Tentang Nara Garden</h2>
        </div>
        <p class="text-gray-700 text-justify text-base md:text-lg leading-relaxed">
          Didirikan pada tahun 2021, Nara Garden Jember hadir sebagai destinasi wisata agro yang mengusung konsep petik buah langsung dari kebun. Terletak di Jember, Jawa Timur, tempat ini menawarkan pengalaman unik bagi pengunjung untuk memetik buah anggur langsung dari pohonnya sambil menikmati suasana kebun yang asri, sejuk, dan menyegarkan.
          Sejak dibuka, Nara Garden telah menjadi tempat favorit keluarga untuk menghabiskan waktu bersama. Aktivitas petik anggur tidak hanya seru, tetapi juga edukatif—terutama bagi anak-anak yang ingin mengenal lebih dekat proses budidaya tanaman buah.
          <br><br>
          Selain area kebun, Nara Garden juga menyediakan fasilitas lengkap seperti area bermain anak, kafe dengan menu lokal, serta tempat bersantai yang cocok untuk berswafoto. Tempat ini ideal untuk dijadikan lokasi piknik keluarga, edutrip sekolah, foto prewedding, atau bahkan acara komunitas dan gathering.
          Dengan semangat memadukan wisata, edukasi, dan nuansa alam, Nara Garden terus berkembang menjadi salah satu ikon wisata agro terbaik di Jember.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- CSS Animasi Slide dari Kiri -->
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




<!-- Rekomendasi -->
<section class="px-4 md:px-6 py-10">
  <h2 class="text-center text-lg font-bold mb-7">REKOMENDASI</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
  @php
    $items = [
      ['img' => asset('assets/Konten1.png'), 'title' => 'Panen Anggur Hitam'],
      ['img' => asset('assets/Konten2.png'), 'title' => 'Tari Tradisional'],
      ['img' => asset('assets/Konten3.png'), 'title' => 'Tari Suwun'],
      ['img' => asset('assets/Konten4.png'), 'title' => 'Panen Anggur Hijau'],
      ['img' => asset('assets/Konten5.png'), 'title' => 'Tari Gandrung'],
      ['img' => asset('assets/Konten6.png'), 'title' => 'Hijau Lestari'],
    ];
    @endphp

      @foreach ($items as $item)
      <div class="bg-white shadow-md rounded-xl overflow-hidden transform transition hover:scale-105">
        <img src="{{ asset($item['img']) }}" alt="{{ $item['title'] }}" class="w-full h-48 object-cover">
        <p class="text-center py-2 font-semibold">{{ $item['title'] }}</p>
      </div>
    @endforeach
  </div>
</section>


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