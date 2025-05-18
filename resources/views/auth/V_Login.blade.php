<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | SI-NARA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen bg-cover bg-center flex items-center justify-center relative" style="background-image: url('{{ asset('assets/bg_login.png') }}')">

  <!-- Logo di pojok kiri atas layar -->
  <div class="absolute top-6 left-6">
    <img src="{{ asset('assets/logo.png') }}" alt="SI-NARA Logo" class="h-14">
  </div>

  <!-- Card Form Login -->
  <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-xl px-10 py-12 w-full max-w-md">

    @if (session('error'))
    <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-md text-center">
        {{ session('error') }}
    </div>
    @endif

    <!-- Judul -->
    <h2 class="text-2xl font-bold text-black text-center mb-6">Masuk</h2>

    <!-- Form -->
    <form action="{{ route('V_Login') }}" method="POST" class="space-y-5">
      @csrf

      <!-- Username -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
        <input type="text" name="username" placeholder="Masukkan Username" required
          class="w-full border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-700">
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
      </div>

      <!-- Daftar -->
      <div class="flex items-center justify-between text-sm text-gray-600">
        <span>Belum punya akun?</span>
        <a href="{{ route('V_Register') }}" class="px-3 py-1 border border-gray-400 rounded-full bg-white hover:bg-purple-100 transition">
          Daftar <i class="fa-solid fa-arrow-right ml-1"></i>
        </a>
      </div>

      <!-- Tombol Masuk -->
      <button type="submit"
        class="w-full bg-purple-800 text-white font-semibold py-2 rounded-full hover:bg-purple-900 transition">
        Masuk
      </button>
    </form>
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
