@extends('layouts.layouts')
@section('title', 'UnggahProduk')

@section('content')
<div class="min-h-screen bg-[#f0f8ff] flex flex-col items-center justify-center px-4 py-10 relative">

    <!-- Modal Box -->
    <div class="bg-white w-full max-w-xl rounded-xl shadow-lg p-8 relative border border-gray-200">
        <!-- Header -->
        <div class="flex justify-between items-center border-b pb-3 mb-6">
            <h2 class="text-xl font-bold text-purple-800">Unggah Bibit</h2>
            <button onclick="window.history.back()" class="text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
        </div>

                {{-- **TAMBAHKAN DISINI** --}}
        @if ($errors->any())
          <div class="mb-4 p-3 bg-red-200 text-red-700 rounded">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        
        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Judul Bibit -->
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Judul Bibit<span class="text-red-600">*</span></label>
                <input type="text" name="judul" maxlength="120" placeholder="Masukkan judul produk anda, maksimal 120 karakter"
                    required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-purple-600" />
            </div>

            <!-- Deskripsi Bibit -->
            <div>
                <label class="block font-semibold text-gray-700 mb-1">Deskripsi Bibit<span class="text-red-600">*</span></label>
                <textarea name="deskripsi" maxlength="540" rows="4" placeholder="Masukkan deskripsi produk anda, maksimal 540 karakter"
                    required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-purple-600"></textarea>
            </div>

            <!-- Jumlah & Harga -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Jumlah Bibit<span class="text-red-600">*</span></label>
                    <input type="number" name="jumlah" min="1" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-purple-600" />
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Harga Bibit<span class="text-red-600">*</span></label>
                    <input type="text" name="harga" id="inputHarga" min="0" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-purple-600" />
                </div>
            </div>

            <!-- Upload Foto -->
            <div>
                <label for="file-upload" class="block text-sm font-medium text-gray-900">Cover photo</label>
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
                        <p class="text-xs text-gray-600">Seret dan lepas berkas anda disini</p>

                        <!-- Preview Gambar -->
                        <div class="mt-4">
                            <img id="image-preview" src="#" alt="Preview" class="hidden mx-auto max-h-48 rounded shadow">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol -->
            <div class="text-right">
                <button type="submit"
                    class="bg-purple-700 hover:bg-purple-800 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                    Unggah
                </button>
            </div>
        </form>
    </div>
</div>

<script>
  function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('image-preview');
    if (input.files && input.files[0]) {
      preview.src = URL.createObjectURL(input.files[0]);
      preview.classList.remove('hidden');
    } else {
      preview.src = '#';
      preview.classList.add('hidden');
    }
  }
</script>
@endsection
