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
            'judul_event' => 'required|max:120',
            'deskripsi_event' => 'required',
            'file_event' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240', // max 10MB
            'tanggal_event' => 'required|date',
            'waktu_event' => 'required',
        ]);

        $filePath = null;
        if ($request->hasFile('file_event')) {
            $filePath = $request->file('file_event')->store('kalenderevent_covers', 'public');
        }

        KalenderEvent::create([
            'judul_event' => $request->judul_event,
            'deskripsi_event' => $request->deskripsi_event,
            'file_event' => $filePath,
            'tanggal_event' => $request->tanggal_event,
            'waktu_event' => $request->waktu_event,
        ]);

        return redirect()->route('kalenderevent.index')->with('success', 'Event berhasil ditambahkan.');
    }

    public function index()
    {
        $year = 2024;
        $month = 7;

        $eventsRaw = KalenderEvent::whereYear('tanggal_event', $year)
                            ->whereMonth('tanggal_event', $month)
                            ->get();

        $events = collect();
        foreach ($eventsRaw as $event) {
            $day = Carbon::parse($event->tanggal_event)->day;
            $events->put($day, $events->get($day, collect())->push($event));
        }

        return view('admin.V_KalenderEvent', [
            'events' => $events,
            'year' => $year,
            'month' => $month,
        ]);
    }
}
