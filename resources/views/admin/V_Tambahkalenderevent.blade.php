<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SI-NARA Homepage</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="font-sans bg-white">

  <!-- Navbar -->
<nav class="sticky top-0 z-50 bg-white shadow-md">
  <div class="flex items-center justify-between px-4 md:px-6 py-4">
    <!-- Kiri -->
    <div class="flex items-center gap-4">
      <img src="{{ asset('assets/Menu.png') }}" alt="menu" class="w-10 h-10">
      <a href="{{ route('V_Landing') }}">
            <img src="{{ asset('assets/Home.png') }}" alt="Home Icon" class="w-9 h-8 hover:opacity-80 transition duration-300">
        </a>
    </div>

    <!-- Tengah -->
    <div class="flex-1 flex justify-center items-center">
      <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-12 object-contain">
    </div>

  <!-- Kanan -->
     <!-- @uf(Auth::user()->roles != 'admin'); -->
     @if (Auth::user()) 
     <div class="flex items-center">
        <div class="flex items-center ms-3">
            <!-- <div class=" mr-2.5 bg-[#178948] rounded-lg"> -->
              <p class="px-4 py-1 text-white">{{Auth::user()->name}}</p>
            </div>
                    <div>
                        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{Auth::user()->name}}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{Auth::user()->email}}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
     @else 
      <div class="flex items-center gap-4">
      <a href="{{ route('V_Login') }}" class="px-4 py-2 border-2 border-purple-800 text-purple-800 font-semibold rounded hover:bg-purple-200 transition">
        Masuk
      </a>
      <a href="{{ route('V_Register') }}" class="px-4 py-2.5 bg-purple-800 text-white font-semibold rounded hover:bg-purple-900 transition">
        Daftar
      </a>
    </div>
    @endif
  </div>
  
  <!-- Menu Navigasi -->
<div class="bg-white border-t border-gray-200">
    <ul class="flex justify-center gap-6 py-3 font-semibold text-gray-700">
        <li>
            <a href="{{ route('V_Konten') }}" 
            class="{{ request()->routeIs('V_Konten') ? 'text-purple-800 border-b-4 border-purple-800 pb-1' : 'hover:text-purple-700' }}">
            Konten
            <p class="px-4 py-1 text-white bg-purple-800 rounded-md">{{ Auth::user()->name }}</p>
          </a>
        </li>
        <li>
          <a href="{{ route('V_KalenderEvent) }}" 
             class="{{ request()->routeIs('V_KalenderEvent') ? 'text-purple-800 border-b-4 border-purple-800 pb-1' : 'hover:text-purple-700' }}">
             Kalender Event
          </a>
        </li>
        <li><a href="#" class="hover:text-purple-700">Reservasi</a></li>
        <li><a href="#" class="hover:text-purple-700">Produk</a></li>
        <li><a href="#" class="hover:text-purple-700">Transaksi</a></li>
      </ul>
    </div>
  </nav>

  <!-- Form Container -->
  <div class="flex justify-center mt-10">
    <div class="bg-white shadow-md w-full max-w-2xl rounded-lg">
      <div class="bg-purple-700 text-white text-center py-3 rounded-t-lg text-lg font-semibold">
        Form Buat Kalender Event
      </div>
      <form class="p-6 space-y-4">
        <!-- Judul -->
        <div>
          <label class="block font-medium">Judul Konten<span class="text-red-500">*</span></label>
          <input type="text" placeholder="Masukkan judul konten anda, maksimal 540 karakter" class="w-full mt-1 p-2 border rounded" required>
        </div>

        <!-- Tanggal dan Jam -->
        <div class="flex space-x-4">
          <div class="flex-1">
            <label class="block font-medium">Tanggal<span class="text-red-500">*</span></label>
            <input type="date" class="w-full mt-1 p-2 border rounded" required>
          </div>
          <div class="flex-1">
            <label class="block font-medium">Jam<span class="text-red-500">*</span></label>
            <input type="time" class="w-full mt-1 p-2 border rounded" required>
          </div>
        </div>

        <!-- Deskripsi -->
        <div>
          <label class="block font-medium">Deskripsi Konten<span class="text-red-500">*</span></label>
          <textarea rows="4" placeholder="Masukkan deskripsi konten anda, maksimal 540 karakter" class="w-full mt-1 p-2 border rounded" required></textarea>
        </div>

        <!-- Upload -->
        <div>
          <label class="block font-medium">Unggah berkas konten<span class="text-red-500">*</span></label>
          <div class="w-full mt-1 p-6 border-2 border-dashed border-gray-300 text-center text-gray-500 rounded cursor-pointer">
            <input type="file" class="hidden" id="upload" required>
            <label for="upload" class="block">
              <div class="text-3xl mb-2">☁️</div>
              Klik untuk mengunggah<br />
              <span class="text-sm">Seret dan lepas berkas anda disini</span>
            </label>
          </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="text-center">
          <button type="submit" class="bg-purple-700 text-white px-8 py-2 rounded hover:bg-purple-800">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-purple-900 text-white mt-10 py-8 px-4">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-start">
      <div>
        <div class="flex items-center mb-2">
          <img src="{{ asset('assets/logo sinara.png') }}" alt="Logo SI-NARA" class="w-50 h-20 mr-2">
        </div>
        <p>Jember<br>Indonesia</p>
        <p class="mt-2">Telepon: +62 81249494460</p>
        <p>Email: sinara.id@gmail.com</p>
      </div>

      <div class="mt-4 md:mt-0">
        <h3 class="font-semibold mb-2">Kunjungi kami di:</h3>
        <br>
        <div class="flex space-x-4 text-2xl">
          <a href="https://www.instagram.com/nara_garden_jember" target="_blank">
            <img src="{{ asset('assets/ig.png') }}" alt="Instagram" class="w-10 h-10">
          </a>
          <a href="https://www.tiktok.com/@nara_jember" target="_blank">
            <img src="{{ asset('assets/tt.png') }}" alt="Tiktok" class="w-10 h-10">
          </a>
          <a href="https://youtube.com/@hadi_poernomo" target="_blank">
            <img src="{{ asset('assets/Youtube.png') }}" alt="YouTube" class="w-10 h-10">
          </a>
        </div>
      </div>
    </div>
    <div class="text-center mt-4 text-sm">
      © Copyright by SI-NARA
    </div>
  </footer>

</body>
</html>
