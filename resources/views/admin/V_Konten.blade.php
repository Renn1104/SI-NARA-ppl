@extends('layouts.layouts')
@section('title', 'Konten')
@section('content')
      <!-- Tombol Tambah Event -->
    @php
    // Cek session role, jika null beri default 'guest'
    $role = session('user', 'guest');
    $role  =$role['role']
@endphp
@if($role == 'admin')
    <div class="flex justify-end mt-6 px-6">
        <a href="{{ route('konten.create') }}"
           class="flex items-center space-x-2 bg-purple-800 text-white px-4 py-2 rounded-full shadow hover:bg-purple-700 transition">
            <span class="text-sm md:text-base font-medium">Tambah Konten</span>
            <span class="text-lg">＋</span>
        </a>
    </div>
@endif


  <!-- Rekomendasi -->
<section class="px-4 md:px-6 py-10">
  <h2 class="text-center text-lg font-bold mb-7">KONTEN SI-NARA</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
  
      @foreach ($data as $datum)
      @php
        $img = $datum['file_konten'];
        $image = 'kontens/'.$img;
        $judul = $datum['judul_konten'];
        $deskripsi = $datum['deskripsi_konten'];
        $fileKonten = $datum['file_konten'];
        $id = $datum['id'];
      @endphp
      <a href="{{route('detailkonten',['judul'=>$judul,'deskripsiKonten'=>$deskripsi, 'fileKonten'=>$fileKonten,'id'=>$id])}}" >
        <div class="bg-white shadow-md rounded-xl overflow-hidden transform transition hover:scale-105">
          <img src="{{ asset($image) }}" alt="ggal" class="w-full h-48 object-cover">
          <p class="text-center py-2 font-semibold">{{ $datum['judul_konten'] }}</p>
        </div>
      </a>
    @endforeach

  </div>
</section>
@endsection