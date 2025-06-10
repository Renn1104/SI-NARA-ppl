<?php

namespace App\Http\Controllers;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class C_Riwayat extends Controller
{
    public function index()
    {
        $userRole = auth()->user()->role;

        if ($userRole === 'admin') {
            $pesanans = Pesanan::with(['user', 'detailPesanan.bibit'])
                ->orderBy('created_at', 'desc')
                ->get();

            return view('admin.V_RiwayatBelanja', compact('pesanans'));
        } elseif ($userRole === 'pelanggan') {

            $allPesanans = Pesanan::with(['detailPesanan.bibit'])
                ->where('user_id', auth()->id())
                ->get();

            \Log::info('Total pesanan user: ' . $allPesanans->count());
            foreach($allPesanans as $p) {
                \Log::info("Pesanan ID: {$p->id}, Status: '{$p->status}', Created: {$p->created_at}");
            }

            $pesanans = Pesanan::with(['detailPesanan.bibit'])
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get();

            // NANTI: Ganti dengan filter yang benar setelah kita tahu status yang tepat
            // ->where('status', '!=', 'Menunggu Terbayakan')

            return view('pelanggan.V_RiwayatBelanja', compact('pesanans'));
        } else {
            abort(403, 'Akses ditolak.');
        }
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['user', 'detailPesanan.bibit'])->findOrFail($id);
        $userRole = auth()->user()->role;

        if ($userRole === 'admin') {
            return view('admin.V_DetailRiwayatBelanja', compact('pesanan'));
        } elseif ($userRole === 'pelanggan') {
            return view('pelanggan.V_DetailRiwayatBelanja', compact('pesanan'));
        }
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
