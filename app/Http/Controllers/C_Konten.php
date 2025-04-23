<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Konten;

class C_Konten extends Controller
{

        public function index()
        {
            // Data dummy
            $items = [
                ['img' => 'assets/Konten1.png', 'title' => 'Panen Anggur Hitam'],
                ['img' => 'assets/Konten2.png', 'title' => 'Tari Tradisional'],
                ['img' => 'assets/Konten3.png', 'title' => 'Tari Suwun'],
                ['img' => 'assets/Konten4.png', 'title' => 'Panen Anggur Hijau'],
                ['img' => 'assets/Konten5.png', 'title' => 'Tari Gandrung'],
                ['img' => 'assets/Konten6.png', 'title' => 'Hijau Lestari'],
            ];
    
            // Mengirim data ke view
            return view('admin.konten.index', compact('items'));
        }
}

    // Menampilkan daftar konten
    
    // public function konten()
    // {
    //     return view('admin.V_Konten');
    // }



    // public function index()
    // {
    //     try {
    //         $data = Konten::latest()->get(); // Ambil semua konten, urut terbaru
    //         return view('admin.konten.index', compact('data'));
    //     } catch (\Exception $e) {
    //         Log::error('Error in index method', ['message' => $e->getMessage()]);
    //         return back()->withErrors(['error' => 'Gagal menampilkan data konten.']);
    //     }
    // }    


    // Menyimpan konten baru
//     public function store(Request $request)
//     {
//         try {
//             Log::info('Start store method', ['request' => $request->all()]);
    
//             $validated = $request->validate([
//                 'judul_konten' => 'required|string|max:255',
//                 'deskripsi_konten' => 'required|string',
//                 'file_konten' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
//                 'tanggal' => 'required|date',
//                 'jam' => 'required',
//             ]);
    
//             Log::info('Validation passed', ['validated' => $validated]);
    
//             $data = $request->all();
//             $data['tanggal_unggah'] = $request->tanggal . ' ' . $request->jam;
//             unset($data['tanggal'], $data['jam']);
    
//             if ($request->hasFile('file_konten')) {
//                 $data['file_konten'] = $request->file('file_konten')->store('konten', 'public');
//                 Log::info('File uploaded', ['file_path' => $data['file_konten']]);
//             }
    
//             $konten = Konten::create($data);
//             Log::info('Data saved to DB', ['konten' => $konten]);
    
//             return redirect()->route('V_Konten')->with('success', 'Konten berhasil ditambahkan');
//         } catch (\Exception $e) {
//             Log::error('Error in store method', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
//             return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
//         }    
//     }
// }

