@extends('layouts.layouts')

@section('title', 'Riwayat Belanja')

@section('content')

<main class="flex-grow p-4">
  <div class="max-w-3xl mx-auto">
    <h2 class="bg-purple-700 text-white text-center py-2 rounded-md font-semibold">
      Daftar Riwayat Pesanan
    </h2>

    {{-- Jika tidak ada pesanan --}}
    @if ($pesanans->isEmpty())
      <p class="text-center text-gray-500 mt-6">Belum ada riwayat pesanan.</p>
    @endif

    @foreach ($pesanans as $pesanan)
    @if ($pesanan->user && $pesanan->detailPesanan->isNotEmpty())
        <div class="bg-white mt-4 rounded-md shadow-md p-4">
        <p class="text-sm text-bold-gray-600 mb-2">{{ $pesanan->user->namalengkap }}</p>

        @foreach ($pesanan->detailPesanan as $detail)
            <div class="flex items-center gap-4 border-b pb-3 mb-3 last:border-0 last:pb-0 last:mb-0">
             <img src="{{ $detail->bibit && $detail->bibit->foto_bibit ? asset('storage/' . $detail->bibit->foto_bibit) : asset('images/bibit-default.png') }}"
                alt="{{ $detail->bibit->judul_bibit ?? '-' }}"
                class="w-24 h-24 object-cover rounded-md" />

            <div class="flex-1">
                <h3 class="text-lg font-semibold">{{ $detail->nama_produk }}</h3>
                <p class="font-bold text-gray-800">Rp.{{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">{{ $detail->jumlah }} x</p>
            </div>
            </div>
        @endforeach

        <div class="text-right mt-4">
            <a href="{{ route('riwayat.detail', ['id' => $pesanan->id]) }}"
            class="px-4 py-1 border border-purple-700 text-purple-700 rounded hover:bg-purple-100 text-sm">
            Lihat Detail Pesanan
            </a>
        </div>
        </div>
    @endif
    @endforeach

  </div>
</main>

@endsection
