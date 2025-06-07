<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Bibit;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        // Validasi Signature dari Midtrans
        $serverKey = config('midtrans.server_key');
        $expectedSignature = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if ($expectedSignature !== $request->signature_key) {
            return response()->json(['message' => 'Signature tidak valid'], 403);
        }

        // Cari pesanan berdasarkan kode
        $pesanan = Pesanan::with('detailPesanan.bibit')->where('kode_pesanan', $request->order_id)->first();

        if (!$pesanan) {
            return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
        }

        // Jika pembayaran sukses
        if (in_array($request->transaction_status, ['settlement', 'capture'])) {
            if ($pesanan->status !== 'dibayar') {
                $pesanan->status = 'dibayar';
                $pesanan->save();

                // Kurangi stok bibit
                foreach ($pesanan->detailPesanan as $detail) {
                    $detail->bibit->decrement('jumlah_bibit', $detail->jumlah);
                }
            }
        }

        return response()->json(['message' => 'Berhasil diproses'], 200);
    }
}
