<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Konten;
use Carbon\Carbon;


class C_Konten extends Controller
{

    public function index()
    {
        try {

            // Ambil semua konten, urut terbaru
            $data = Konten::all();

            return view('admin.V_Konten', compact('data'));
        } catch (\Exception $e) {
            Log::error('Error in index method', ['message' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Gagal menampilkan data konten.']);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_konten' => 'required|string|max:255',
            'deskripsi_konten' => 'required|string',
            'file_konten' => 'nullable|file|mimes:jpg,jpeg,png',
            'tanggal' => 'required|date',
            'jam' => 'required',
        ]);

        $fileName = null;

        if ($request->hasFile('file_konten')) {
            $file = $request->file('file_konten');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/kontens', $fileName);
        }

        Konten::create([
            'judul_konten' => $request->input('judul_konten'),
            'deskripsi_konten' => $request->input('deskripsi_konten'),
            'file_konten' => $fileName,
            'update_at' => $request->input('tanggal'),
            'jam' => $request->input('jam'),
            'rememberToken'=>'uiiuiui',
            'tanggal_unggah'=> now()
        ]);

        return redirect()->route('konten.create')->with('success', 'Konten berhasil diunggah');

    }

    public function edit($id)
    {
        $konten = Konten::findOrFail($id);
        return view('admin.V_UbahKonten', compact('konten'));
    }

    public function update(Request $request, $id)
    {
    $konten = Konten::findOrFail($id);

    $request->validate([
        'judul_konten' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'jam' => 'required',
        'deskripsi_konten' => 'required|string',
        'file_konten' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240', // max 10MB
    ]);

    $konten->judul_konten = $request->judul_konten;
    $konten->tanggal_unggah = $request->tanggal . ' ' . $request->jam;
    $konten->deskripsi_konten = $request->deskripsi_konten;

    // 🔁 Cek apakah ada file baru
    if ($request->hasFile('file_konten')) {
        // Hapus file lama jika ada
        if ($konten->file_konten && Storage::disk('public')->exists('kontens/' . $konten->file_konten)) {
            Storage::disk('public')->delete('kontens/' . $konten->file_konten);
        }

        // Simpan file baru
        $file = $request->file('file_konten');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/kontens', $filename);

        $konten->file_konten = $filename;
    }

    $konten->save();

     return redirect()->back()->with('success', 'Perubahan berhasil disimpan');
    }

    public function destroy($id)
    {
    $konten = Konten::findOrFail($id);

    // Hapus file jika ada
    if ($konten->file_konten && file_exists(public_path('kontens/' . $konten->file_konten))) {
        unlink(public_path('kontens/' . $konten->file_konten));
    }

    $konten->delete();

    return redirect()
       ->route('konten', $id)   // ATAU route mana pun tempat toast berada
       ->with('success', 'Konten berhasil dihapus');


    }

}
