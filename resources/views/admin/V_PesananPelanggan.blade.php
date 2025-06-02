 @extends('layouts.layouts')
@section('title', 'PesananPelanggan')
@section('content')

    <main class="container mx-auto px-6 py-8">
      <section class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-center bg-purple-800 text-white py-2 rounded-md text-lg font-semibold">Pesanan</h2>

        <div class="bg-gray-100 p-4 mt-4 rounded-md">
          <p class="font-semibold">Yanto Alkaifrun <span class="text-sm text-gray-600 ml-2">(+62) 88558696387</span></p>
          <p class="text-sm text-gray-700 mt-1">
            Toko Isabel, Jl. Kemang Papar, Kediri Jawa Timur 65842
            <a href="#" class="inline-block ml-2 bg-gray-300 text-xs text-black px-2 py-1 rounded-md">Ubah Alamat</a>
          </p>
        </div>

        <div class="flex items-center gap-4 mt-6">
          <img src="https://i.ibb.co/s9b0fz5/grape.png" alt="Bibit Anggur Trans" class="w-20 h-20 object-cover rounded-lg" />
          <div>
            <p class="font-semibold text-base">Bibit Anggur Trans</p>
            <p class="text-purple-800 font-bold mt-1">Rp50.000</p>
            <p class="text-sm text-gray-600">1 x</p>
          </div>
        </div>

        <div class="bg-gray-100 p-4 mt-6 rounded-md text-sm">
          <div class="flex justify-between mb-1">
            <span>Subtotal Produk</span>
            <span>Rp50.000</span>
          </div>
          <div class="flex justify-between mb-1">
            <span>Subtotal Pengiriman</span>
            <span>Rp10.000</span>
          </div>
          <div class="flex justify-between font-semibold mt-2 border-t pt-2">
            <span>Total Pembayaran</span>
            <span>Rp60.000</span>
          </div>
        </div>

        <div class="flex justify-end space-x-4 mt-6">
          <button class="border border-gray-400 px-4 py-2 rounded-md hover:bg-gray-200">Batal</button>
          <button class="bg-purple-800 text-white px-6 py-2 rounded-md hover:bg-purple-700">Bayar</button>
        </div>
      </section>
    </main>
@endsection
