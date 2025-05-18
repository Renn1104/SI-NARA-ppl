@extends('layouts.layouts')
@section('title', 'UbahKonten')

@section('content')
<main class="flex justify-center items-center py-12 px-4">
  <div class="bg-white shadow-lg rounded-xl w-full max-w-xl p-6 relative">

    <!-- Tombol Close -->
    <a href="{{ url()->previous() }}" class="absolute right-4 top-4 text-gray-500 hover:text-red-500 text-2xl leading-none">&times;</a>

    <h2 class="text-center text-xl font-bold text-purple-800 mb-6">Form Ubah Konten</h2>

    <form action="{{ route('konten.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5" id="form-ubah-konten">
      @csrf
      @method('PUT')

      <!-- Judul Konten -->
      <div>
        <label class="block text-sm font-semibold">Judul Konten*</label>
        <input type="text"
              name="judul_konten"
              value="{{ old('judul_konten', $event->judul_event) }}"
              class="mt-1 w-full border border-gray-300 rounded p-2 focus:outline-purple-700"
              required>
      </div>

      <!-- Tanggal dan Jam -->
        <div class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <label class="block text-sm font-semibold">Tanggal*</label>
            <input type="date"
                name="tanggal"
                value="{{ old('tanggal', $event->tanggal_event ? \Carbon\Carbon::parse($event->tanggal_event)->format('Y-m-d') : '') }}"
                class="mt-1 w-full border border-gray-300 rounded p-2"
                required>
        </div>
        <div class="flex-1">
            <label class="block text-sm font-semibold">Jam*</label>
            <input type="time"
                name="jam"
                value="{{ old('jam', $event->waktu_event) }}"
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
                  required>{{ old('deskripsi_konten', $event->deskripsi_event) }}</textarea>
      </div>

      <!-- Cover Photo -->
      <div>
        <label for="cover-photo" class="block text-sm font-medium text-gray-900">Cover photo</label>
        <div class="mt-2">
          @if($event->file_event)
            <div class="mb-4">
              <p class="text-sm">File lama:</p>
              <img src="{{ asset('storage/' . $event->file_event) }}" alt="File Lama" class="rounded max-h-40">
            </div>
          @endif

          <div class="flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
            <div class="text-center">
              <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500">
                <span>Upload file baru</span>
                <input id="file-upload" name="file_konten" type="file" class="sr-only">
              </label>
              <p class="text-xs text-gray-600 mt-2">PNG, JPG, GIF up to 10MB</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Tombol Submit -->
      <div class="text-center">
        <button type="button" id="btn-submit"
                class="bg-purple-800 text-white font-semibold px-6 py-2 rounded hover:bg-purple-900 transition">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>

  <!-- Modal Konfirmasi -->
  <div id="confirmModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-purple-800 text-white rounded-xl shadow-lg p-6 w-[90%] max-w-md text-center relative animate-fade-in">
      <div class="text-4xl text-yellow-300 mb-4">⚠️</div>
      <p class="text-lg font-semibold mb-6">Apakah anda yakin dengan perubahan yang dilakukan ?</p>
      <div class="flex justify-center gap-4">
        <button id="confirmYes" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">YA</button>
        <button id="confirmNo" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">Tidak</button>
      </div>
    </div>
  </div>
</main>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btnSubmit = document.getElementById('btn-submit');
    const confirmModal = document.getElementById('confirmModal');
    const confirmYes = document.getElementById('confirmYes');
    const confirmNo = document.getElementById('confirmNo');
    const form = document.getElementById('form-ubah-konten');

    btnSubmit.addEventListener('click', () => {
      confirmModal.classList.remove('hidden');
    });

    confirmNo.addEventListener('click', () => {
      confirmModal.classList.add('hidden');
    });

    confirmYes.addEventListener('click', () => {
      form.submit();
    });
  });
</script>
@endpush
