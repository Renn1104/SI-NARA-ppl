@extends('layouts.layouts')
@section('title', 'Belanja')
@section('content')
  <!-- Judul -->
  <div class="px-6 py-4">
    <h1 class="text-lg font-semibold text-gray-700">Halaman Produk</h1>
  </div>

  <!-- Grid Produk -->
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4 px-6">
    <!-- Kartu produk -->
    <div class="bg-white p-3 rounded shadow">
      <img src="/images/anggur-hitam.jpg" alt="Anggur hitam" class="w-full h-32 object-cover rounded" />
      <p class="font-semibold mt-2">Anggur hitam K189</p>
      <p class="text-sm font-bold text-black">
        Rp.80.000 <span class="line-through text-gray-400 ml-1">120.000</span> <span class="text-xs text-red-600 font-bold">25%</span>
      </p>
      <p class="text-xs mt-1 text-gray-600">⭐ 4.8 · Terjual 100</p>
    </div>

    <!-- Duplikasikan div di atas untuk semua produk lainnya sesuai data di gambar -->

    <!-- Floating Action Button -->
    <button class="fixed bottom-6 right-6 bg-purple-600 text-white rounded-full p-4 text-2xl shadow-lg hover:bg-purple-700">
      +
    </button>
  </div>
@endsection