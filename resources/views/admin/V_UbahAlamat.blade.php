@extends('layouts.layouts')
@section('title', 'UbahAlamat')
@section('content')

@php
  $provinsiJawa = ['Banten', 'DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur'];
@endphp

<main class="flex justify-center items-center py-10">
  <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-xl border relative">
    <h2 class="text-lg font-semibold mb-4 border-b-2 border-purple-200 px-4 text-center w-full">
        Ubah Alamat
    </h2>
    <button onclick="history.back()" class="absolute top-4 right-4 text-gray-500 hover:text-black">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
           viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>

    <!-- Form -->
    <form id="form-ubah-alamat" action="{{ route('alamat.update') }}" method="POST" class="space-y-4 mt-2">
      @csrf
      @method('PUT')

      <div>
        <label class="block text-sm font-medium mb-1">Alamat</label>
        <textarea name="alamat" required class="w-full border border-gray-300 rounded px-3 py-2 resize-none focus:outline-none focus:ring focus:ring-purple-300" rows="2">{{ old('alamat', $user->alamat) }}</textarea>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Provinsi</label>
        <select name="provinsi" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-purple-300">
          <option value="">-- Pilih Provinsi --</option>
          @foreach ($provinsiJawa as $prov)
            <option value="{{ $prov }}" {{ old('provinsi', $user->provinsi) === $prov ? 'selected' : '' }}>
              {{ $prov }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Kabupaten/Kota</label>
        <input type="text" name="kabupatenkota" required value="{{ old('kabupatenkota', $user->kabupatenkota) }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-purple-300" placeholder="Masukkan kabupaten/kota">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Kecamatan</label>
        <input type="text" name="kecamatan" required value="{{ old('kecamatan', $user->kecamatan) }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-purple-300" placeholder="Masukkan kecamatan">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Kode Pos</label>
        <input type="text" name="kodepos" required value="{{ old('kodepos', $user->kodepos) }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-purple-300" placeholder="Masukkan kode pos">
      </div>

      <button type="submit" id="btn-submit" class="w-full bg-purple-800 hover:bg-purple-700 text-white py-2 rounded">
        Ganti Alamat
      </button>
    </form>
  </div>
</main>

<!-- Optional: JS untuk validasi alert sebelum submit -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('form-ubah-alamat');
  const submitBtn = document.getElementById('btn-submit');

  submitBtn.addEventListener('click', (e) => {
    if (!form.checkValidity()) {
      e.preventDefault();
      form.reportValidity(); // akan menampilkan alert bawaan browser seperti: "Harap isi bidang ini"
    }
  });
});
</script>

@endsection
