<?php

namespace App\Http\Controllers;
use App\Models\Bibit;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;

class C_Belanja extends Controller
{
    public function belanja()
    {
        $produk = Bibit::all();

        return view('admin.V_Belanja', compact('produk')); // pastikan nama view sesuai dengan yang ada di folder resources/views/admin
    }

    public function create()
    {
        return view('admin.V_UnggahProduk'); // buat file blade untuk form upload bibit
    }

    public function unggah(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:120',
            'deskripsi' => 'required|string|max:540',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'file_konten' => 'nullable|image|max:10240',
        ]);

        $fotoPath = null;
        if ($request->hasFile('file_konten')) {
            $fotoPath = $request->file('file_konten')->store('bibits', 'public');
        }

        Bibit::create([
            'judul_bibit' => $validated['judul'],
            'deskripsi_bibit' => $validated['deskripsi'],
            'jumlah_bibit' => $validated['jumlah'],
            'harga_bibit' => $validated['harga'],
            'foto_bibit' => $fotoPath,
        ]);

        return redirect()->route('produk')->with('success', 'Bibit berhasil diunggah!');
    }

    public function show($id)
    {
    $produk = Bibit::findOrFail($id); // pastikan model `Produk` sesuai
    return view('admin.V_DetailBelanja', compact('produk'));
    }

    public function edit($id)
    {
    $produk = Bibit::findOrFail($id);
    return view('admin.V_UbahBelanja', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Bibit::findOrFail($id);

        $request->validate([
            'judul' => 'required|max:120',
            'deskripsi' => 'required|max:540',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'file_konten' => 'nullable|image|max:2048',
        ]);

        $produk->judul_bibit = $request->judul;
        $produk->deskripsi_bibit = $request->deskripsi;
        $produk->jumlah_bibit = $request->jumlah;
        $produk->harga_bibit = $request->harga;

        if ($request->hasFile('file_konten')) {
            if ($produk->foto_bibit && \Storage::disk('public')->exists($produk->foto_bibit)) {
                \Storage::disk('public')->delete($produk->foto_bibit);
            }

            $produk->foto_bibit = $request->file('file_konten')->store('produk', 'public');
        }

        $produk->save();

        // UBAH INI: redirect ke detail belanja dengan ID produk yang baru saja diupdate
        return redirect()->route('belanja.detail', $produk->id)->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
    $produk = Bibit::findOrFail($id);

    if ($produk->foto && file_exists(public_path('storage/' . $produk->foto_bibit))) {
        unlink(public_path('storage/' . $produk->foto_bibit));
    }

    $produk->delete();
    return redirect()->route('produk')->with('success', 'Produk berhasil dihapus.');
    }


    public function checkout(Request $request)
    {
        $cartData = json_decode($request->cartItems, true);

        $totalHarga = collect($cartData)->sum(fn($item) => $item['price'] * $item['qty']);
        $ongkosKirim = 10000;  // Ongkos kirim tetap Rp10.000

        $totalBayar = $totalHarga + $ongkosKirim;

        $pesanan = Pesanan::create([
            'user_id' => auth()->id(),
            'total_harga' => $totalHarga,
            'status' => 'Menunggu Terbayarkan',
            'ongkir' => $ongkosKirim,
        ]);

        // Set konfigurasi Midtrans
        $config = config('midtrans');
        \Midtrans\Config::$serverKey = $config['server_key'];
        \Midtrans\Config::$isProduction = $config['is_production'];
        \Midtrans\Config::$isSanitized = $config['is_sanitized'];
        \Midtrans\Config::$is3ds = $config['is_3ds'];

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . rand(1000, 9999),
                'gross_amount' => $totalBayar,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $pesanan->snap_token = $snapToken;
        $pesanan->save();

        foreach ($cartData as $item) {
            DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'bibit_id' => $item['id'],
                'jumlah' => $item['qty'],
                'harga_satuan' => $item['price'],
                'nama_produk' => $item['name'],
                'gambar_produk' => $item['image'] ?? null,
            ]);
        }

        return redirect()->route('belanja.detailpesanan', $pesanan->id);
    }

    public function showDetailPesanan($id)
    {
        $pesanan = Pesanan::with(['user', 'detailPesanan.bibit'])->findOrFail($id);
        return view('admin.V_PesananPelanggan', compact('pesanan'));
    }

}
