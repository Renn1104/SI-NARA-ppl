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
            Carbon::setLocale('id'); // ⬅️ Tambahkan ini

            $data = Konten::paginate(9);
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
            'tanggal_unggah' => Carbon::now()->format('Y-m-d H:i:s'), // otomatis pakai waktu sekarang
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

    if ($request->hasFile('file_konten')) {
        if ($konten->file_konten && Storage::disk('public')->exists('kontens/' . $konten->file_konten)) {
            Storage::disk('public')->delete('kontens/' . $konten->file_konten);
        }
        $file = $request->file('file_konten');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/kontens', $filename);

        $konten->file_konten = $filename;
    }

    $konten->save();

     return redirect()->back()->with('success', 'Perubahan berhasil disimpan');
    }

    public function show($id)
    {
        $konten = Konten::findOrFail($id);

        return view('admin.V_DetailKonten', [
            'judul' => $konten->judul_konten,
            'deskripsiKonten' => $konten->deskripsi_konten,
            'fileKonten' => $konten->file_konten,
            'tanggalUnggah' => $konten->tanggal_unggah,  // <-- ini yang harus kamu kirim!
            'id' => $konten->id,
        ]);
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
