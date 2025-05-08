@extends('layouts.layouts')
@section('title','Beranda')
@section('content')
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