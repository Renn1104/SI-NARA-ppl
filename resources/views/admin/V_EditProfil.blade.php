@extends('layouts.layouts')
@section('title', 'EditProfil')

@section('content')
{{-- {{ dd($user) }} --}}
<div class="flex justify-center items-center min-h-screen bg-[#f0f8ff] px-4 py-10">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-10 relative border-4 border-blue-300">
        <h2 class="text-center text-2xl md:text-3xl font-bold text-purple-800 border-b-2 border-purple-700 pb-4 mb-8">Form Ubah Profil</h2>

        <form action="{{ route('admin.profil.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8 text-lg">
            @csrf

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" value="{{ $user->namalengkap }}" readonly class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100 text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-red-700 mb-2">Username*</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" required class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-red-700 mb-2">Password*</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-red-700 mb-2">Nomor Telepon*</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white text-gray-800" />
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">Harap lengkapi data</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold text-red-700 mb-2">Email*</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white text-gray-800" />
            </div>

            <div class="md:col-span-2 text-center mt-4">
                <button type="submit" class="bg-purple-700 hover:bg-purple-800 text-white font-semibold px-8 py-3 rounded-lg transition duration-200">
                    Simpan
                </button>
            </div>
        </form>

        <a href="{{ route('admin.profil') }}" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
    </div>
</div>
@endsection
