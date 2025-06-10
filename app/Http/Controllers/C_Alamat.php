<?php

namespace App\Http\Controllers;
use App\Models\Alamat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class C_Alamat extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        $pesanan = \App\Models\Pesanan::where('user_id', $user->id)->latest()->first();

        return view('admin.V_UbahAlamat', compact('user', 'pesanan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupatenkota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kodepos' => 'required|string|max:10',
        ]);

        $user = auth()->user(); 

        $user->update([
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kabupatenkota' => $request->kabupatenkota,
            'kecamatan' => $request->kecamatan,
            'kodepos' => $request->kodepos,
        ]);

        return redirect()->route('belanja.detailpesanan', ['id' => $request->pesanan_id])
                 ->with('success', 'Alamat berhasil diperbarui!');

    }
}
