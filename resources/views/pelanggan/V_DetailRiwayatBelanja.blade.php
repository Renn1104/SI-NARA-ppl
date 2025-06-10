@extends('layouts.layouts')

@section('title', 'Detail Riwayat Belanja')

@section('content')
<main class="p-4 max-w-3xl mx-auto">

    <h2 class="bg-purple-700 text-white text-center py-2 rounded-md font-semibold mb-4">
        Riwayat Pesanan
    </h2>

    {{-- Alamat Pengiriman --}}
    <div class="bg-white p-4 rounded shadow mb-4">
        <h3 class="font-semibold mb-2">Alamat Pengiriman</h3>
        <div class="flex items-start gap-2">
            <i class="fas fa-map-marker-alt text-purple-700 mt-1"></i>
            <div>
                <p class="font-medium">
                    {{ $pesanan->user->namalengkap ?? '-' }}
                    ({{ $pesanan->user->phone ?? '-' }})
                </p>
                <p class="text-sm text-gray-600">
                    {{ $pesanan->user->alamat ?? '-' }},
                    {{ $pesanan->user->kecamatan ?? '-' }},
                    {{ $pesanan->user->kabupatenkota ?? '-' }},
                    {{ $pesanan->user->provinsi ?? '-' }},
                    {{ $pesanan->user->kodepos ?? '-' }}
                </p>
            </div>
        </div>
    </div>

    @foreach ($pesanan->detailPesanan as $item)
        <div class="bg-white p-4 rounded shadow flex items-center gap-4 mb-4">
        <img src="{{ $item->bibit->foto_bibit ? asset('storage/' . $item->bibit->foto_bibit) : asset('images/bibit-default.png') }}"
            alt="{{ $item->bibit->nama_produk }}"
            onerror="this.src='https://via.placeholder.com/100';"
            class="w-24 h-24 object-cover rounded-md">
            <div class="flex-1">
                <h3 class="text-lg font-semibold">{{ $item->nama_produk ?? '-' }}</h3>
                <p class="text-purple-700 font-bold">Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
            </div>
            <p class="text-sm text-gray-500">{{ $item->jumlah ?? 1 }} x</p>
        </div>
    @endforeach

    @php
        $metodeMap = [
            'gopay' => 'GoPay',
            'shopeepay' => 'ShopeePay',
            'bank_transfer' => 'Transfer Bank',
            'bca_va' => 'Transfer Bank BCA',
            'bni_va' => 'Transfer Bank BNI',
            'bri_va' => 'Transfer Bank BRI',
            'permata_va' => 'Transfer Bank Permata',
            'echannel' => 'Mandiri Bill Payment',
            'qris' => 'QRIS',
            'credit_card' => 'Kartu Kredit',
            'cstore' => 'Convenience Store',
        ];

        $metodeMidtrans = strtolower($pesanan->metode_pembayaran ?? '-');
        $paymentDetail = is_array($pesanan->payment_detail)
            ? $pesanan->payment_detail
            : json_decode($pesanan->payment_detail, true);

        $namaMetodePembayaran = $metodeMap[$metodeMidtrans] ?? ucfirst(str_replace('_', ' ', $metodeMidtrans));
    @endphp

    <div class="bg-white p-4 rounded shadow mb-4">
        <h3 class="font-semibold mb-2">Metode Pembayaran</h3>
        <p class="text-orange-500 text-lg font-semibold">
           Midtrans
        </p>

        @if ($metodeMidtrans === 'bank_transfer' && isset($paymentDetail['va_numbers'][0]))
            <p class="text-sm text-gray-500 mt-1">
                Transfer ke <strong>{{ strtoupper($paymentDetail['va_numbers'][0]['bank']) }}</strong><br>
                Nomor VA: <strong>{{ $paymentDetail['va_numbers'][0]['va_number'] }}</strong>
            </p>
        @elseif (in_array($metodeMidtrans, ['bca_va', 'bni_va', 'bri_va', 'permata_va']) && isset($paymentDetail['va_number']))
            <p class="text-sm text-gray-500 mt-1">
                Transfer ke <strong>{{ strtoupper($paymentDetail['bank']) }}</strong><br>
                Nomor VA: <strong>{{ $paymentDetail['va_number'] }}</strong>
            </p>
        @elseif ($metodeMidtrans === 'echannel' && isset($paymentDetail['bill_key']))
            <p class="text-sm text-gray-500 mt-1">
                Bank: <strong>Mandiri</strong><br>
                Bill Key: <strong>{{ $paymentDetail['bill_key'] }}</strong><br>
                Biller Code: <strong>{{ $paymentDetail['biller_code'] }}</strong>
            </p>
        @elseif ($metodeMidtrans === 'qris' && isset($paymentDetail['qr_url']))
            <p class="text-sm text-gray-500 mt-1">QRIS telah digunakan untuk pembayaran ini.</p>
        @elseif ($metodeMidtrans === 'cstore' && isset($paymentDetail['payment_code']))
            <p class="text-sm text-gray-500 mt-1">
                Bayar di <strong>{{ ucfirst($paymentDetail['store']) }}</strong><br>
                Kode Pembayaran: <strong>{{ $paymentDetail['payment_code'] }}</strong>
            </p>
    </div>

    <div class="bg-white p-4 rounded shadow mb-6">
        <h3 class="font-semibold mb-2">Rincian Pembayaran</h3>

        <div class="flex justify-between text-sm mb-1">
            <span>Subtotal Produk</span>
            <span>Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between text-sm mb-1">
            <span>Subtotal Pengiriman</span>
            <span>Rp{{ number_format($pesanan->ongkir ?? 0, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between font-bold text-base mt-2">
            <span>Total Pembayaran</span>
            <span>Rp{{ number_format(($pesanan->total_harga + ($pesanan->ongkir ?? 0)), 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="text-right">
        <a href="{{ route('riwayat') }}"
           class="bg-purple-700 text-white px-4 py-2 rounded hover:bg-purple-800">
            Kembali
        </a>
    </div>

</main>
@endsection
