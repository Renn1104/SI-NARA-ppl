@extends('layouts.layouts')
@section('title', 'UbahKonten')

{{-- ==============  CONTENT  ============== --}}
@section('content')
<main class="flex justify-center items-center py-12 px-4">

  <div class="bg-white shadow-lg rounded-xl w-full max-w-xl p-6 relative">
    {{-- Tombol Close --}}
    <a href="{{ url()->previous() }}"
       class="absolute right-4 top-4 text-gray-500 hover:text-red-500 text-2xl leading-none">&times;</a>

    <h2 class="text-center text-xl font-bold text-purple-800 mb-6">Form Ubah Konten</h2>

    <form id="form-ubah-konten"
          action="{{ route('konten.update', $konten->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-5">
      @csrf @method('PUT')

      {{-- Judul --}}
      <div>
        <label class="block text-sm font-semibold">Judul Konten*</label>
        <input type="text" name="judul_konten"
               value="{{ old('judul_konten', $konten->judul_konten) }}"
               class="mt-1 w-full border border-gray-300 rounded p-2 focus:outline-purple-700" required>
      </div>

      {{-- Tanggal & Jam --}}
      <div class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
          <label class="block text-sm font-semibold">Tanggal*</label>
          <input type="date" name="tanggal"
                 value="{{ old('tanggal', \Carbon\Carbon::parse($konten->tanggal_unggah)->format('Y-m-d')) }}"
                 class="mt-1 w-full border border-gray-300 rounded p-2" required>
        </div>
        <div class="flex-1">
          <label class="block text-sm font-semibold">Jam*</label>
          <input type="time" name="jam"
                 value="{{ old('jam', \Carbon\Carbon::parse($konten->tanggal_unggah)->format('H:i')) }}"
                 class="mt-1 w-full border border-gray-300 rounded p-2" required>
        </div>
      </div>

      {{-- Deskripsi --}}
      <div>
        <label class="block text-sm font-semibold">Deskripsi Konten*</label>
        <textarea name="deskripsi_konten" rows="4"
                  class="mt-1 w-full border border-gray-300 rounded p-2 focus:outline-purple-700"
                  required>{{ old('deskripsi_konten', $konten->deskripsi_konten) }}</textarea>
      </div>

{{-- Cover --}}
<div>
  <label class="block text-sm font-medium text-gray-900 mb-2">Cover photo</label>
  <div>
    @if ($konten->file_konten)
      <p class="text-sm mb-2">File lama:</p>
      <img src="{{ asset('storage/kontens/' . $konten->file_konten) }}" alt="File Lama"
           class="rounded max-h-40 mb-4 object-contain">
    @endif

    <div class="flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 cursor-pointer hover:bg-gray-50 transition">
      <label for="file-upload" class="flex flex-col items-center cursor-pointer text-indigo-600 hover:text-indigo-500 select-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v8m0-8l-3 3m3-3l3 3M12 4v8" />
        </svg>
        <input id="file-upload" name="file_konten" type="file" class="sr-only" />
        <span class="font-semibold">Upload file baru</span>
        <p class="text-xs text-gray-600 mt-1">PNG, JPG, GIF up to 10MB</p>
      </label>
    </div>
  </div>
</div>


      {{-- Tombol Submit --}}
      <div class="text-center">
        <button type="button" id="btn-submit"
                class="bg-purple-800 text-white font-semibold px-6 py-2 rounded hover:bg-purple-900 transition">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>

  {{-- Modal Konfirmasi --}}
  <div id="confirmModal"
       class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-purple-800 text-white rounded-xl shadow-lg p-6 w-[90%] max-w-md text-center animate-fade-in">
      <div class="text-4xl text-yellow-300 mb-4">⚠️</div>
      <p class="text-lg font-semibold mb-6">Apakah anda yakin dengan perubahan yang dilakukan?</p>
      <div class="flex justify-center gap-4">
        <button id="confirmYes" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">YA</button>
        <button id="confirmNo"  class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded">Tidak</button>
      </div>
    </div>
  </div>
</main>

{{-- Toast sukses --}}
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
{{-- ==============  /CONTENT  ============== --}}

{{-- ==============  STYLES  ============== --}}
@push('styles')
<style>
@keyframes pop{0%{transform:scale(.8);opacity:0}60%{transform:scale(1.05);opacity:1}100%{transform:scale(1);opacity:1}}
.animate-pop{animation:pop .4s ease-out}
</style>
@endpush

{{-- ==============  SCRIPTS  ============== --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  /* Modal konfirmasi */
  const btnSubmit  = document.getElementById('btn-submit');
  const confirmMod = document.getElementById('confirmModal');
  const confirmYes = document.getElementById('confirmYes');
  const confirmNo  = document.getElementById('confirmNo');
  const form       = document.getElementById('form-ubah-konten');

  btnSubmit.addEventListener('click', () => confirmMod.classList.remove('hidden'));
  confirmNo .addEventListener('click', () => confirmMod.classList.add('hidden'));
  confirmYes.addEventListener('click', () => form.submit());

  /* Toast + auto‑redirect */
  const toast = document.getElementById('toast');
  if (toast) {
    // fade‑out setelah 2.5 dtk
    setTimeout(() => {
      toast.classList.add('transition','opacity-0');
      setTimeout(() => toast.remove(), 500);
    }, 2500);
    // redirect setelah 3 dtk
    setTimeout(() => {
      window.location.href = "{{ route('konten') }}";
    }, 3000);
  }
});
</script>
@endpush
