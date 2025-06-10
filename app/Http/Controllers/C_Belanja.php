<?php

namespace App\Http\Controllers;
use App\Models\Bibit;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class C_Belanja extends Controller
{
    public function belanja()
    {
        $produk = Bibit::all();
        return view('admin.V_Belanja', compact('produk'));
    }

    public function create()
    {
        return view('admin.V_UnggahProduk');
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
        $produk = Bibit::findOrFail($id);
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

        $validated = $request->validate([
            'judul' => 'required|string|max:120',
            'deskripsi' => 'required|string|max:540',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'file_konten' => 'nullable|image|max:2048',
        ]);

        // Update data produk
        $produk->judul_bibit = $validated['judul'];
        $produk->deskripsi_bibit = $validated['deskripsi'];
        $produk->jumlah_bibit = $validated['jumlah'];
        $produk->harga_bibit = $validated['harga'];

        if ($request->hasFile('file_konten')) {
            if ($produk->foto_bibit && Storage::disk('public')->exists($produk->foto_bibit)) {
                Storage::disk('public')->delete($produk->foto_bibit);
            }
            $produk->foto_bibit = $request->file('file_konten')->store('bibits', 'public');
        }

        $produk->save();
        return redirect()->route('belanja.detail', $produk->id)
                        ->with('success', 'Bibit berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk = Bibit::findOrFail($id);

        if ($produk->foto_bibit && Storage::disk('public')->exists($produk->foto_bibit)) {
            Storage::disk('public')->delete($produk->foto_bibit);
        }

        $produk->delete();
        return redirect()->route('produk')->with('success', 'Produk berhasil dihapus.');
    }

    public function checkout(Request $request)
    {
        $cartData = json_decode($request->cartItems, true);
        $user = auth()->user();
        $provinsi = $user->provinsi;

        $ongkosKirim = $this->hitungOngkir($provinsi);
        $totalHarga = collect($cartData)->sum(fn($item) => $item['price'] * $item['qty']);
        $totalBayar = $totalHarga + $ongkosKirim;

    $pesanan = Pesanan::create([
        'user_id' => $user->id,
        'total_harga' => $totalHarga,
        'status' => 'Menunggu Pembayaran', // ✅ Benar
        'ongkir' => $ongkosKirim,
    ]);
        // Midtrans
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
                'first_name' => $user->name,
                'email' => $user->email,
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

            $bibit = Bibit::find($item['id']);
            if ($bibit) {
                $bibit->jumlah_bibit -= $item['qty'];
                $bibit->save();
            }
        }

        return redirect()->route('belanja.detailpesanan', $pesanan->id);
    }

    public function showDetailPesanan($id)
    {
        $pesanan = Pesanan::with(['user', 'detailPesanan.bibit'])->findOrFail($id);
        return view('admin.V_PesananPelanggan', compact('pesanan'));
    }

    public function updateAlamat(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupatenkota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kodepos' => 'required|string|max:10',
            'pesanan_id' => 'required|exists:pesanan,id',
        ]);

        $user = auth()->user();

        $user->update([
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kabupatenkota' => $request->kabupatenkota,
            'kecamatan' => $request->kecamatan,
            'kodepos' => $request->kodepos,
        ]);

        $ongkirBaru = $this->hitungOngkir($request->provinsi);
        $pesanan = Pesanan::find($request->pesanan_id);

        if ($pesanan) {
            $pesanan->ongkir = $ongkirBaru;
            $pesanan->save();
        }

        return redirect()->route('belanja.detailpesanan', ['id' => $request->pesanan_id])
                         ->with('success', 'Alamat dan ongkir berhasil diperbarui!');
    }

    private function hitungOngkir($provinsi)
    {
        $provinsi = strtoupper($provinsi);

        return match ($provinsi) {
            'JAWA TIMUR', 'JATIM' => 10000,
            'DI YOGYAKARTA' => 12000,
            'JAWA TENGAH', 'JATENG' => 14000,
            'JAWA BARAT', 'JABAR' => 16000,
            'DKI JAKARTA', 'DKI JKT' => 20000,
            'BANTEN' => 22000,
            default => 10000,
        };
    }
    
    public function pembayaranBerhasil(Request $request)
    {
    $pesanan = Pesanan::with('detailPesanan')->findOrFail($request->pesanan_id);

    if ($pesanan->status === 'Menunggu Pembayaran') {
        foreach ($pesanan->detailPesanan as $detail) {
            $bibit = Bibit::find($detail->bibit_id);
            if ($bibit) {
                $bibit->jumlah_bibit -= $detail->jumlah;
                $bibit->save();
            }
        }

        $pesanan->status = 'Lunas';
        $pesanan->save();
    }

    return response()->json(['message' => 'Stok berhasil dikurangi dan status diperbarui']);
    }

    public function batalkanPesanan($id)
    {
    $pesanan = Pesanan::where('id', $id)
                      ->where('status', 'Menunggu Pembayaran')
                      ->first();

    if ($pesanan) {
        $pesanan->detailPesanan()->delete();
        $pesanan->delete();
    }

    return redirect()->route('produk')->with('success', 'Pesanan dibatalkan.');
    }
}

//     public function midtransCallback(Request $request)
//     {
//     $serverKey = config('midtrans.server_key');
//     $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

//     if ($hashed !== $request->signature_key) {
//         return response()->json(['message' => 'Invalid signature'], 403);
//     }

//     if (in_array($request->transaction_status, ['capture', 'settlement'])) {
//         $orderId = $request->order_id;
//         $cartData = json_decode($request->custom_field1, true);
//         $userId = $request->custom_field2;
//         $provinsi = $request->custom_field3;
//         $ongkir = $this->hitungOngkir($provinsi);
//         $totalHarga = collect($cartData)->sum(fn($item) => $item['price'] * $item['qty']);

//         // Simpan pesanan
//         $pesanan = Pesanan::create([
//             'user_id' => $userId,
//             'total_harga' => $totalHarga,
//             'ongkir' => $ongkir,
//             'status' => 'Terbayarkan',
//             'snap_token' => null,
//         ]);

//         foreach ($cartData as $item) {
//             DetailPesanan::create([
//                 'pesanan_id' => $pesanan->id,
//                 'bibit_id' => $item['id'],
//                 'jumlah' => $item['qty'],
//                 'harga_satuan' => $item['price'],
//                 'nama_produk' => $item['name'],
//                 'gambar_produk' => $item['image'] ?? null,
//             ]);

//             $bibit = Bibit::find($item['id']);
//             if ($bibit) {
//                 $bibit->jumlah_bibit -= $item['qty'];
//                 $bibit->save();
//             }
//         }

//         return response()->json(['message' => 'Pesanan berhasil disimpan.'], 200);
//     }

//     return response()->json(['message' => 'Pembayaran belum selesai.'], 200);
// }
