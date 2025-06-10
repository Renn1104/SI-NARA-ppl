@extends('layouts.layouts')
@section('title', 'UbahBelanja')
@section('content')

<div class="min-h-screen bg-[#f0f8ff] flex flex-col items-center justify-center px-4 py-10 relative">

    <div class="bg-white w-full max-w-xl rounded-xl shadow-lg p-8 relative border border-gray-200">
        <div class="flex justify-between items-center border-b pb-3 mb-6">
            <h2 class="text-xl font-bold text-purple-800">Ubah Bibit</h2>
            <button onclick="window.history.back()" class="text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
        </div>

        @if ($errors->any())
        <div class="mb-4 p-3 bg-red-200 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="form-update" action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Judul Bibit<span class="text-red-600">*</span></label>
                <input type="text" name="judul" maxlength="120"
                    value="{{ old('judul', $produk->judul_bibit) }}"
                    placeholder="Masukkan judul produk anda, maksimal 120 karakter"
                    required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-purple-600" />
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Deskripsi Bibit<span class="text-red-600">*</span></label>
                <textarea name="deskripsi" maxlength="540" rows="4"
                    placeholder="Masukkan deskripsi produk anda, maksimal 540 karakter"
                    required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-purple-600">{{ old('deskripsi', $produk->deskripsi_bibit) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Jumlah Bibit<span class="text-red-600">*</span></label>
                    <input type="number" name="jumlah" min="1"
                        value="{{ old('jumlah', $produk->jumlah_bibit) }}"
                        required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-purple-600" />
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Harga Bibit<span class="text-red-600">*</span></label>
                    <input type="text" name="harga" id="inputHarga" min="0"
                        value="{{ old('harga', $produk->harga_bibit) }}"
                        required class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-purple-600" />
                </div>
            </div>

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

                        <div class="mt-4">
                            @if ($produk->foto_bibit)
                                <img id="image-preview" src="{{ asset('storage/' . $produk->foto_bibit) }}" alt="Foto Lama" class="mx-auto max-h-48 rounded shadow">
                            @else
                                <img id="image-preview" src="#" alt="Preview" class="hidden mx-auto max-h-48 rounded shadow">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

      <div class="text-center">
        <button id="btn-submit" type="button"
                class="bg-purple-800 text-white font-semibold px-6 py-2 rounded hover:bg-purple-900 transition">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</main>

<div id="confirmModal"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-purple-800 text-white rounded-xl shadow-lg p-6 w-[90%] max-w-md text-center relative animate-fade-in">
    <div class="text-4xl text-yellow-300 mb-4">⚠️</div>
    <p class="text-lg font-semibold mb-6">Apakah anda yakin dengan perubahan yang dilakukan?</p>
    <div class="flex justify-center gap-4">
      <button id="confirmYes" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">YA</button>
      <button id="confirmNo"  class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">Tidak</button>
    </div>
  </div>
</div>

@if (session('success'))
  <div id="toast" class="fixed inset-0 flex items-start justify-center mt-20 z-50">
    <div class="bg-purple-800 text-white px-8 py-6 rounded-xl shadow-lg flex items-center gap-4 animate-pop">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-lime-400" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414l-8.25 8.25a1 1 0 01-1.414 0l-3.25-3.25a1 1 0 011.414-1.414L8 12.586l7.543-7.543a1 1 0 011.414 0z"
              clip-rule="evenodd"/>
      </svg>
      <span class="font-semibold text-lg">{{ session('success') }}</span>
    </div>
  </div>
@endif
@endsection

    @push('styles')
    <style>
    @keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
    animation: fade-in 0.3s ease-out;
    }
    .toast-fade {
    transition: opacity 0.5s ease-out;
    }
    </style>
    @endpush


@push('scripts')
    <script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const oldImageContainer = document.getElementById('old-image-container');

        if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (oldImageContainer) oldImageContainer.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const submitBtn  = document.getElementById('btn-submit');
        const form       = document.getElementById('form-update');
        const modal      = document.getElementById('confirmModal');
        const confirmYes = document.getElementById('confirmYes');
        const confirmNo  = document.getElementById('confirmNo');

        submitBtn.addEventListener('click', () => {
        if (form.checkValidity()) {
            modal.classList.remove('hidden');
        } else {
            form.reportValidity();
        }
        });

        confirmYes.addEventListener('click', () => {
        modal.classList.add('hidden');
        form.submit();
        });

        confirmNo.addEventListener('click', () => modal.classList.add('hidden'));

        // Toast success auto-hide
        const toast = document.getElementById('toast-success');
        if (toast) {
        setTimeout(() => toast.classList.add('opacity-0'), 2500);
        setTimeout(() => {
            toast.remove();
            window.location.href = "{{ route('kalenderevent') }}";
        }, 3000);
        }
    });
    </script>
@endpush


