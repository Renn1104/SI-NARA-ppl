<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar - SI-NARA</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-cover bg-center relative" style="background-image: url('{{ asset('assets/bg_login.png') }}')">

  <!-- Logo di kiri atas -->
  <div class="absolute top-5 left-5 flex items-center space-x-2">
    <img src="{{ asset('assets/logo.png') }}" alt="SI-NARA Logo" class="w-50 h-20">
    <span class="text-purple-900 font-bold text-xl sm:text-2xl"></span>
  </div>

  <!-- Container Form -->
  <div class="flex items-center justify-center min-h-screen px-4">
    <div class="bg-white bg-opacity-90 backdrop-blur-md p-8 rounded-2xl shadow-lg w-full max-w-md">

      <!-- Judul -->
      <h1 class="text-2xl font-bold text-gray-800 mb-6 text-left">Daftar</h1>

      <!-- Form -->
      <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <!-- Username -->
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Username</label>
          <input type="text" name="username" placeholder="Masukkan Username"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600" required>
            @error('username')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password + Show Eye -->
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Password</label>
          <div class="relative">
            <input type="password" name="password" id="password" placeholder="Masukkan Password"
              class="w-full border border-gray-300 rounded px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-purple-600" required>
            <span onclick="togglePassword()" class="absolute right-3 top-2.5 text-gray-500 cursor-pointer text-xl select-none">👁️</span>
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <!-- Konfirmasi Password -->
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" placeholder="Ulangi Password"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600" required>
            <!-- <span onclick="togglePassword()" class="absolute right-3 top-2.5 text-gray-500 cursor-pointer text-xl select-none">👁️</span> -->
            @error('password_confirmation')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>


        <!-- Nama -->
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Nama</label>
          <input type="text" name="namalengkap" placeholder="Masukkan Nama"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600" required>
            @error('namalengkap')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>


        <!-- Email -->
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Email</label>
          <input type="email" name="email" placeholder="Masukkan Email"
            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600" required>
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

        <!-- Link ke login -->
        <p class="text-sm text-gray-600">
          Sudah punya akun? 
          <a href="{{ route('V_Login') }}" class="text-purple-800 font-semibold hover:underline">Masuk</a>
        </p>

        <!-- Tombol Daftar -->
        <button type="submit"
          class="w-full mt-4 bg-purple-800 hover:bg-purple-900 text-white font-semibold py-2 rounded-lg transition">
          Daftar
        </button>
      </form>
    </div>
  </div>

  <!-- Menampilkan error jika ada -->
@if ($errors->any())
    <div class="bg-red-200 p-4 mb-4 text-red-600 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


  <!-- Script untuk toggle password -->
  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
    }
  </script>

</body>
</html>
