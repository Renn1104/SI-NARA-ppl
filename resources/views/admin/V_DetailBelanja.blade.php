@extends('layouts.layouts')
@section('title', 'DetailBelanja')
@section('content')

<!-- Produk -->
  <main class="max-w-4xl mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg p-6">
      <div class="flex flex-col md:flex-row gap-6">
        <img src="https://bibitonline.com/wp-content/uploads/2021/12/anggur-trans.webp" alt="Bibit Anggur Trans" class="w-full md:w-1/2 rounded">
        <div class="flex-1 space-y-3">
          <h2 class="text-2xl font-semibold">Bibit Anggur Trans</h2>
          <p class="text-purple-600 text-2xl font-bold">Rp50.000 
            <span class="text-gray-400 text-base line-through ml-2">Rp100.000</span>
            <span class="text-sm bg-red-200 text-red-600 px-2 py-0.5 rounded-full text-xs">50%</span>
          </p>
          <p class="text-sm text-gray-500">Stok 300</p>
          <div class="flex items-center gap-2 mt-4">
            <span>Jumlah</span>
            <button class="px-2 py-1 border border-gray-300 rounded">-</button>
            <span>1</span>
            <button class="px-2 py-1 border border-gray-300 rounded">+</button>
          </div>
          <button class="mt-4 bg-purple-500 text-white px-6 py-2 rounded hover:bg-purple-600">
            Beli Sekarang
          </button>
        </div>
      </div>

      <!-- Deskripsi -->
      <div class="mt-8">
        <h3 class="text-lg font-semibold mb-2">Deskripsi</h3>
        <p class="mb-4">Bibit Anggur Trans – Tumbuh Subur &amp; Cepat Berbuah!<br>
        Ingin menanam anggur sendiri di rumah? Bibit Anggur Trans adalah pilihan terbaik untuk Anda yang menginginkan tanaman anggur berkualitas dengan hasil buah melimpah dan rasa yang manis!</p>

        <h4 class="font-semibold mt-4 mb-2">🍀 Keunggulan Produk:</h4>
        <ul class="list-disc list-inside space-y-1">
          <li>✅ Cepat Berbuah – Mulai berbuah dalam waktu 1–1,5 tahun dengan perawatan optimal.</li>
          <li>✅ Rasa Buah Manis &amp; Segar – Cocok untuk dikonsumsi langsung atau dijadikan jus dan selai.</li>
          <li>✅ Tahan Terhadap Hama – Bibit unggul yang lebih kuat menghadapi serangan penyakit.</li>
          <li>✅ Cocok untuk Iklim Tropis – Bisa ditanam di pekarangan rumah, pot besar, atau kebun.</li>
        </ul>

        <h4 class="font-semibold mt-4 mb-2">🐒 Spesifikasi Bibit:</h4>
        <ul class="list-disc list-inside space-y-1">
          <li>Tinggi bibit: ± 40–60 cm</li>
          <li>Usia: 3–6 bulan</li>
          <li>Media tanam: Polybag siap tanam</li>
          <li>Jenis: Anggur Trans (unggulan lokal)</li>
          <li>Kemasan: Aman dan rapi, menjaga bibit tetap segar sampai tujuan</li>
        </ul>

        <h4 class="font-semibold mt-4 mb-2">💡 Tips Perawatan:</h4>
        <ul class="list-disc list-inside space-y-1">
          <li>Letakkan di tempat yang cukup sinar matahari (minimal 6 jam/hari)</li>
          <li>Siram secara teratur, jangan terlalu basah</li>
          <li>Beri pupuk organik setiap 2 minggu sekali</li>
        </ul>

        <p class="mt-4">🌱 Cocok untuk pemula maupun pecinta tanaman buah. Mulai tanam hari ini, panen manisnya nanti!</p>
      </div>
    </div>
  </main>
@endsection