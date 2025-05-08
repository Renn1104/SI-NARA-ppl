@extends('layouts.layouts')
@section('title', 'Login')
@section('content')

<body class="bg-cover bg-center min-h-screen flex items-center justify-center" style="background-image: url('{{ asset('assets/bg_login.png') }}')">

  <div class="absolute top-5 left-5 flex items-center space-x-2">
    <img src="{{ asset('assets/logo.png') }}" alt="SI-NARA Logo" class="w-50 h-20">
    <span class="text-purple-900 font-bold text-xl"></span>
  </div>

  <div class="bg-white bg-opacity-90 shadow-lg rounded-xl p-8 w-full max-w-md relative">

    <h2 class="text-xl font-bold mb-6 text-black">Masuk</h2>

    <form action="/login" method="POST" class="space-y-5">
      @csrf 
      <div>
        <label class="block text-sm font-medium mb-1 text-gray-800">Username</label>
        <input type="text" name="username" placeholder="Masukkan Username" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600"> 
      </div>

      <div>
          <label class="block font-semibold text-gray-700 mb-1">Password</label>
          <div class="relative">
          <input type="text" name="password" placeholder="Masukkan Password" required class="w-full border border-gray-300 rounded px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-purple-600">
            <span onclick="togglePassword()" class="absolute right-3 top-2.5 text-gray-500 cursor-pointer text-xl select-none">👁️</span>
          </div>
      </div>

      <div class="flex justify-between items-center text-sm text-gray-600">
        <span>Belum punya akun?</span>
        <a href="{{ route('V_Register') }}" class="px-3 py-1 border border-gray-400 rounded-full text-sm hover:bg-purple-100">Daftar</a>
      </div>

      <button type="submit"
              class="w-full bg-purple-800 text-white py-2 rounded-md hover:bg-purple-900 transition">
        Masuk
      </button>
    </form>
  </div>

    <!-- Script untuk toggle password -->
    <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
    }

  </script>
@endsection
