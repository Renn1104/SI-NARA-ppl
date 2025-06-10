@extends('layouts.layouts')
@section('title', 'DetailBelanja')

@section('content')
<main x-data="cartApp()" class="max-w-4xl mx-auto px-4 py-8 bg-white rounded-lg shadow-lg mt-6 relative">

    {{-- Gambar & Info Produk --}}
    <div class="flex flex-col md:flex-row gap-6">
        <img src="{{ asset('storage/' . $produk->foto_bibit) }}" alt="{{ $produk->judul_bibit }}"
            class="w-full md:w-1/2 object-contain rounded" />

        <div class="flex flex-col gap-4 md:w-1/2">
            <h2 class="text-2xl font-semibold">{{ $produk->judul_bibit }}</h2>
            <p class="text-sm text-gray-600">Stok: {{ $produk->jumlah_bibit }}</p>
            <p class="text-3xl font-bold text-purple-700">Rp{{ number_format($produk->harga_bibit, 0, ',', '.') }}</p>

            <div class="flex items-center gap-2">
                <label for="jumlah" class="text-sm">Jumlah</label>
                <div class="flex border rounded px-2 py-1">
                    <button id="minus" type="button" class="px-2 text-lg" @click="detailQty = Math.max(1, detailQty - 1)">-</button>
                    <input type="number" id="jumlah" x-model.number="detailQty" :max="{{ $produk->jumlah_bibit }}" min="1" class="w-12 text-center" />
                    <button id="plus" type="button" class="px-2 text-lg" @click="detailQty++">+</button>
                </div>
            </div>

            @if (Auth::user() && Auth::user()->role === 'pelanggan')
                @if ($produk->jumlah_bibit > 0)
                    <button
                        @click="addToCart({{ $produk->id }}, '{{ addslashes($produk->judul_bibit) }}', {{ $produk->harga_bibit }}, '{{ asset('storage/' . $produk->foto_bibit) }}', {{ $produk->jumlah_bibit }})"
                        class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">
                        + Tambah ke Keranjang
                    </button>
                @else
                    <span class="bg-red-500 text-white px-4 py-2 rounded">Sold Out</span>
                @endif
            @endif

            @if (Auth::check() && Auth::user()->role == 'admin')
                <div class="flex justify-start mt-4 gap-4">
                    <a href="{{ route('produk.edit', $produk->id) }}" class="text-purple-600 hover:text-purple-800 text-2xl">✏️</a>
                    <form id="delete-form-{{ $produk->id }}" action="{{ route('produk.destroy', $produk->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="text-red-600 hover:text-red-800 text-2xl delete-btn"
                            data-id="{{ $produk->id }}" title="Hapus">🗑️</button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <section class="mt-10">
        <h3 class="text-lg font-bold mb-2">Deskripsi</h3>
        <p class="mt-2 text-gray-700 leading-relaxed">{!! nl2br(e($produk->deskripsi_bibit)) !!}</p>
    </section>

    @if ($produk->spesifikasi)
        <div class="mt-6">
            <h4 class="font-semibold mb-1">📦 Spesifikasi Bibit:</h4>
            <ul class="list-disc pl-5 text-gray-700">
                @foreach (explode("\n", $produk->spesifikasi) as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($produk->tips)
        <div class="mt-6">
            <h4 class="font-semibold mb-1">💡 Tips Perawatan:</h4>
            <ul class="list-disc pl-5 text-gray-700">
                @foreach (explode("\n", $produk->tips) as $tip)
                    <li>{{ $tip }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="checkoutform" action="{{ route('belanja.checkout') }}" method="POST" class="relative px-6 py-6">
        @csrf

        @if (Auth::user()->role === 'pelanggan')
            <div x-show="cartItems.length > 0"
                class="fixed top-0 right-0 w-full sm:w-96 h-full bg-white shadow-2xl z-50 p-5 overflow-y-auto"
                x-transition>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-purple-700">Keranjang</h2>
                    <button type="button" @click="clearCart" class="text-red-500 hover:underline text-sm"></button>
                </div>

                <template x-for="(item, index) in cartItems" :key="item.id + '-' + index">
                    <div class="flex items-center mb-4 border-b pb-2">
                        <img :src="item.image" class="w-14 h-14 object-contain rounded mr-3" />
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800" x-text="item.name"></h3>
                            <p class="text-sm text-gray-600">Rp <span x-text="item.price?.toLocaleString()"></span></p>
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
</main>

{{-- Notifikasi Sukses --}}
@if (session('success'))
    <div id="toast-success" class="fixed inset-0 flex items-start justify-center mt-20 z-50">
        <div class="bg-purple-800 text-white px-6 py-4 rounded-xl shadow-lg flex items-center gap-4 animate-pop">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-lime-400" fill="currentColor"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414L8.457 14.95a1 1 0 01-1.414 0l-3.25-3.25a1 1 0 011.414-1.414L8 12.536l7.293-7.293a1 1 0 011.414 0z" />
            </svg>
            <span class="font-semibold text-base">{{ session('success') }}</span>
        </div>
    </div>
@endif
@endsection

@push('styles')
<style>
    @keyframes pop {
        0% { transform: scale(0.8); opacity: 0; }
        60% { transform: scale(1.05); opacity: 1; }
        100% { transform: scale(1); opacity: 1; }
    }
    .animate-pop {
        animation: pop 0.4s ease-out;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function cartApp() {
        return {
            cartItems: JSON.parse(localStorage.getItem('cartItems')) || [],
            detailQty: 1,
            maxQty: 1, // ini untuk batasi input jumlah sesuai stok saat load produk

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

            addToCart(id, name, price, image, stock) {
                // Batasi detailQty maksimal stok
                if (this.detailQty > stock) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Jumlah melebihi stok!',
                        text: `Stok hanya tersedia ${stock} item.`,
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                    this.detailQty = stock;
                    return;
                }

                const existing = this.cartItems.find(i => i.id === id);
                const totalQty = existing ? existing.qty + this.detailQty : this.detailQty;

                if (totalQty > stock) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Stok Tidak Mencukupi!',
                        text: `Stok hanya tersedia ${stock} item. Silakan kurangi jumlah pesanan.`,
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (existing) {
                    existing.qty += this.detailQty;
                } else {
                    this.cartItems.push({ id, name, price, image, qty: this.detailQty, stock: stock });
                }

                this.detailQty = 1;
                this.refreshCart();
            },

            increaseQty(id) {
                const item = this.cartItems.find(i => i.id === id);
                if (item) {
                    if (item.qty + 1 > item.stock) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Stok Tidak Mencukupi!',
                            text: `Stok hanya tersedia ${item.stock} item. Tidak bisa menambah lagi.`,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }
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


    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById("checkoutform").addEventListener('submit', (e) => {
            e.preventDefault();
            const cartItems = JSON.parse(localStorage.getItem('cartItems')) || [];
            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "cartItems";
            input.value = JSON.stringify(cartItems);
            e.target.appendChild(input);
            e.target.submit();
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', () => {
                Swal.fire({
                    title: 'Yakin ingin menghapus produk ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${button.dataset.id}`).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
