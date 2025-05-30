@extends('layouts.layouts')
@section('title', 'KalenderEvent')
@section('content')

@auth
@if(Auth::user()->role === 'admin')
  <div class="flex justify-end mt-6 px-6">
    <a href="{{ route('kalenderevent.create') }}"
           class="flex items-center space-x-2 bg-purple-800 text-white px-4 py-2 rounded-full shadow hover:bg-purple-700 transition">
            <span class="text-sm md:text-base font-medium">Tambah Kalender Event</span>
            <span class="text-lg">＋</span>
        </a>
  </div>
@endif
@endauth

<!-- Filter -->
<div class="px-6 mt-4 hidden" id="filterFormWrapper">
  <form id="filterForm" method="GET" action="{{ route('kalenderevent') }}"
    class="flex flex-wrap items-center gap-4 bg-gray-50 p-4 rounded-lg shadow">
    <select name="month" class="border rounded px-3 py-2 text-sm" onchange="this.form.submit()">
      @foreach([
          '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
          '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
          '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
      ] as $num => $name)
        <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $name }}</option>
      @endforeach
    </select>

    <select name="year" class="border rounded px-3 py-2 text-sm" onchange="this.form.submit()">
      @for ($y = 2025; $y <= 2030; $y++)
        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
      @endfor
    </select>

    <button type="submit" class="bg-purple-700 hover:bg-purple-600 text-white px-4 py-2 rounded-md text-sm">Tampilkan</button>
  </form>
</div>

<!-- Layout Utama -->
<div class="grid md:grid-cols-3 gap-6 p-6 max-w-7xl mx-auto mt-6 max-h-screen">

  <!-- Kalender -->
  <div class="md:col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
    <div class="flex items-center justify-between bg-purple-600 text-white px-5 py-4">
      <h2 class="text-lg font-semibold">{{ \Carbon\Carbon::create($year, $month)->translatedFormat('F Y') }}</h2>
      <button id="toggleFilterBtn" class="text-xl hover:scale-110 transition">📅</button>
    </div>

    <!-- Hari -->
    <div class="grid grid-cols-7 text-center text-sm font-medium text-gray-600 bg-gray-100 py-3 border-b">
      <div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div><div>Min</div>
    </div>

    <!-- Tanggal -->
    <div class="grid grid-cols-7 gap-y-5 text-sm px-4 py-6">
      @php
        $startDay = \Carbon\Carbon::create($year, $month, 1)->dayOfWeekIso;
        $daysInMonth = \Carbon\Carbon::create($year, $month)->daysInMonth;
      @endphp

      @for ($empty = 1; $empty < $startDay; $empty++)
        <div></div>
      @endfor

      @for ($day = 1; $day <= $daysInMonth; $day++)
        @php
          $dateStr = \Carbon\Carbon::create($year, $month, $day)->format('Y-m-d');
          $eventsOnDate = $kalender->where('tanggal_event', $dateStr);
          $hasEvent = $eventsOnDate->count() > 0;
          $firstEvent = $hasEvent ? $eventsOnDate->first() : null;
        @endphp

        <div
          class="relative group cursor-pointer rounded-full w-10 h-10 mx-auto flex items-center justify-center
            {{ $hasEvent ? 'bg-purple-100 text-purple-800 font-semibold hover:bg-purple-200' : 'text-gray-700 hover:bg-gray-200' }}
            transition duration-200 ease-in-out"
          data-event='@json($firstEvent)'
        >
          {{ $day }}
          @if($hasEvent)
            <div class="w-2 h-2 bg-purple-700 rounded-full absolute bottom-1 left-1/2 -translate-x-1/2"></div>
          @endif
        </div>
      @endfor
    </div>
  </div>

  <!-- Detail Event -->
  <div id="eventDetail" class="bg-white rounded-lg shadow-md p-5 sticky top-24 h-fit">
    <p class="text-gray-500 italic text-sm text-center">Klik tanggal bertitik untuk melihat detail event</p>
  </div>
</div>

<!-- Script -->
<script>
  const userRole = @json(Auth::check() ? Auth::user()->role : 'guest');

  // Toggle Filter
  document.getElementById('toggleFilterBtn').addEventListener('click', function () {
    document.getElementById('filterFormWrapper').classList.toggle('hidden');
  });

  // Klik kalender
  document.querySelectorAll('.grid > div[data-event]').forEach(div => {
    div.addEventListener('click', () => {
      const data = div.getAttribute('data-event');
      const panel = document.getElementById('eventDetail');

      if (!data || data === 'null') {
        panel.innerHTML = '<p class="text-gray-500 italic text-sm text-center">Tidak ada event di tanggal ini.</p>';
        return;
      }

        const e = JSON.parse(data);
        const tgl = new Date(e.tanggal_event);
        const formattedDate = tgl.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });

        panel.innerHTML = `
        <img src="/storage/${e.file_event ?? 'https://via.placeholder.com/400x250?text=No+Image'}"
            alt="Poster Event"
            class="w-full h-auto rounded-md object-cover mb-4 shadow-sm" />

        <h3 class="text-center font-semibold text-lg mb-2">${e.judul_event}</h3>

        <p class="text-justify text-gray-700 mb-4 leading-relaxed">${e.deskripsi_event}</p>

        <div class="text-sm space-y-2 mb-4 text-center">
            <div class="flex items-center justify-center gap-2">
            <span class="text-lg">📅</span>
            <span>${formattedDate}</span>
            </div>
            <div class="flex items-center justify-center gap-2">
            <span class="text-lg">⏰</span>
            <span>${e.waktu_event}</span>
            </div>
        </div>

        ${userRole === 'admin' ? `
            <div class="flex justify-center">
            <a href="/kalenderevent/${e.id}/edit" title="Edit">
                <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full shadow-md flex items-center gap-2 text-sm">
                ✏️ <span></span>
                </button>
            </a>
            </div>` : ''}
        `;
    });
  });
</script>

@endsection
