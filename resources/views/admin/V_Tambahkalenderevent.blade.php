@extends('layouts.layouts')
@section('title', 'Tambahkalenderevent')
@section('content')
  <!-- Form Section -->
  <main class="flex justify-center items-center py-12 px-4">
    <div class="bg-white shadow-lg rounded-xl w-full max-w-xl p-6 relative">

      <!-- Tombol Close -->
      <button class="absolute right-4 top-4 text-gray-500 hover:text-red-500 text-2xl leading-none">&times;</button>

      <h2 class="text-center text-xl font-bold text-purple-800 mb-6">Form Tambah Kalender Event</h2>

      <!-- FORM MULAI -->
      <form action="{{ route('kalenderevent') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- Judul Event -->
        <div>
          <label class="block text-sm font-semibold">Judul Event*</label>
          <input type="text" name="judul_konten" placeholder="Masukkan judul event anda, maksimal 120 karakter"
            class="mt-1 w-full border border-gray-300 rounded p-2 focus:outline-purple-700" required>
        </div>

        <!-- Tanggal dan Jam -->
        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1">
            <label class="block text-sm font-semibold">Tanggal*</label>
            <input type="date" name="tanggal" class="mt-1 w-full border border-gray-300 rounded p-2" required>
          </div>
          <div class="flex-1">
            <label class="block text-sm font-semibold">Jam*</label>
            <input type="time" name="jam" class="mt-1 w-full border border-gray-300 rounded p-2" required>
          </div>
        </div>

        <!-- Deskripsi Event -->
        <div>
          <label class="block text-sm font-semibold">Deskripsi Event*</label>
          <textarea name="deskripsi_konten" rows="4" placeholder="Masukkan deskripsi event"
            class="mt-1 w-full border border-gray-300 rounded p-2 focus:outline-purple-700" required></textarea>
        </div>

        <!-- Poster Event -->
        <div>
          <label for="cover-photo" class="block text-sm font-medium text-gray-900">Poster Event*</label>
          <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
            <div class="text-center">
              <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
              </svg>
              <div class="mt-4 flex text-sm text-gray-600 justify-center">
                <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500">
                  <span>Upload a file</span>
                  <input id="file-upload" name="file_konten" type="file" class="sr-only" onchange="previewImage(event)">
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs text-gray-600">PNG, JPG, GIF up to 10MB</p>

              <!-- Preview Gambar -->
              <div class="mt-4">
                <img id="image-preview" src="#" alt="Preview" class="hidden mx-auto max-h-48 rounded shadow">
              </div>
            </div>
          </div>
        </div>

        <!-- Tombol Submit -->
        <div class="text-center">
          <button type="submit" class="bg-purple-800 text-white font-semibold px-6 py-2 rounded hover:bg-purple-900 transition">
            Unggah
          </button>
        </div>
      </form>
      <!-- FORM SELESAI -->

    </div>
  </main>

  <!-- Script untuk preview gambar -->
  <script>
    function previewImage(event) {
      const input = event.target;
      const preview = document.getElementById('image-preview');

      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
@endsection
