@extends('layouts.layouts')
@section('title', 'ProfilPelanggan')
@section('content')
{{-- ==============  CONTENT  ============== --}}

<!-- Konten Profil Pelanggan -->
  <main class="max-w-2xl mx-auto my-10 p-6 bg-white rounded-xl shadow-md">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-xl font-semibold text-center text-purple-800 w-full">Profil Pelanggan</h2>
      <button class="text-xl text-gray-400 hover:text-red-500">&times;</button>
    </div>

<div class="space-y-4">
  <div class="border rounded p-2">
    <a href="{{ route('admin.detailPelanggan', ['username' => 'dina14']) }}" class="block font-medium text-purple-700 hover:underline">
      Dina14
    </a>
  </div>
  <div class="border rounded p-2">
    <a href="{{ route('admin.detailPelanggan', ['username' => 'tantri234']) }}" class="block font-medium text-purple-700 hover:underline">
      Tantri234
    </a>
  </div>
  <div class="border rounded p-2">
    <a href="{{ route('admin.detailPelanggan', ['username' => 'irvan78']) }}" class="block font-medium text-purple-700 hover:underline">
      Irvan78
    </a>
  </div>
  <div class="border rounded p-2">
    <a href="{{ route('admin.detailPelanggan', ['username' => 'rendy77']) }}" class="block font-medium text-purple-700 hover:underline">
      Rendy77
    </a>
  </div>
  <div class="border rounded p-2">
    <a href="{{ route('admin.detailPelanggan', ['username' => 'reymbayang90']) }}" class="block font-medium text-purple-700 hover:underline">
      Reymbayang90
    </a>
  </div>
  <div class="border rounded p-2">
    <a href="{{ route('admin.detailPelanggan', ['username' => 'junjihun33']) }}" class="block font-medium text-purple-700 hover:underline">
      Junjihun33
    </a>
  </div>
  <div class="border rounded p-2">
    <a href="{{ route('admin.detailPelanggan', ['username' => 'ojan09']) }}" class="block font-medium text-purple-700 hover:underline">
      Ojan09
    </a>
  </div>
  <div class="border rounded p-2">
    <a href="{{ route('admin.detailPelanggan', ['username' => 'uan77']) }}" class="block font-medium text-purple-700 hover:underline">
      Uan77
    </a>
  </div>
</div>

  </main>
  @endsection
