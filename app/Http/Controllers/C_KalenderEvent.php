<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KalenderEvent;
use Carbon\Carbon;

class C_KalenderEvent extends Controller
{
    public function create()
    {
        return view('admin.V_Tambahkalenderevent');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_konten' => 'nullable|max:120',
            'deskripsi_konten' => 'nullable',
            'file_konten' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240', // max 10MB
            'tanggal' => 'nullable|date',
            'jam' => 'nullable',
        ]);

        $filePath = null;
        if ($request->hasFile('file_konten')) {
            $filePath = $request->file('file_konten')->store('kalenderevent_covers', 'public');
        }

        KalenderEvent::create([
            'judul_event' => $request->judul_konten,
            'deskripsi_event' => $request->deskripsi_konten,
            'file_event' => $filePath,
            'tanggal_event' => $request->tanggal,
            'waktu_event' => $request->jam,
        ]);

        return redirect()->route('kalenderevent');
    }
    public function index(Request $request)
{
    // Default bulan dan tahun sekarang
    $month = $request->get('month', date('m'));
    $year = $request->get('year', date('Y'));

    // Ambil event sesuai bulan dan tahun filter
    $kalender = KalenderEvent::whereYear('tanggal_event', $year)
                ->whereMonth('tanggal_event', $month)
                ->get();

    // Untuk dropdown tahun, ambil range tahun dinamis dari data, atau fixed
    $years = KalenderEvent::selectRaw('YEAR(tanggal_event) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')->toArray();

    // Kalau kosong, bisa kasih default tahun sekarang
    if (empty($years)) {
        $years = [date('Y')];
    }

    return view('admin.V_KalenderEvent', [
        'kalender' => $kalender,
        'month' => $month,
        'year' => $year,
        'years' => $years,
        'role' => session('role', 'guest')
    ]);
}
public function edit($id)
{
    $event = KalenderEvent::findOrFail($id); // ambil data event berdasarkan id
    return view('admin.V_UbahKalenderEvent', [
        'event' => $event,
        'id' => $event->id,
        'judul' => $event->judul_event,
        'tanggal' => $event->tanggal_event,
        'jam' => $event->waktu_event,
        'deskripsiKonten' => $event->deskripsi_event,
        'fileKonten' => $event->file_event,
]);

}

public function update(Request $request, $id)
{
    $request->validate([
        'judul_konten' => 'nullable|max:120',
        'deskripsi_konten' => 'nullable',
        'file_konten' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240', // max 10MB
        'tanggal' => 'nullable|date',
        'jam' => 'nullable',
    ]);

    $event = KalenderEvent::findOrFail($id);

    // Jika ada file baru, simpan dan hapus file lama jika ada
    if ($request->hasFile('file_konten')) {
        // Hapus file lama dari storage jika ada
        if ($event->file_event && \Storage::disk('public')->exists($event->file_event)) {
            \Storage::disk('public')->delete($event->file_event);
        }
        $filePath = $request->file('file_konten')->store('kalenderevent_covers', 'public');
        $event->file_event = $filePath;
    }

    $event->judul_event = $request->judul_konten;
    $event->deskripsi_event = $request->deskripsi_konten;
    $event->tanggal_event = $request->tanggal;
    $event->waktu_event = $request->jam;

    $event->save();

    return redirect()->route('kalenderevent')->with('success', 'Event berhasil diupdate.');
}


}


