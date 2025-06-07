@extends('layouts.layouts')
@section('title', 'DetailKonten')

@php
  \Carbon\Carbon::setLocale('id');
@endphp

@section('content')
<main class="max-w-3xl mx-auto bg-white mt-6 rounded-md shadow-lg">

  <img src="{{ asset('storage/kontens/'.$fileKonten) }}"
       alt="Cover Konten"
       class="w-full h-auto object-cover border-4 border-purple-400 rounded-md"/>

  <div class="px-6 py-4">
    <h1 class="text-2xl font-bold text-center mb-4">{{ $judul }}</h1>
    <div class="text-gray-800 space-y-4 text-justify">
      <p>{{ $deskripsiKonten }}</p>
    </div>

    {{-- <p class="text-sm text-gray-500 mt-6 text-right">
        Diunggah pada: {{ \Carbon\Carbon::parse($tanggalUnggah)->translatedFormat('d F Y, H:i') }} WIB
    </p> --}}

    @auth
      @if(Auth::user()->role === 'admin')
        <div class="flex justify-end space-x-4 mt-4">
          <a href="{{ route('editKonten', $id) }}"
             class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-full shadow-md"
             title="Edit">✏️</a>

          <form id="delete-form"
                action="{{ route('konten.destroy', $id) }}"
                method="POST" class="inline">
            @csrf @method('DELETE')
            <button type="button" id="delete-btn"
                    class="bg-red-500 hover:bg-red-600 text-white p-3 rounded-full shadow-md"
                    title="Hapus">🗑️</button>
          </form>
        </div>
      @endif
    @endauth
  </div>
</main>

@if (session('success'))
  <div id="toast-success"
       class="fixed inset-0 flex items-start justify-center mt-20 z-50">
    <div class="bg-purple-800 text-white px-8 py-6 rounded-xl shadow-lg flex items-center gap-4 animate-pop">
      {{-- ikon cek --}}
      <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-lime-400"
           viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414L8.457 14.95a1 1 0 01-1.414 0l-3.25-3.25a1 1 0 111.414-1.414L8 12.536l7.293-7.293a1 1 0 011.414 0z"
              clip-rule="evenodd"/>
      </svg>
      <span class="font-semibold text-lg">{{ session('success') }}</span>
    </div>
  </div>
@endif
@endsection

@push('styles')
<style>
@keyframes pop{0%{transform:scale(.8);opacity:0}60%{transform:scale(1.05);opacity:1}100%{transform:scale(1);opacity:1}}
.animate-pop{animation:pop .4s ease-out}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('delete-btn')?.addEventListener('click', () => {
    Swal.fire({
      icon: 'warning',
      title: 'Apakah anda yakin ingin menghapus konten?',
      showCancelButton: true,
      confirmButtonColor: '#4f46e5',
      cancelButtonColor: '#ef4444',
      confirmButtonText: 'YA',
      cancelButtonText: 'Tidak'
    }).then(result => {
      if (result.isConfirmed) document.getElementById('delete-form').submit();
    });
  });

  const toast = document.getElementById('toast-success');
  if (toast){
    setTimeout(()=>{
      toast.classList.add('transition','opacity-0');
      setTimeout(()=>toast.remove(),500);
    },2500);
  }
});
</script>
@endpush
