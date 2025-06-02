@extends('layouts.layouts')
@section('title', 'Belanja')
@section('content')

    <form id="checkoutform" action="{{ route('belanja.checkout') }}" method="POST" x-data="cartApp()" class="relative px-6 py-6">

        <h1 class="text-3xl font-semibold text-center text-purple-800 mb-8">Bibit Anggur Nara Garden</h1>

        <!-- Grid Produk -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($produk as $item)
                <a href="{{ route('belanja.detail', $item->id) }}" class="p-4 block">
                    <div
                        class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 flex flex-col justify-between relative overflow-hidden group">
                        <div class="p-4">
                            <img src="{{ $item->foto_bibit ? asset('storage/' . $item->foto_bibit) : '/assets/default-image.jpg' }}"
                                alt="{{ $item->judul_bibit }}"
                                class="h-40 w-full object-contain rounded-xl mb-4 transition-transform duration-300 group-hover:scale-105">
                            <p class="text-center font-semibold text-gray-800 text-lg truncate">{{ $item->judul_bibit }}</p>
                            <p class="text-center text-purple-700 font-bold mt-1 text-sm">
                                Rp{{ number_format($item->harga_bibit, 0, ',', '.') }}</p>
                        </div>

                        @if (Auth::user()->role === 'pelanggan')
                            <button
                                @click="addToCart({{ $item->id }}, '{{ addslashes($item->judul_bibit) }}', {{ $item->harga_bibit }}, '{{ asset('storage/' . $item->foto_bibit) }}')"
                                class="absolute bottom-3 right-3 bg-purple-700 text-white w-8 h-8 rounded-full flex items-center justify-center text-xl hover:bg-purple-800 shadow transition">
                                +
                            </button>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Tombol Tambah Produk untuk Admin -->
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('admin.V_UnggahProduk') }}"
                class="fixed bottom-20 right-6 z-50 bg-purple-700 text-white w-12 h-12 rounded-full flex items-center justify-center text-2xl shadow-lg hover:bg-purple-800 transition">
                +
            </a>
        @endif

        <!-- Sidebar Keranjang (Hanya untuk pelanggan) -->
        @if (Auth::user()->role === 'pelanggan')
            <div x-show="cartItems.length > 0"
                class="fixed top-0 right-0 w-full sm:w-96 h-full bg-white shadow-2xl z-50 p-5 overflow-y-auto" x-transition>
                @csrf
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-purple-700">Keranjang</h2>
                    <button @click="clearCart" class="text-red-500 hover:underline text-sm">Kosongkan</button>
                </div>

                <template x-for="(item, index) in cartItems" :key="item.id + '-' + index">
                    <div class="flex items-center mb-4 border-b pb-2">
                        <img :src="item.image" class="w-14 h-14 object-contain rounded mr-3" />
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800" x-text="item.name"></h3>
                            <p class="text-sm text-gray-600">Rp <span x-text="item.price.toLocaleString()"></span></p>
                            <div class="flex items-center mt-1 space-x-2">
                                <button @click="decreaseQty(item.id)" class="bg-gray-200 px-2 rounded">-</button>
                                <span x-text="item.qty"></span>
                                <button @click="increaseQty(item.id)" class="bg-gray-200 px-2 rounded">+</button>
                            </div>
                        </div>
                    </div>
                </template>

                <div class="border-t pt-4 mt-4 text-right font-bold text-lg">
                    Total: Rp <span x-text="totalPrice().toLocaleString()"></span>
                </div>

                {{-- <a href="{{ route('belanja.checkout') }}"> --}}
                <button type="submit"
                    class="mt-4 w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">Pesan</button>
                {{-- </a> --}}
            </div>
        @endif

    </form>

    <script>
        function checkoutdata() {
            const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            if (cartItems.length === 0) {
                alert('Keranjang belanja Anda kosong!');
                return;
            }

            const totalPrice = cartItems.reduce((sum, item) => sum + item.qty * item.price, 0);
            const orderDetails = cartItems.map(item => `${item.name} (x${item.qty}) - Rp ${item.price.toLocaleString()}`)
                .join('\n');

            const confirmationMessage =
                `Anda akan memesan:\n${orderDetails}\n\nTotal: Rp ${totalPrice.toLocaleString()}\n\nLanjutkan ke pembayaran?`;

            if (confirm(confirmationMessage)) {
                // Redirect to checkout page or perform checkout logic
                window.location.href = "{{ route('belanja.checkout') }}";
            }
        }

        function cartApp() {
            return {
                cartItems: JSON.parse(localStorage.getItem('cartItems')) || [],

                saveCart() {
                    localStorage.setItem('cartItems', JSON.stringify(this.cartItems));
                },

                refreshCart() {
                    this.cartItems = [...this.cartItems];
                    this.saveCart();
                },

                clearCart() {
                    this.cartItems = [];
                    this.saveCart();
                },

                addToCart(id, name, price, image) {
                    const existing = this.cartItems.find(i => i.id === id);
                    if (existing) {
                        existing.qty++;
                    } else {
                        this.cartItems.push({
                            id,
                            name,
                            price,
                            image,
                            qty: 1
                        });
                    }
                    this.refreshCart();
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
                    }
                },

                totalPrice() {
                    return this.cartItems.reduce((sum, item) => sum + item.qty * item.price, 0);
                }
            }
        }
        document.getElementById("checkoutform").addEventListener('submit', (e) => {
            console.log("Form submitted");
            // Inisialisasi cartItems dari localStorage
            e.preventDefault(); // Mencegah form submit default
            const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            const el = document.createElement("input");
            el.name = "cartItems";
            el.value = JSON.stringify(cartItems);
            console.log(el.value);
            document.getElementById("checkoutform").appendChild(el);
            // Lanjutkan dengan submit form
              document.getElementById("checkoutform").submit();
        });

    </script>

@endsection
