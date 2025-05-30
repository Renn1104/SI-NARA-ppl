<?php

namespace App\Http\Controllers;
use App\Models\Bibit;
use App\Models\Produk;
use Illuminate\Http\Request;

class C_Belanja extends Controller
{
    public function belanja()
    {
        $produk = Bibit::all();

        return view('admin.V_Belanja', compact('produk'));
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
        $produk->foto_bibit = $request->file('file_konten')->store('produk', 'public');
    }

    $produk->save();

    return redirect()->route('produk')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
    $produk = Bibit::findOrFail($id);

    // Hapus gambar jika perlu
    if ($produk->foto && file_exists(public_path('storage/' . $produk->foto))) {
        unlink(public_path('storage/' . $produk->foto));
    }

    $produk->delete();

    return redirect()->route('produk')->with('success', 'Produk berhasil dihapus.');
    }

}
