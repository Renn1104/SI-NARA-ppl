@extends('layouts.layouts')
@section('title', 'Belanja')
@section('content')

@php
    $userId = Auth::id();
@endphp

<form id="checkoutform" action="{{ route('belanja.checkout') }}" method="POST" x-data="cartApp({{ $userId }})" class="relative px-6 py-6">
    <h1 class="text-3xl font-semibold text-center text-purple-800 mb-8">Bibit Anggur Nara Garden</h1>

    <!-- Grid Produk -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($produk as $item)
            <div class="p-4 block">
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden group">
                    <a href="{{ route('belanja.detail', $item->id) }}" class="p-4 block">
                        <img src="{{ $item->foto_bibit ? asset('storage/' . $item->foto_bibit) : '/assets/default-image.jpg' }}"
                             alt="{{ $item->judul_bibit }}"
                             class="h-40 w-full object-contain rounded-xl mb-4 transition-transform duration-300 group-hover:scale-105">
                        <p class="text-center font-semibold text-gray-800 text-lg truncate">{{ $item->judul_bibit }}</p>
                        <p class="text-center text-purple-700 font-bold mt-1 text-sm">
                            Rp{{ number_format($item->harga_bibit, 0, ',', '.') }}</p>
                    </a>

                    @if (Auth::user()->role === 'pelanggan')
                        <button type="button"
                            @click="toggleSidebar(); addToCart({{ $item->id }}, '{{ addslashes($item->judul_bibit) }}', {{ $item->harga_bibit }}, '{{ asset('storage/' . $item->foto_bibit) }}')"
                            class="absolute bottom-3 right-3 bg-purple-700 text-white w-8 h-8 rounded-full flex items-center justify-center text-xl hover:bg-purple-800 shadow transition">
                            +
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @if (Auth::user()->role === 'admin')
        <a href="{{ route('admin.V_UnggahProduk') }}"
            class="fixed bottom-20 right-6 z-50 bg-purple-700 text-white w-12 h-12 rounded-full flex items-center justify-center text-2xl shadow-lg hover:bg-purple-800 transition">
            +
        </a>
    @endif

    @if (Auth::user()->role === 'pelanggan')
        <div x-show="sidebarOpen && cartItems.length > 0"
            class="fixed top-0 right-0 w-full sm:w-96 h-full bg-white shadow-2xl z-50 p-5 overflow-y-auto"
            x-transition>
            @csrf
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-purple-700">Keranjang</h2>
                <div class="flex space-x-2">
                    <button type="button" @click="clearCart" class="text-red-500 hover:underline text-sm">Kosongkan</button>
                    <button type="button" @click="toggleSidebar" class="text-gray-500 hover:text-gray-700 text-sm">Tutup</button>
                </div>
            </div>

            <template x-for="(item, index) in cartItems" :key="item.id + '-' + index">
                <div class="flex items-center mb-4 border-b pb-2">
                    <img :src="item.image" class="w-14 h-14 object-contain rounded mr-3" />
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800" x-text="item.name"></h3>
                        <p class="text-sm text-gray-600">Rp <span x-text="item.price.toLocaleString()"></span></p>
                        <div class="flex items-center mt-1 space-x-2">
                            <button type="button" @click="decreaseQty(item.id)" class="bg-gray-200 px-2 rounded">-</button>
                            <span x-text="item.qty"></span>
                            <button type="button" @click="increaseQty(item.id)" class="bg-gray-200 px-2 rounded">+</button>
                        </div>
                    </div>
                </div>
            </template>

            <div class="border-t pt-4 mt-4 text-right font-bold text-lg">
                Total: Rp <span x-text="totalPrice().toLocaleString()"></span>
            </div>

            <button type="submit"
                class="mt-4 w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">Pesan</button>
        </div>
    @endif
</form>

<script>
    function cartApp(userId) {
        const localKey = `cartItems_${userId}`;

        return {
            cartItems: JSON.parse(localStorage.getItem(localKey)) || [],
            sidebarOpen: false,

            saveCart() {
                localStorage.setItem(localKey, JSON.stringify(this.cartItems));
            },

            refreshCart() {
                this.cartItems = [...this.cartItems];
                this.saveCart();
            },

            clearCart() {
                this.cartItems = [];
                this.saveCart();
                this.sidebarOpen = false;
            },

            addToCart(id, name, price, image) {
                const existing = this.cartItems.find(i => i.id === id);
                if (existing) {
                    existing.qty++;
                } else {
                    this.cartItems.push({ id, name, price, image, qty: 1 });
                }
                this.refreshCart();
                this.sidebarOpen = true;
            },

            increaseQty(id) {
                const item = this.cartItems.find(i => i.id === id);
                if (item) {
                    item.qty++;
                    this.refreshCart();
                }
            },

            decreaseQty(id) {
                const index = this.cartItems.findIndex(i => i.id === id);
                if (index !== -1) {
                    if (this.cartItems[index].qty > 1) {
                        this.cartItems[index].qty--;
                    } else {
                        this.cartItems.splice(index, 1);
                    }
                    this.refreshCart();
                    if (this.cartItems.length === 0) {
                        this.sidebarOpen = false;
                    }
                }
            },

            totalPrice() {
                return this.cartItems.reduce((sum, item) => sum + item.qty * item.price, 0);
            },

            toggleSidebar() {
                this.sidebarOpen = !this.sidebarOpen;
            }
        }
    }

    // Handle form submit dan kirim data keranjang
    document.getElementById("checkoutform").addEventListener('submit', (e) => {
        e.preventDefault();
        const userId = {{ $userId }};
        const cartItems = JSON.parse(localStorage.getItem(`cartItems_${userId}`)) || [];
        if (cartItems.length === 0) {
            alert('Keranjang belanja Anda kosong!');
            return;
        }

        const el = document.createElement("input");
        el.name = "cartItems";
        el.value = JSON.stringify(cartItems);
        el.type = "hidden";
        document.getElementById("checkoutform").appendChild(el);
        e.target.submit();
    });
</script>

@endsection
