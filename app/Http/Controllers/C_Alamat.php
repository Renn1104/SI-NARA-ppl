<?php

namespace App\Http\Controllers;
use App\Models\Alamat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class C_Alamat extends Controller
{
    public function edit()
    {
        $user = Auth::user(); // ambil data pelanggan yang sedang login
        return view('admin.V_UbahAlamat', compact('user'));
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

        $user = auth()->user(); // Pastikan user login

        $user->update([
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kabupatenkota' => $request->kabupatenkota,
            'kecamatan' => $request->kecamatan,
            'kodepos' => $request->kodepos,
        ]);

        return redirect()->route('produk')->with('success', 'Alamat berhasil diperbarui!');
    }
}
