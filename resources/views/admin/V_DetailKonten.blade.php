@extends('layouts.layouts')
@section('title', 'DetailKonten')
@section('content')
  <!-- Konten -->
  <main class="max-w-3xl mx-auto bg-white mt-6 rounded-md shadow-lg">
    @php
    $fileKonten ='kontens/'.$fileKonten;
    @endphp
    <!-- Gambar -->
    <img src="{{asset($fileKonten)}}" alt="Anggur Hitam" class="w-full h-auto object-cover border-4 border-blue-300 rounded-md" />
    <!-- Judul dan Isi -->
    <div class="px-6 py-4">
      <h1 class="text-2xl font-bold text-center mb-4">{{$judul}}</h1>
      <div class="text-gray-800 space-y-4 text-justify">
        <p>{{$deskripsiKonten}}</p>
      </div>

      <!-- Tanggal -->
      <p class="text-sm text-gray-500 mt-6 text-right">Diunggah pada: 04 Maret 2025, 14:15 WIB</p>

      <!-- Tombol Aksi -->
      <div class="flex justify-end space-x-4 mt-4">
          <a href="{{ route('editKonten', ['id'=>$id]) }}">
        <button class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-md" title="Edit">
             ✏️ 
            </button>
        </a>
        <button class="bg-red-500 hover:bg-red-600 text-white p-3 rounded-full shadow-md" title="Hapus">
          🗑️
        </button>
      </div>
    </div>

@endsection