@extends('layouts.layouts')
@section('title', 'UbahKonten')
@section('content')
<main class="flex justify-center items-center py-12 px-4">
  <div class="bg-white shadow-lg rounded-xl w-full max-w-xl p-6 relative">

    <!-- Tombol Close -->
    <a href="{{ url()->previous() }}" class="absolute right-4 top-4 text-gray-500 hover:text-red-500 text-2xl leading-none">&times;</a>

    <h2 class="text-center text-xl font-bold text-purple-800 mb-6">Form Ubah Konten</h2>

    <form action="{{ route('konten.update', $id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
      @csrf
      @method('PUT')
    @php
    $judul =$judul;
    @endphp
      <!-- Judul Konten -->
      <div>
        <label class="block text-sm font-semibold">Judul Konten*</label>
        <input type="text"
               name="judul_konten"
               value="{{$judul}}"
               class="mt-1 w-full border border-gray-300 rounded p-2 focus:outline-purple-700"
               required>
      </div>

      <!-- Tanggal dan Jam -->
      <div class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
          <label class="block text-sm font-semibold">Tanggal*</label>
          <input type="date"
                 name="tanggal"
                 value="{{ old('tanggal', $tanggal ?? '') }}"
                 class="mt-1 w-full border border-gray-300 rounded p-2"
                 required>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-semibold">Jam*</label>
          <input type="time"
                 name="jam"
                 value="{{ old('jam', $jam ?? '') }}"
                 class="mt-1 w-full border border-gray-300 rounded p-2"
                 required>
        </div>
      </div>

      <!-- Deskripsi Konten -->
      <div>
        <label class="block text-sm font-semibold">Deskripsi Konten*</label>
        <textarea name="deskripsi_konten"
                  rows="4"
                  class="mt-1 w-full border border-gray-300 rounded p-2 focus:outline-purple-700"
                  placeholder="{{ old('deskripsi_konten') ? '' : $deskripsiKonten }}"
                  required>{{ old('deskripsi_konten', $deskripsiKonten) }}</textarea>
      </div>

      <!-- Cover Photo -->
      <div>
        <label for="cover-photo" class="block text-sm font-medium text-gray-900">Cover photo</label>
        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
          <div class="text-center">
            @if($fileKonten)
              <p class="text-sm mb-2">File lama: <strong>{{ $fileKonten }}</strong></p>
            @endif
            <label for="file-upload"
              class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500">
              <span>Upload file baru</span>
              <input id="file-upload" name="file_konten" type="file" class="sr-only">
            </label>
            <p class="text-xs text-gray-600 mt-2">PNG, JPG, GIF up to 10MB</p>
          </div>
        </div>
      </div>

      <!-- Tombol Submit -->
      <div class="text-center">
        <button type="submit"
                class="bg-purple-800 text-white font-semibold px-6 py-2 rounded hover:bg-purple-900 transition">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</main>
@endsection
