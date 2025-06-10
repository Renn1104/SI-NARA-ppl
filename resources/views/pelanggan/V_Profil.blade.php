@extends('layouts.layouts')
@section('title', 'Profil')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-[#f0f8ff] px-4 py-10">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl p-10 relative">
        <h2 class="text-center text-3xl font-bold text-purple-800 border-b-2 border-purple-700 pb-4 mb-8">Profil</h2>

        <form class="grid grid-cols-1 md:grid-cols-2 gap-8 text-lg pb-20">
            <div>
                <label class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" value="{{ $user->namalengkap }}" readonly class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100 text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Username</label>
                <input type="text" value="{{ $user->username }}" readonly class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100 text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" value="******" readonly class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100 text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Nomor Telepon</label>
                <input type="text" value="{{ $user->phone }}" readonly class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100 text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" value="{{ $user->email }}" readonly class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100 text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Alamat</label>
                <input type="text" value="{{ $user->alamat }}" readonly class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100 text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Kecamatan</label>
                <input type="text" value="{{ $user->kecamatan }}" readonly class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100 text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Kabupaten/Kota</label>
                <input type="text" value="{{ $user->kabupatenkota }}" readonly class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100 text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Provinsi</label>
                <input type="text" value="{{ $user->provinsi}}" readonly class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100 text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Kode Pos</label>
                <input type="text" value="{{ $user->kodepos}}" readonly class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100 text-gray-800" />
            </div>
        </form>

        <a href="{{ route('pelanggan.profil.edit') }}" class="absolute bottom-6 right-6 bg-purple-700 hover:bg-purple-800 text-white rounded-full p-4 shadow-lg transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M4 13v7h7l10-10-7-7-10 10z" />
            </svg>
        </a>
    </div>
</div>
@endsection
