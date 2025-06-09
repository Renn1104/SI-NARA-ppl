<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar | SI-NARA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen bg-cover bg-center flex items-center justify-center relative" style="background-image: url('{{ asset('assets/bg_login.png') }}')">

  <!-- Logo pojok kiri atas -->
  <div class="absolute top-6 left-6">
    <img src="{{ asset('assets/logo.png') }}" alt="SI-NARA Logo" class="h-20">
  </div>

  <!-- Form Card -->
  <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl px-10 py-12 w-full max-w-lg">

    <!-- Judul -->
    <h2 class="text-2xl font-bold text-black text-center mb-6">Daftar</h2>

    <!-- Form -->
    <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
      @csrf

      <!-- Username -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
        <input type="text" name="username" placeholder="Masukkan Username" required
          class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-700">
        @error('username')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
        <div class="relative">
          <input type="password" name="password" id="password" placeholder="Masukkan Password" required
            class="w-full border border-gray-300 rounded-full px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-purple-700">
          <button type="button" onclick="togglePassword()" class="absolute right-3 top-2.5 text-gray-500">
            <i id="eyeIcon" class="fa-regular fa-eye-slash"></i>
          </button>
        </div>
        @error('password')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Konfirmasi Password -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" placeholder="Ulangi Password" required
          class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-700">
        @error('password_confirmation')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Nama -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama</label>
        <input type="text" name="namalengkap" placeholder="Masukkan Nama" required
          class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-700">
        @error('namalengkap')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Email -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
        <input type="email" name="email" placeholder="Masukkan Email" required
          class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-700">
        @error('email')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Sudah punya akun -->
      <div class="flex items-center justify-between text-sm text-gray-600">
        <span>Sudah punya akun?</span>
        <a href="{{ route('V_Login') }}" class="px-3 py-1 border border-gray-400 rounded-full bg-white hover:bg-purple-100 transition">
          Masuk <i class="fa-solid fa-arrow-right ml-1"></i>
        </a>
      </div>

      <!-- Tombol Daftar -->
      <button type="submit"
        class="w-full bg-purple-800 text-white font-semibold py-2 rounded-full hover:bg-purple-900 transition">
        Daftar
      </button>
    </form>

    <!-- Menampilkan error umum -->
    @if ($errors->any())
      <div class="bg-red-100 text-red-700 text-sm p-3 mt-4 rounded">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>

  <script>
    function togglePassword() {
      const input = document.getElementById("password");
      const icon = document.getElementById("eyeIcon");
      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      }
    }
  </script>

</body>
</html>
