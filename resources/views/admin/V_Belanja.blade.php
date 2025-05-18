@extends('layouts.layouts')
@section('title', 'Belanja')
@section('content')

<main x-data="cartApp()" class="px-6 py-6 relative">
  <h1 class="text-3xl font-thin text-black-500 text-center mb-8">Bibit Anggur Nara Garden</h1>

  @php
    $products = [
      ['id' => 1, 'img' => 'anggur 2.jpg', 'nama' => 'Bibit Anggur Trans', 'harga' => 50000],
      ['id' => 2, 'img' => 'anggur 1.jpg', 'nama' => 'Bibit Anggur Livia', 'harga' => 50000],
      ['id' => 3, 'img' => 'anggur 2.jpg', 'nama' => 'Bibit Anggur Gosvi', 'harga' => 50000],
      ['id' => 4, 'img' => 'anggur 1.jpg', 'nama' => 'Bibit Anggur Beuty Ravesca', 'harga' => 50000],
      ['id' => 5, 'img' => 'anggur 2.jpg', 'nama' => 'Bibit Anggur Jupiter', 'harga' => 50000],
      ['id' => 6, 'img' => 'anggur 1.jpg', 'nama' => 'Bibit Anggur ???', 'harga' => 75000]
    ];
  @endphp

  <!-- Grid Produk -->
  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach ($products as $item)
      <div class="relative bg-white rounded-xl shadow hover:shadow-lg p-4 transition duration-200 min-h-[300px] flex flex-col justify-between">
        <img src="/assets/{{ $item['img'] }}" alt="{{ $item['nama'] }}" class="h-40 w-full object-contain mb-4 rounded-lg" />
        <p class="font-semibold text-center text-gray-800">{{ $item['nama'] }}</p>
        <p class="text-center text-purple-700 font-bold mt-1">
          Rp{{ number_format($item['harga'], 0, ',', '.') }}
        </p>
            @if(Auth::user()->role != 'admin')
        <button @click="addToCart({{ $item['id'] }}, '{{ $item['nama'] }}', {{ $item['harga'] }}, '/assets/{{ $item['img'] }}')" class="absolute bottom-3 right-3 bg-purple-700 text-white w-7 h-7 rounded-full flex items-center justify-center text-lg hover:bg-purple-800">
          +
        </button>
        @endif
      </div>
    @endforeach
  </div>

  <!-- Sidebar Keranjang -->
  <div x-show="cartItems.length > 0" class="fixed top-0 right-0 w-full sm:w-96 h-full bg-white shadow-lg z-50 p-5" x-transition>
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-xl font-bold">Keranjang</h2>
      <button @click="cartItems = []" class="text-red-500 hover:underline">Kosongkan</button>
    </div>

    <template x-for="item in cartItems" :key="item.id">
      <div class="flex items-center mb-4">
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

    <div class="border-t pt-4 mt-4 text-right font-bold">
      Total: Rp <span x-text="totalPrice().toLocaleString()"></span>
    </div>
    <button class="mt-4 w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Cek Pesanan</button>
  </div>
</main>

@auth
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.V_UnggahProduk') }}"
           class="absolute bottom-3 right-3 bg-purple-700 text-white w-12 h-12 rounded-full flex items-center justify-center text-2xl shadow-lg hover:bg-purple-800 transition duration-200">
            +
        </a>
    @endif
@endauth

<script>
  function cartApp() {
    return {
      cartItems: [],
      addToCart(id, name, price, image) {
        const existing = this.cartItems.find(i => i.id === id)
        if (existing) {
          existing.qty++
        } else {
          this.cartItems.push({ id, name, price, image, qty: 1 })
        }
      },
      increaseQty(id) {
        const item = this.cartItems.find(i => i.id === id)
        if (item) item.qty++
      },
      decreaseQty(id) {
        const item = this.cartItems.find(i => i.id === id)
        if (item.qty > 1) {
          item.qty--
        } else {
          this.cartItems = this.cartItems.filter(i => i.id !== id)
        }
      },
      totalPrice() {
        return this.cartItems.reduce((sum, item) => sum + item.qty * item.price, 0)
      }
    }
  }
</script>

@endsection
