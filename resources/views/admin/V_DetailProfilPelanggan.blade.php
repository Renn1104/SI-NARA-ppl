@extends('layouts.layouts')
@section('title', 'DetailProfilPelanggan')

@section('content')
  <main class="flex justify-center items-center p-6">
    <div class="bg-white shadow-lg rounded-md w-full max-w-xl p-6 relative">
      <h2 class="text-center text-lg font-semibold text-purple-700 border-b pb-2 mb-4">Profil</h2>
      <button class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-xl">&times;</button>
      <form class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input type="text" value="{{ $pelanggan->namalengkap }}" class="w-full border rounded p-2 text-gray-500 bg-gray-100" disabled />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Username</label>
          <input type="text" value="{{ $pelanggan->username }}" class="w-full border rounded p-2 text-gray-500 bg-gray-100" disabled />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Nomor Telpon</label>
          <input type="text" value="{{ $pelanggan->phone }}" class="w-full border rounded p-2 text-gray-500 bg-gray-100" disabled />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" value="{{ $pelanggan->email }}" class="w-full border rounded p-2 text-gray-500 bg-gray-100" disabled />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Alamat</label>
          <input type="text" value="{{ $pelanggan->alamat }}" class="w-full border rounded p-2 text-gray-500 bg-gray-100" disabled />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
          <input type="text" value="{{ $pelanggan->kecamatan }}" class="w-full border rounded p-2 text-gray-500 bg-gray-100" disabled />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
          <input type="text" value="{{ $pelanggan->kabupatenkota }}" class="w-full border rounded p-2 text-gray-500 bg-gray-100" disabled />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Provinsi</label>
          <input type="text" value="{{ $pelanggan->provinsi }}" class="w-full border rounded p-2 text-gray-500 bg-gray-100" disabled />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Kode Pos</label>
          <input type="text" value="{{ $pelanggan->kodepos }}" class="w-full border rounded p-2 text-gray-500 bg-gray-100" disabled />
        </div>
      </form>
    </div>
  </main>
@endsection
