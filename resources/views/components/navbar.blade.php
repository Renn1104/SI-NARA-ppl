@php
    use Illuminate\Support\Facades\Auth;
@endphp

<nav class="sticky top-0 z-50 bg-white shadow-md transition-all duration-300">
    <div class="flex items-center justify-between px-4 md:px-6 py-4">

        <div class="flex items-center space-x-2">
            <a href="{{ route('V_Landing') }}" class="transform hover:scale-105 transition-transform duration-200">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-12 object-contain">
            </a>
        </div>

        <div class="flex items-center gap-4 ml-auto">
            <ul class="hidden md:flex gap-6 font-semibold text-gray-700 text-sm md:text-base">
                <li>
                    <a href="{{ route('landing') }}"
                       class="relative pb-1 transition-all duration-300 hover:text-purple-700
                              {{ request()->routeIs('V_Landing') ? 'text-black' : '' }}">
                        Beranda
                        <span class="absolute bottom-0 left-0 w-full h-1 bg-purple-800 transform transition-transform duration-300
                                   {{ request()->routeIs('V_Landing') ? 'scale-x-100' : 'scale-x-0 hover:scale-x-100' }}"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('konten') }}"
                       class="relative pb-1 transition-all duration-300 hover:text-purple-700
                              {{ request()->routeIs('konten') ? 'text-black' : '' }}">
                        Konten
                        <span class="absolute bottom-0 left-0 w-full h-1 bg-purple-800 transform transition-transform duration-300
                                   {{ request()->routeIs('konten') ? 'scale-x-100' : 'scale-x-0 hover:scale-x-100' }}"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kalenderevent') }}"
                       class="relative pb-1 transition-all duration-300 hover:text-purple-700
                              {{ request()->routeIs('kalenderevent') ? 'text-black' : '' }}">
                        Kalender Event
                        <span class="absolute bottom-0 left-0 w-full h-1 bg-purple-800 transform transition-transform duration-300
                                   {{ request()->routeIs('kalenderevent') ? 'scale-x-100' : 'scale-x-0 hover:scale-x-100' }}"></span>
                    </a>
                </li>
                <li>
                    @if(Auth::check())
                        <a href="{{ route('produk') }}"
                           class="relative pb-1 transition-all duration-300 hover:text-purple-700
                                  {{ request()->routeIs('produk') ? 'text-black' : '' }}">
                            Belanja
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-purple-800 transform transition-transform duration-300
                                       {{ request()->routeIs('produk') ? 'scale-x-100' : 'scale-x-0 hover:scale-x-100' }}"></span>
                        </a>
                    @else
                        <a href="#" onclick="showLoginAlert()"
                           class="relative pb-1 transition-all duration-300 hover:text-purple-700">
                            Belanja
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-purple-800 transform transition-transform duration-300 scale-x-0 hover:scale-x-100"></span>
                        </a>
                    @endif
                </li>
                <li>
                    @if(Auth::check())
                        <a href="{{ route('riwayat') }}"
                            class="relative pb-1 transition-all duration-300 hover:text-purple-700
                                {{ request()->routeIs('riwayat') ? 'text-black' : '' }}">
                            Riwayat
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-purple-800 transform transition-transform duration-300
                                {{ request()->routeIs('riwayat') ? 'scale-x-100' : 'scale-x-0 hover:scale-x-100' }}"></span>
                        </a>
                    @else
                        <a href="#" onclick="showLoginAlert()"
                            class="relative pb-1 transition-all duration-300 hover:text-purple-700">
                            Riwayat
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-purple-800 transform transition-transform duration-300 scale-x-0 hover:scale-x-100"></span>
                        </a>
                    @endif
                </li>
            </ul>

            @if(Auth::check())
                @php $role = Auth::user()->role; @endphp

                <div class="relative">
                    <button onclick="toggleDropdown()"
                            class="focus:outline-none transform hover:scale-110 transition-all duration-200"
                            id="userButton">
                        <img src="{{ asset('assets/user.png') }}" alt="Profil" class="w-9 h-9 mr-0.5 rounded-full shadow-lg">
                    </button>

                    <div id="userDropdown"
                         class="hidden absolute right-0 mt-2 w-52 bg-white rounded-md shadow-lg z-50 border border-gray-200
                                transform scale-95 opacity-0 transition-all duration-200">
                        <ul class="py-2 text-gray-700">
                            @if($role === 'admin')
                                <li>
                                    <a href="{{ route('admin.profil') }}"
                                       class="flex items-center px-4 py-2 hover:bg-gray-100 transition-colors duration-200">
                                        <img src="{{ asset('assets/user.png') }}" alt="Profil" class="w-5 h-5 mr-2"> Profil
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.profilpelanggan', ['role' => $role]) }}"
                                       class="flex items-center px-4 py-2 hover:bg-gray-100 transition-colors duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75"/>
                                        </svg>
                                        Profil Pelanggan
                                    </a>
                                </li>
                            @elseif($role === 'pelanggan')
                                <li>
                                    <a href="{{ route('pelanggan.profil') }}"
                                       class="flex items-center px-4 py-2 hover:bg-gray-100 transition-colors duration-200">
                                        <img src="{{ asset('assets/user.png') }}" alt="Profil" class="w-5 h-5 mr-2"> Profil
                                    </a>
                                </li>
                            @endif


                            <li>
                                <button onclick="showLogoutModal()" type="button"
                                    class="flex items-center px-4 py-2 text-red-600 hover:bg-red-50 w-full text-left transition-colors duration-200">
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
                <a href="{{ route('V_Login') }}"
                   class="px-4 py-2 border-2 border-purple-800 text-purple-800 font-semibold rounded-lg
                          hover:bg-purple-100 hover:shadow-md transform hover:scale-105 transition-all duration-200">
                    Masuk
                </a>
                <a href="{{ route('V_Register') }}"
                   class="px-4 py-2.5 bg-purple-800 text-white font-semibold rounded-lg
                          hover:bg-purple-900 hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                    Daftar
                </a>
            @endif

            <!-- Hamburger -->
            <button onclick="toggleMobileMenu()"
                    class="md:hidden focus:outline-none transform hover:scale-110 transition-all duration-200"
                    id="hamburgerButton">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path id="hamburgerIcon" class="block transition-all duration-300" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path id="closeIcon" class="hidden transition-all duration-300" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu"
         class="hidden md:hidden bg-white border-t border-gray-200 transform translate-y-0 transition-all duration-300">
        <ul class="flex flex-col items-center gap-4 py-4 font-semibold text-gray-700 text-base">
            <li><a href="{{ route('landing') }}" class="hover:text-purple-700 transition-colors duration-200">Beranda</a></li>
            <li><a href="{{ route('konten') }}" class="hover:text-purple-700 transition-colors duration-200">Konten</a></li>
            <li><a href="{{ route('kalenderevent') }}" class="hover:text-purple-700 transition-colors duration-200">Kalender Event</a></li>
            <li>
                @if(Auth::check())
                    <a href="{{ route('produk') }}" class="hover:text-purple-700 transition-colors duration-200">Belanja</a>
                @else
                    <a href="#" onclick="showLoginAlert()" class="hover:text-purple-700 transition-colors duration-200">Belanja</a>
                @endif
            </li>
            <li>
                @if(Auth::check())
                    <a href="{{ route('riwayat') }}" class="hover:text-purple-700 transition-colors duration-200">Riwayat</a>
                @else
                    <a href="#" onclick="showLoginAlert()" class="hover:text-purple-700 transition-colors duration-200">Riwayat</a>
                @endif
            </li>
        </ul>
    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logoutModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-[100] transition-opacity duration-300">
        <div class="bg-purple-800 text-white rounded-lg shadow-lg p-6 w-80 text-center transform scale-95 transition-transform duration-300">
            <img src="/assets/alert.png" alt="Warning Icon" class="w-12 h-12 mx-auto mb-4" />
            <p class="text-base font-semibold mb-6">Apakah anda yakin ingin Logout?</p>
            <div class="flex justify-center gap-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full
                                   transform hover:scale-105 transition-all duration-200">
                        YA
                    </button>
                </form>
                <button onclick="hideLogoutModal()" type="button"
                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-full
                               transform hover:scale-105 transition-all duration-200">
                    Tidak
                </button>
            </div>
        </div>
    </div>

    <!-- Login Alert Modal -->
    <div id="loginAlertModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-[100] transition-opacity duration-300">
        <div class="bg-white text-gray-800 rounded-lg shadow-lg p-6 w-80 text-center transform scale-95 transition-transform duration-300">
            <div class="w-12 h-12 mx-auto mb-4 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
            <p class="text-base font-semibold mb-6">Harap Login atau Register terlebih dahulu</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('V_Login') }}"
                   class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-full
                          transform hover:scale-105 transition-all duration-200">
                    Login
                </a>
                <button onclick="hideLoginAlert()" type="button"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-full
                               transform hover:scale-105 transition-all duration-200">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</nav>

<script>
let dropdownOpen = false;
let mobileMenuOpen = false;

document.addEventListener('DOMContentLoaded', function() {
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.3s ease-in-out';

    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 100);
});

function smoothTransition(url) {
    document.body.style.opacity = '0';
    setTimeout(() => {
        window.location.href = url;
    }, 200);
}

function toggleDropdown() {
    dropdownOpen = !dropdownOpen;
    const dropdown = document.getElementById('userDropdown');

    if (dropdownOpen) {
        dropdown.classList.remove('hidden');
        setTimeout(() => {
            dropdown.classList.remove('scale-95', 'opacity-0');
            dropdown.classList.add('scale-100', 'opacity-100');
        }, 10);
    } else {
        dropdown.classList.remove('scale-100', 'opacity-100');
        dropdown.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            dropdown.classList.add('hidden');
        }, 200);
    }
}

function toggleMobileMenu() {
    mobileMenuOpen = !mobileMenuOpen;
    const menu = document.getElementById('mobileMenu');
    const hamburgerIcon = document.getElementById('hamburgerIcon');
    const closeIcon = document.getElementById('closeIcon');

    if (mobileMenuOpen) {
        menu.classList.remove('hidden');
        setTimeout(() => {
            menu.classList.remove('-translate-y-full');
            menu.classList.add('translate-y-0');
        }, 10);
        hamburgerIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
    } else {
        menu.classList.remove('translate-y-0');
        menu.classList.add('-translate-y-full');
        setTimeout(() => {
            menu.classList.add('hidden');
        }, 300);
        hamburgerIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
    }
}

function showLogoutModal() {
    const modal = document.getElementById('logoutModal');
    const dropdown = document.getElementById('userDropdown');
    const modalContent = modal.querySelector('div');

    if (dropdownOpen) {
        toggleDropdown();
    }

    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('bg-opacity-0');
        modal.classList.add('bg-opacity-50');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }, 10);
}

function hideLogoutModal() {
    const modal = document.getElementById('logoutModal');
    const modalContent = modal.querySelector('div');

    modal.classList.remove('bg-opacity-50');
    modal.classList.add('bg-opacity-0');
    modalContent.classList.remove('scale-100');
    modalContent.classList.add('scale-95');

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function showLoginAlert() {
    const modal = document.getElementById('loginAlertModal');
    const modalContent = modal.querySelector('div');

    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('bg-opacity-0');
        modal.classList.add('bg-opacity-50');
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');
    }, 10);
}

function hideLoginAlert() {
    const modal = document.getElementById('loginAlertModal');
    const modalContent = modal.querySelector('div');

    modal.classList.remove('bg-opacity-50');
    modal.classList.add('bg-opacity-0');
    modalContent.classList.remove('scale-100');
    modalContent.classList.add('scale-95');

    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Enhanced outside click handlers
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const userButton = document.getElementById('userButton');

    if (dropdown && userButton && !dropdown.contains(event.target) && !userButton.contains(event.target) && dropdownOpen) {
        toggleDropdown();
    }
});

document.addEventListener('click', function(event) {
    const mobileMenu = document.getElementById('mobileMenu');
    const hamburgerButton = document.getElementById('hamburgerButton');

    if (mobileMenu && hamburgerButton && !mobileMenu.contains(event.target) && !hamburgerButton.contains(event.target) && mobileMenuOpen) {
        toggleMobileMenu();
    }
});

// Add smooth scroll behavior
document.documentElement.style.scrollBehavior = 'smooth';

// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('nav');
    if (window.scrollY > 50) {
        navbar.classList.add('shadow-lg');
        navbar.classList.remove('shadow-md');
    } else {
        navbar.classList.add('shadow-md');
        navbar.classList.remove('shadow-lg');
    }
});
</script>
