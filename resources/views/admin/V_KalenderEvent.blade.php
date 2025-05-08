@extends('layouts.layouts')
@section('title', 'KalenderEvent')
@section('content')
  <!-- <--Tombol Tambah Kalender -->
  @php
    // Cek session role, jika null beri default 'guest'
    $role = session('role', 'guest');
@endphp
<div class="text-end mb-3">
  @if($role == 'admin')
    <a href="/kalenderevent/create" class="btn btn-success">Tambah Kalender Event</a>
  @endif
</div>

  <!-- Konten Kalender + Detail Event -->
  <div class="flex flex-col md:flex-row gap-4 p-6 bg-white max-w-7xl mx-auto">

    <!-- Kalender -->
    <div class="w-full md:w-2/3 bg-white rounded-md shadow-md">
      <!-- Header Kalender -->
      <div class="flex items-center justify-between bg-purple-700 text-white px-4 py-3 rounded-t-md">
        <h2 class="text-lg font-semibold">JULI 2024</h2>
        <button class="text-2xl">📅</button>
      </div>

      <!-- Hari -->
      <div class="grid grid-cols-7 text-center text-sm py-2 font-semibold text-gray-700 border-b">
        <div>M</div><div>S</div><div>S</div><div>R</div><div>K</div><div>J</div><div>S</div>
      </div>

      <!-- Tanggal -->
      <div class="grid grid-cols-7 text-center gap-y-4 py-4 text-sm">
        <!-- Minggu 1 -->
        <div class="text-gray-400">1</div><div>2</div><div>3</div><div>4</div><div>5</div><div>6</div><div>7</div>
        <!-- Minggu 2 -->
        <div>8</div>
        <div class="relative">
          <div class="cursor-pointer hover:bg-purple-100 rounded-full w-8 h-8 flex items-center justify-center mx-auto">9</div>
          <div class="w-2 h-2 bg-purple-700 rounded-full absolute bottom-0 left-1/2 -translate-x-1/2"></div>
        </div>
        <div class="relative">
          <div class="cursor-pointer hover:bg-purple-100 rounded-full w-8 h-8 flex items-center justify-center mx-auto">10</div>
          <div class="w-2 h-2 bg-purple-700 rounded-full absolute bottom-0 left-1/2 -translate-x-1/2"></div>
        </div>
        <div>11</div><div>12</div>
        <div class="relative">
          <div class="cursor-pointer hover:bg-purple-100 rounded-full w-8 h-8 flex items-center justify-center mx-auto">13</div>
          <div class="w-2 h-2 bg-purple-700 rounded-full absolute bottom-0 left-1/2 -translate-x-1/2"></div>
        </div>
        <div class="relative">
          <div class="cursor-pointer hover:bg-purple-100 rounded-full w-8 h-8 flex items-center justify-center mx-auto">14</div>
          <div class="w-2 h-2 bg-purple-700 rounded-full absolute bottom-0 left-1/2 -translate-x-1/2"></div>
        </div>
        <!-- Minggu 3 -->
        <div class="cursor-pointer border border-purple-600 bg-purple-100 text-purple-800 font-semibold rounded-full w-8 h-8 flex items-center justify-center mx-auto">15</div>
        <div class="relative">
          <div class="cursor-pointer hover:bg-purple-100 rounded-full w-8 h-8 flex items-center justify-center mx-auto">16</div>
          <div class="w-2 h-2 bg-purple-700 rounded-full absolute bottom-0 left-1/2 -translate-x-1/2"></div>
        </div>
        <div>17</div><div>18</div><div>19</div><div>20</div><div>21</div>
        <!-- Minggu 4 -->
        <div>22</div><div>23</div><div>24</div><div>25</div><div>26</div><div>27</div><div>28</div>
        <!-- Minggu 5 -->
        <div>29</div><div>30</div><div>31</div><div></div><div></div><div></div><div></div>
      </div>

      <!-- Deskripsi Event -->
      <div class="mt-6 px-2 text-center">
        <h3 class="text-lg font-semibold italic">Festival Budaya Nusantara</h3>
        <p class="text-sm text-gray-700 mt-2 leading-relaxed">
        Siap-siap terpukau dalam Festival budaya dari seluruh penjuru Indonesia? Festival ini akan dimeriahkan oleh beragam pertunjukan seni yang seru dan autentik, dibawakan langsung oleh para ahli di bidangnya.
        Mulai dari tarian tradisional, musik etnik, hingga atraksi budaya khas tiap daerah, semuanya hadir dalam satu panggung spektakuler yang sayang banget untuk dilewatkan.
        </p>
      </div>
    </div>

    <!-- Detail Poster & Waktu -->
    <div class="w-full md:w-1/3 bg-white flex flex-col items-center">
        <img src="https://i.pinimg.com/originals/31/d7/31/31d731a44c0068d5ec359002084fbb0e.png" alt="Poster Festival Budaya" class="w-full h-auto rounded-lg shadow object-cover">
    <div class="mt-4 text-sm space-y-2">
        <div class="flex items-center space-x-2">
        <!-- <img src="{{ asset('assets/Calender event.png') }}" alt="kalender event" class="w-full rounded-lg shadow"> -->
          <span class="text-xl">📅</span>
          <span class="text-base font-medium">16 Juli 2024</span>
        </div>
        <div class="flex items-center space-x-2">
          <span class="text-xl">⏰</span>
          <span class="text-base font-medium">08.00 - selesai</span>
        </div>
      </div>
    </div>
@endsection