@extends('layouts.layouts')
@section('title', 'ProfilPelanggan')
@section('content')

<main class="max-w-2xl mx-auto my-10 p-6 bg-white rounded-xl shadow-md">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-center text-purple-800 w-full">Profil Pelanggan</h2>
    <button class="text-xl text-gray-400 hover:text-red-500">&times;</button>
  </div>

  <div class="space-y-4">
    @foreach($pelanggans as $pelanggan)
      <div class="border rounded p-2">
        <a href="{{ route('admin.detailPelanggan', ['username' => $pelanggan->username]) }}"
           class="block font-medium text-purple-700 hover:underline">
          {{ $pelanggan->username }}
        </a>
      </div>
    @endforeach
  </div>

</main>

@endsection
