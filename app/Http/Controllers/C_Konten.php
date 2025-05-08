<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Konten;

class C_Konten extends Controller
{

    // public function konten()
    // {
    //     return view('admin.V_Konten');
    // }

    // Menampilkan daftar konten dari database
 
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
    
    // Menyimpan konten baru
    // public function store(Request $request)
    // {
    //     try {
    //         Log::info('Start store method', ['request' => $request->all()]);

    //         $validated = $request->validate([
    //             'judul_konten' => 'required|string|max:255',
    //             'deskripsi_konten' => 'required|string',
    //             'file_konten' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
    //             'tanggal' => 'required|date',
    //             'jam' => 'required',
    //         ]);

    //         Log::info('Validation passed', ['validated' => $validated]);

    //         $data = $request->all();
    //         $data['tanggal_unggah'] = $request->tanggal . ' ' . $request->jam;
    //         unset($data['tanggal'], $data['jam']);

    //         if ($request->hasFile('file_konten')) {
    //             $data['file_konten'] = $request->file('file_konten')->store('konten', 'public');
    //             Log::info('File uploaded', ['file_path' => $data['file_konten']]);
    //         }

    //         $konten = Konten::create($data);
    //         Log::info('Data saved to DB', ['konten' => $konten]);

    //         return redirect()->route('konten')->with('success', 'Konten berhasil ditambahkan');
    //     } catch (\Exception $e) {
    //         Log::error('Error in store method', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
    //         return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
    //     }
    // }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_konten' => 'required|string|max:255',
            'deskripsi_konten' => 'required|string',
            'file_konten' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
            'tanggal' => 'required|date',
            'jam' => 'required',
        ]);
    
        $fileName = null;
    
        if ($request->hasFile('file_konten')) {
            $file = $request->file('file_konten');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('kontens'), $fileName);
        }
    
        Konten::create([
            'judul_konten' => $request->input('judul_konten'),
            'deskripsi_konten' => $request->input('deskripsi_konten'),
            'file_konten' => $fileName,
            'update_at' => $request->input('tanggal'),
            'jam' => $request->input('jam'),
            'rememberToken'=>'uiiuiui',
        ]);
    
        return redirect()->route('konten')->with('success', 'Konten berhasil ditambahkan.');
        
    }
    public function edit($id)
    {
        $konten = Konten::findOrFail($id);

        return view('admin.V_UbahKonten', [
            'judul' => $konten->judul,
            'deskripsiKonten' => $konten->deskripsi_konten,
            'fileKonten' => $konten->file_konten,
            'id' => $konten->id,
        ]);
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'judul_konten' => 'required|max:120',
        'tanggal' => 'required|date',
        'jam' => 'required',
        'deskripsi_konten' => 'required',
        'file_konten' => 'nullable|file|mimes:png,jpg,jpeg,gif|max:10240', // 10MB
    ]);

    $konten = Konten::findOrFail($id);
    $konten->judul_konten = $request->judul_konten;
    $konten->tanggal = $request->tanggal;
    $konten->jam = $request->jam;
    $konten->deskripsi_konten = $request->deskripsi_konten;

    // Cek apakah ada file yang di-upload
    if ($request->hasFile('file_konten')) {
        // Hapus file lama jika ada
        if ($konten->file_konten && Storage::exists('public/konten/' . $konten->file_konten)) {
            Storage::delete('public/konten/' . $konten->file_konten);
        }

        // Simpan file baru
        $file = $request->file('file_konten');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/konten', $filename);

        $konten->file_konten = $filename;
    }

    $konten->save();

    return redirect()->route('konten.index')->with('success', 'Konten berhasil diperbarui.');
}
}
