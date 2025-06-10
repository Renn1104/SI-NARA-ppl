<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','tidak ada judul')</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/naracon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="font-sans bg-white min-h-screen flex flex-col">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Flash Message -->
    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition
            class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded shadow z-50"
        >
            {{ session('success') }}
        </div>
    @endif

    <!-- Konten utama -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer selalu di bawah -->
    @include('components.footer')

    @stack('scripts')
    @yield('scripts')

    {{-- Script untuk reset keranjang saat ganti akun --}}
    <script>
        const currentUserId = {{ Auth::check() ? Auth::id() : 'null' }};
        const lastUserId = localStorage.getItem("lastUserId");

        // Jika user sebelumnya berbeda, hapus keranjang user lama
        if (lastUserId && lastUserId !== currentUserId.toString()) {
            localStorage.removeItem(`cartItems_${lastUserId}`);
        }

        // Simpan user ID saat ini
        localStorage.setItem("lastUserId", currentUserId);

        // Hapus localStorage saat logout
        document.addEventListener('DOMContentLoaded', () => {
            const logoutForm = document.getElementById('logout-form');
            if (logoutForm) {
                logoutForm.addEventListener('submit', () => {
                    localStorage.clear();
                });
            }

            const logoutLink = document.querySelector('a[href="{{ route('logout') }}"]');
            if (logoutLink) {
                logoutLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    localStorage.clear();
                    document.getElementById('logout-form').submit();
                });
            }
        });
    </script>

</body>
</html>
