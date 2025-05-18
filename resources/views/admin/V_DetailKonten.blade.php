@extends('layouts.layouts')
@section('title', 'DetailKonten')
@section('content')
  <!-- Konten -->
  <main class="max-w-3xl mx-auto bg-white mt-6 rounded-md shadow-lg">
    @php
      $fileKonten = 'storage/kontens/' . $fileKonten;
    @endphp

    <!-- Gambar -->
    <img src="{{ asset($fileKonten) }}" alt="Cover Konten" class="w-full h-auto object-cover border-4 border-purple-400 rounded-md" />

    <!-- Judul dan Isi -->
    <div class="px-6 py-4">
      <h1 class="text-2xl font-bold text-center mb-4">{{ $judul }}</h1>
      <div class="text-gray-800 space-y-4 text-justify">
        <p>{{ $deskripsiKonten }}</p>
      </div>

      <!-- Tanggal -->
      <p class="text-sm text-gray-500 mt-6 text-right">Diunggah pada: 04 Maret 2025, 14:15 WIB</p>

      <!-- Tombol Aksi -->
      @auth
        @if(Auth::user()->role === 'admin')
          <div class="flex justify-end space-x-4 mt-4">
            <!-- Edit -->
            <a href="{{ route('editKonten', ['id' => $id]) }}">
              <button class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-md" title="Edit">
                ✏️
              </button>
            </a>

            <!-- Delete -->
            <form id="delete-form" action="{{ route('konten.destroy', ['id' => $id]) }}" method="POST" class="inline">
              @csrf
              @method('DELETE')
              <button type="button" id="delete-btn" class="bg-red-500 hover:bg-red-600 text-white p-3 rounded-full shadow-md" title="Hapus">
                🗑️
              </button>
            </form>
          </div>
        @endif
      @endauth
    </div>
  </main>

  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Konfirmasi Delete -->
  <script>
    document.getElementById('delete-btn').addEventListener('click', function () {
      Swal.fire({
        icon: 'warning',
        title: 'Apakah anda yakin ingin menghapus konten?',
        showCancelButton: true,
        confirmButtonColor: '#4f46e5', // biru
        cancelButtonColor: '#ef4444', // merah
        confirmButtonText: 'YA',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('delete-form').submit();
        }
      });
    });
  </script>
@endsection
