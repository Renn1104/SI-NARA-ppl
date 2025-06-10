@extends('layouts.layouts')
@section('title', 'EditProfil')

@section('content')


@if (session('success'))
    <div class="mx-auto max-w-xl mb-6 px-4">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
@endif
<div class="flex justify-center items-center min-h-screen bg-[#f0f8ff] px-4 py-10">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-10 relative border-4 border-blue-300">
        <h2 class="text-center text-2xl md:text-3xl font-bold text-purple-800 border-b-2 border-purple-700 pb-4 mb-8">
            Form Ubah Profil
        </h2>

        <form id="editProfilForm" action="{{ route('admin.profil.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8 text-lg">
            @csrf

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" value="{{ $user->namalengkap }}" readonly
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100 text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-red-700 mb-2">Username*</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-red-700 mb-2">Password*</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white text-gray-800" />
            </div>

            <div>
                <label class="block font-semibold text-red-700 mb-2">Nomor Telepon*</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white text-gray-800" />
                @error('phone')
                <p class="text-red-500 text-sm mt-1">Harap lengkapi data</p>
                @enderror
            </div>

            <div>
                <label class="block font-semibold text-red-700 mb-2">Email*</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white text-gray-800" />
            </div>

            <div class="md:col-span-2 text-center mt-4">
                <button type="button" onclick="openModal()"
                    class="bg-purple-700 hover:bg-purple-800 text-white font-semibold px-8 py-3 rounded-lg transition duration-200">
                    Simpan
                </button>
            </div>
        </form>

        <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
            <div class="bg-purple-800 text-white p-8 rounded-xl shadow-lg text-center w-full max-w-md mx-auto">
                <div class="text-4xl mb-4">⚠️</div>
                <p class="text-lg font-semibold mb-6">Apakah anda yakin dengan perubahan yang dilakukan?</p>
                <div class="flex justify-center gap-6">
                    <button onclick="submitForm()"
                        class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-full font-bold">YA</button>
                    <button onclick="closeModal()"
                        class="bg-red-600 hover:bg-red-700 px-6 py-2 rounded-full font-bold">Tidak</button>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.profil') }}" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
    </div>
</div>

<script>
    function openModal() {
        const form = document.getElementById('editProfilForm');

        if (form.checkValidity()) {
            const modal = document.getElementById('confirmModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        } else {
            form.reportValidity();
        }
    }

    function closeModal() {
        const modal = document.getElementById('confirmModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

    function submitForm() {
        document.getElementById('editProfilForm').submit();
    }
</script>

@endsection
