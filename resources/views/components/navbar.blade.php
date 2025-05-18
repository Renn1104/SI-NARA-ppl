@php
    use Illuminate\Support\Facades\Auth;
@endphp

<nav x-data="{
        open: false,
        dropdownOpen: false,
        showLogoutConfirm: false,
        welcomeVisible: false,

        init() {
            @if(session('login_success'))
                this.$nextTick(() => {
                    setTimeout(() => {
                        if (!this.showLogoutConfirm) {
                            this.welcomeVisible = true;
                            setTimeout(() => this.welcomeVisible = false, 3000);
                        }
                    }, 300);
                });
            @endif
        }

    }"
    class="sticky top-0 z-50 bg-white shadow-md"
>
    <div class="flex items-center justify-between px-4 md:px-6 py-4">

        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <a href="{{ route('V_Landing') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-12 object-contain">
            </a>
        </div>

        <!-- Right Section: Nav + Auth + Hamburger -->
        <div class="flex items-center gap-4 ml-auto">

            <!-- Desktop Nav -->
            <ul class="hidden md:flex gap-6 font-semibold text-gray-700 text-sm md:text-base">
                <li><a href="{{ route('landing') }}" class="{{ request()->routeIs('V_Landing') ? 'text-black border-b-4 border-purple-800 pb-1' : 'hover:text-purple-700' }}">Beranda</a></li>
                <li><a href="{{ route('konten') }}" class="{{ request()->routeIs('V_Konten') ? 'text-black border-b-4 border-purple-800 pb-1' : 'hover:text-purple-700' }}">Konten</a></li>
                <li><a href="{{ route('kalenderevent') }}" class="{{ request()->routeIs('V_kalenderevent') ? 'text-black border-b-4 border-purple-800 pb-1' : 'hover:text-purple-700' }}">Kalender Event</a></li>
                <li>
                    @if(Auth::check())
                        <a href="{{ route('produk') }}" class="{{ request()->routeIs('produk') ? 'text-black border-b-4 border-purple-800 pb-1' : 'hover:text-purple-700' }}">Belanja</a>
                    @else
                        <a href="#" onclick="alert('Harap Login atau Register terlebih dahulu')" class="hover:text-purple-700">Belanja</a>
                    @endif
                </li>
                <li><a href="#" class="hover:text-purple-700">Riwayat</a></li>
            </ul>

            @if(Auth::check())
                @php $role = Auth::user()->role; @endphp

                <!-- Dropdown User Icon -->
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" class="focus:outline-none">
                        <img src="{{ asset('assets/user.png') }}" alt="Profil" class="w-9 h-9 mr-0.5">
                    </button>

                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition
                        class="absolute right-0 mt-2 w-52 bg-white rounded-md shadow-lg z-50 border border-gray-200">
                        <ul class="py-2 text-gray-700">
                            <li>
                                <a href="{{ route('admin.profil', ['role' => $role]) }}" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                    <img src="{{ asset('assets/user.png') }}" alt="Profil" class="w-5 h-5 mr-2"> Profil
                                </a>
                            </li>
                            @if($role === 'admin')
                            <li>
                                <a href="{{ route('pelanggan.profil', ['role' => $role]) }}" class="flex items-center px-4 py-2 hover:bg-gray-100">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75"/>
                                    </svg>
                                    Profil Pelanggan
                                </a>
                            </li>
                            @endif
                            <li>
                                <button @click="showLogoutConfirm = true; welcomeVisible = false; dropdownOpen = false"
                                    class="flex items-center px-4 py-2 text-red-600 hover:bg-gray-100 w-full">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m4-8V7a2 2 0 10-4 0v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <a href="{{ route('V_Login') }}" class="px-4 py-2 border-2 border-purple-800 text-purple-800 font-semibold rounded hover:bg-purple-200 transition">
                    Masuk
                </a>
                <a href="{{ route('V_Register') }}" class="px-4 py-2.5 bg-purple-800 text-white font-semibold rounded hover:bg-purple-900 transition">
                    Daftar
                </a>
            @endif

            <!-- Hamburger -->
            <button @click="open = !open" class="md:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open }" class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{ 'hidden': !open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden" x-show="open" x-transition @click.away="open = false" class="bg-white border-t border-gray-200">
        <ul class="flex flex-col items-center gap-4 py-4 font-semibold text-gray-700 text-base">
            <li><a href="{{ route('landing') }}" class="hover:text-purple-700">Beranda</a></li>
            <li><a href="{{ route('konten') }}" class="hover:text-purple-700">Konten</a></li>
            <li><a href="{{ route('kalenderevent') }}" class="hover:text-purple-700">Kalender Event</a></li>
            <li>
                @if(Auth::check())
                    <a href="{{ route('produk') }}" class="hover:text-purple-700">Belanja</a>
                @else
                    <a href="#" onclick="alert('Harap Login atau Register terlebih dahulu')" class="hover:text-purple-700">Belanja</a>
                @endif
            </li>
            <li><a href="#" class="hover:text-purple-700">Riwayat</a></li>
        </ul>
    </div>

    <!-- Ucapan Selamat Datang -->
    <div x-show="welcomeVisible" x-transition class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        Selamat datang, {{ Auth::user()->name ?? 'User' }}!
    </div>

    <!-- Logout Confirmation Modal -->
    <div x-show="showLogoutConfirm" x-transition class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-purple-800 text-white rounded-lg shadow-lg p-6 w-80 text-center">
            <img src="/assets/alert.png" alt="Warning Icon" class="w-12 h-12 mx-auto mb-4" />
            <p class="text-base font-semibold mb-6">Apakah anda yakin ingin Logout?</p>
            <div class="flex justify-center gap-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full transition">
                        YA
                    </button>
                </form>
                <button @click="showLogoutConfirm = false" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-full transition">
                    Tidak
                </button>
            </div>
        </div>
    </div>
</nav>


<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
