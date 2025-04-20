<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Tambah Konten</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

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
      @if (Auth::user()) 
      <div class="flex items-center gap-3">
          <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" data-dropdown-toggle="dropdown-user">
                  <span class="sr-only">Open user menu</span>
            <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
          </button>
        </div>
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow" id="dropdown-user">
            <div class="px-4 py-3">
            <p class="text-sm text-gray-900">{{ Auth::user()->name }}</p>
            <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->email }}</p>
        </div>
          <ul class="py-1">
              <li>
                  <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</a>
                </li>
          </ul>
        </div>
    </div>
    @else 
    <div class="flex items-center gap-4">
        <a href="{{ route('V_Login') }}" class="px-4 py-2 border-2 border-purple-800 text-purple-800 font-semibold rounded hover:bg-purple-200 transition">Masuk</a>
        <a href="{{ route('V_Register') }}" class="px-4 py-2.5 bg-purple-800 text-white font-semibold rounded hover:bg-purple-900 transition">Daftar</a>
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

  <!-- Form Section -->
  <main class="flex justify-center items-center py-12 px-4">
    <div class="bg-white shadow-lg rounded-xl w-full max-w-xl p-6 relative">
      <button class="absolute right-4 top-4 text-gray-500 hover:text-red-500 text-2xl leading-none">&times;</button>
      <h2 class="text-center text-xl font-bold text-purple-800 mb-6">Form Tambah Konten</h2>

      <form action="{{ route('konten.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
          <label class="block text-sm font-semibold">Judul Konten*</label>
          <input type="text" name="judul_konten" placeholder="Masukkan judul konten anda, maksimal 120 karakter"
            class="mt-1 w-full border border-gray-300 rounded p-2 focus:outline-purple-700" required>
        </div>

        <div class="flex flex-col md:flex-row gap-4">
          <div class="flex-1">
            <label class="block text-sm font-semibold">Tanggal*</label>
            <input type="date" name="tanggal" class="mt-1 w-full border border-gray-300 rounded p-2" required>
          </div>
          <div class="flex-1">
            <label class="block text-sm font-semibold">Jam*</label>
            <input type="time" name="jam" class="mt-1 w-full border border-gray-300 rounded p-2" required>
          </div>
        </div>

        <div>
          <label class="block text-sm font-semibold">Deskripsi Konten*</label>
          <textarea name="deskripsi_konten" rows="4" placeholder="Masukkan deskripsi konten maksimal 540 karakter"
            class="mt-1 w-full border border-gray-300 rounded p-2 focus:outline-purple-700" required></textarea>
        </div>

        <div class="col-span-full">
          <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Cover photo</label>
          <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
            <div class="text-center">
              <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
              </svg>
              <div class="mt-4 flex text-sm/6 text-gray-600">
                <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                  <span>Upload a file</span>
                  <input id="file-upload" name="file-upload" type="file" class="sr-only">
                </label>
                <p class="pl-1">or drag and drop</p>
              </div>
              <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
            </div>
          </div>
        </div>
      </div>
    </div>

        <div class="text-center">
          <button type="submit" class="bg-purple-800 text-white font-semibold px-6 py-2 rounded hover:bg-purple-900 transition">Unggah</button>
        </div>
      </form>
    </div>
  </main>

   <!-- Footer -->
   <footer class="bg-purple-900 text-white mt-10 py-8 px-4">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between">
      <div class="mb-6 md:mb-0">
        <div class="flex items-center mb-2">
          <img src="{{ asset('assets/logo sinara.png') }}" alt="Logo" class="w-36 h-auto">
        </div>
        <p>Jember, Indonesia</p>
        <p class="mt-2">Telepon: +62 81249494460</p>
        <p>Email: sinara.id@gmail.com</p>
      </div>
      <div>
        <h3 class="font-semibold mb-2">Kunjungi kami di:</h3>
        <div class="flex gap-4 mt-2">
          <a href="https://www.instagram.com/nara_garden_jember" target="_blank">
            <img src="{{ asset('assets/ig.png') }}" alt="Instagram" class="w-10 h-10">
          </a>
          <a href="https://www.tiktok.com/@nara_jember" target="_blank">
            <img src="{{ asset('assets/tt.png') }}" alt="TikTok" class="w-10 h-10">
          </a>
          <a href="https://youtube.com/@hadi_poernomo" target="_blank">
            <img src="{{ asset('assets/Youtube.png') }}" alt="YouTube" class="w-10 h-10">
          </a>
        </div>
      </div>
    </div>
    <div class="text-center mt-6 text-sm">
      &copy; 2025 SI-NARA
    </div>
  </footer>

</body>
</html>
