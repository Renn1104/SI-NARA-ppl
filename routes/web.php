<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\C_Landing;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_Register;
use App\Http\Controllers\C_Konten;
use App\Http\Controllers\C_KalenderEvent;
use App\Http\Controllers\C_Admin;
use App\Http\Controllers\C_Pelanggan;
use App\Http\Controllers\C_Belanja;
use App\Http\Controllers\C_Profil;

// ===========================
// ROUTE LANDING (BERANDA AWAL)
// ===========================
Route::get('/', function () {
    return view('auth.V_Landing', ['role' => session('role', 'guest')]);
})->name('landing');

Route::get('/landing', [C_Landing::class, 'index'])->name('V_Landing');

// ===========================
// ROUTE AUTH (LOGIN & REGISTER)
// ===========================
Route::get('/register', [C_Register::class, 'register'])->name('V_Register');
Route::post('/register', [C_Register::class, 'store'])->name('register.store');

Route::get('/login', [C_Login::class, 'login'])->name('V_Login');
Route::post('/login', [C_Login::class, 'cekdata']);

// ===========================
// ROUTE KONTEN
// ===========================
Route::get('/konten', [C_Konten::class, 'index'])->name('konten');

Route::get('/konten/create', function () {
    return view('admin.V_Tambahkonten');
})->name('konten.create');

Route::post('/konten', [C_Konten::class, 'store'])->name('konten.store');

Route::get('/konten/edit/{id}', [C_Konten::class, 'edit'])->name('editKonten');
Route::put('/konten/{id}', [C_Konten::class, 'update'])->name('konten.update');
Route::delete('/konten/{id}', [C_Konten::class, 'destroy'])->name('konten.destroy');

// Detail Konten
Route::get('detailkonten/{judul}/{deskripsiKonten}/{fileKonten}/{id}', function ($judul, $deskripsiKonten, $fileKonten, $id) {
    return view('admin.V_DetailKonten', compact('judul', 'deskripsiKonten', 'fileKonten', 'id'));
})->name('detailkonten');

// ===========================
// ROUTE KALENDER EVENT
// ===========================

Route::get('/kalenderevent',                [C_KalenderEvent::class, 'index'])->name('kalenderevent.index');
Route::get('/kalenderevent/create',         [C_KalenderEvent::class, 'create'])->name('kalenderevent.create');
Route::post('/kalenderevent',               [C_KalenderEvent::class, 'store'])->name('kalenderevent.store');
Route::get('/kalenderevent/{kalenderevent}/edit', [C_KalenderEvent::class, 'edit'])->name('kalenderevent.edit');
Route::put('/kalenderevent/{kalenderevent}',      [C_KalenderEvent::class, 'update'])->name('kalenderevent.update');



// Tambahan tampilan langsung (tidak disarankan jika sudah ada controller-nya)
Route::get('/kalenderevent',[C_KalenderEvent::class,'index'])->name('kalenderevent');




// ===========================
// ROUTE BERANDA ADMIN & PELANGGAN
// ===========================
Route::get('/admin/beranda', function () {
    return view('admin.V_beranda', ['role' => session('role', 'guest')]);
})->name('admin.beranda');

Route::get('/pelanggan/beranda', [C_Pelanggan::class, 'beranda'])->name('pelanggan.beranda');





// ===========================
// ROUTE BELANJA / PRODUK
// ===========================
Route::get('/produk', [C_Belanja::class, 'belanja'])->name('produk');
Route::get('admin/produk', [C_Belanja::class, 'create'])->name('admin.V_UnggahProduk');







// ===========================
// ROUTE PROFIL (USER & ADMIN)
// ===========================

// Untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/profil/edit', [C_Profil::class, 'editProfil'])->name('admin.profil.edit');
    Route::get('/admin/profil', [C_Profil::class, 'profil'])->name('admin.profil');
    Route::post('/admin/profil/update', [C_Profil::class, 'updateProfil'])->name('admin.profil.update');

    Route::get('/admin/profil/edit', [C_Profil::class, 'editProfil'])->name('admin.profil.edit');
    Route::post('/admin/profil/update', [C_Profil::class, 'updateProfil'])->name('admin.profil.update');
    Route::get('/admin/profilpelanggan', [C_Profil::class, 'profilPelanggan'])->name('admin.profilpelanggan');
});

Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/pelanggan/profil', [C_Profil::class, 'profil'])->name('pelanggan.profil');
});




// ===========================
// ROUTE LOGOUT
// ===========================
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('V_Landing'); // Redirect ke halaman guest (landing page)
})->name('logout');

