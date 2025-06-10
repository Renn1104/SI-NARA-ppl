@extends('layouts.layouts')
@section('title', 'Pesanan Pelanggan')
@section('content')

<main class="container mx-auto px-6 py-8">
  <section class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-center bg-purple-800 text-white py-2 rounded-md text-lg font-semibold">Pesanan</h2>

    {{-- Alamat Pengiriman --}}
    <div class="bg-gray-100 p-4 mt-4 rounded-md shadow-sm">
      <h3 class="text-lg font-semibold mb-2">Alamat Pengiriman</h3>
      <div class="flex items-start space-x-3">
        <div class="mt-1 text-purple-800">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.656 0 3-1.344 3-3s-1.344-3-3-3-3 1.344-3 3 1.344 3 3 3z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22s8-4.5 8-11a8 8 0 10-16 0c0 6.5 8 11 8 11z" />
          </svg>
        </div>

        <div class="text-sm">
          <p><span class="font-bold text-black">{{ $pesanan->user->namalengkap }}</span> <span class="text-gray-600">(+62) {{ $pesanan->user->phone }}</span></p>
          <p class="text-gray-700">{{ $pesanan->user->alamat }}, {{ $pesanan->user->kecamatan }} {{ $pesanan->user->kabupatenkota }} {{ $pesanan->user->provinsi }} {{ $pesanan->user->kodepos }}</p>
        </div>

        <div class="ml-auto">
          <a href="{{ route('alamat.edit') }}" class="text-xs bg-purple-200 text-purple-800 px-2 py-1 rounded-full hover:bg-purple-300 flex items-center">
            Ubah Alamat
            <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </a>
        </div>
      </div>
    </div>

    {{-- Produk Bibit --}}
    @foreach ($pesanan->detailPesanan as $detail)
    <div class="flex items-center gap-4 mt-6 bg-gray-50 p-4 rounded-md shadow-sm">
      <img src="{{ $detail->bibit->foto_bibit ? asset('storage/' . $detail->bibit->foto_bibit) : asset('images/bibit-default.png') }}" alt="{{ $detail->bibit->judul_bibit }}" class="w-20 h-20 object-cover rounded-lg" />
      <div>
        <p class="text-base font-semibold">{{ $detail->bibit->judul_bibit }}</p>
        <p class="text-purple-700 font-semibold">Rp{{ number_format($detail->bibit->harga_bibit, 0, ',', '.') }}</p>
      </div>
      <div class="ml-auto">
        <p class="text-gray-600">{{ $detail->jumlah }} x</p>
      </div>
    </div>
    @endforeach

    {{-- Rincian Pembayaran --}}
    <div class="bg-gray-100 p-4 mt-6 rounded-md text-sm">
      <h3 class="text-base font-semibold mb-2">Rincian Pembayaran</h3>
      <div class="flex justify-between mb-1">
        <span>Subtotal Produk</span>
        <span>Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
      </div>
    <div class="flex justify-between mb-1">
        <span>Subtotal Pengiriman</span>
        <span>Rp{{ number_format($pesanan->ongkir, 0, ',', '.') }}</span>
    </div>
      <div class="flex justify-between font-semibold mt-2 border-t pt-2">
        <span>Total Pembayaran</span>
        <span>Rp{{ number_format(($pesanan->total_harga + ($pesanan->ongkir ?? 0)), 0, ',', '.') }}</span>
      </div>
    </div>

    {{-- Tombol --}}
    <div class="flex justify-end space-x-4 mt-6">
      <a href="{{ route('produk', ['id' => $pesanan->id]) }}" class="border border-gray-400 px-4 py-2 rounded-md hover:bg-gray-200">Batal</a>
        <button
            id="pay-button"
            class="bg-purple-800 text-white px-6 py-2 rounded-md hover:bg-purple-700">
            Bayar
        </button>
    </div>
  </section>
</main>
@endsection

@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('{{ $pesanan->snap_token }}', {
                onSuccess: function(result){
                    console.log("Pembayaran berhasil:", result);

                    window.location.href = "{{ route('riwayat') }}";
                },
                onPending: function(result){
                    console.log("Pembayaran pending:", result);
                },
                onError: function(result){
                    console.log("Terjadi error saat pembayaran:", result);
                }
            });
        };
    </script>
@endsection

