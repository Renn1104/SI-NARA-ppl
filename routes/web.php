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
use App\Http\Controllers\C_Riwayat;
use App\Http\Controllers\C_Alamat;
use App\Http\Controllers\MidtransController;

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
// ROUTE BERANDA ADMIN & PELANGGAN
// ===========================
Route::get('/admin/beranda', function () {
    return view('admin.V_beranda', ['role' => session('role', 'guest')]);
})->name('admin.beranda');
Route::get('/pelanggan/beranda', [C_Pelanggan::class, 'beranda'])->name('pelanggan.beranda');

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
Route::get('detailkonten/{judul}/{deskripsiKonten}/{fileKonten}/{id}', function ($judul, $deskripsiKonten, $fileKonten, $id) {
    return view('admin.V_DetailKonten', compact('judul', 'deskripsiKonten', 'fileKonten', 'id'));
})->name('detailkonten');
Route::get('/konten/{id}', [C_Konten::class, 'show'])->name('konten.show');

// ===========================
// ROUTE KALENDER EVENT
// ===========================
Route::get('/kalenderevent',                [C_KalenderEvent::class, 'index'])->name('kalenderevent.index');
Route::get('/kalenderevent/create',         [C_KalenderEvent::class, 'create'])->name('kalenderevent.create');
Route::post('/kalenderevent',               [C_KalenderEvent::class, 'store'])->name('kalenderevent.store');
Route::get('/kalenderevent/{kalenderevent}/edit', [C_KalenderEvent::class, 'edit'])->name('kalenderevent.edit');
Route::put('/kalenderevent/{kalenderevent}',      [C_KalenderEvent::class, 'update'])->name('kalenderevent.update');
Route::get('/kalenderevent',[C_KalenderEvent::class,'index'])->name('kalenderevent');

// ===========================
// ROUTE BELANJA / PRODUK
// ===========================
Route::get('/produk', [C_Belanja::class, 'belanja'])->name('produk');
Route::get('admin/produk', [C_Belanja::class, 'create'])->name('admin.V_UnggahProduk');
Route::post('/admin/produk/store', [C_Belanja::class, 'unggah'])->name('admin.produk.store');
Route::get('/belanja/{id}', [C_Belanja::class, 'show'])->name('belanja.detail');
Route::get('/produk/{id}/edit', [C_Belanja::class, 'edit'])->name('produk.edit');
Route::put('/admin/produk/{id}', [C_Belanja::class, 'update'])->name('produk.update');
Route::delete('/produk/{id}', [C_Belanja::class, 'destroy'])->name('produk.destroy');
Route::post('/checkout', [C_Belanja::class, 'checkout'])->name('belanja.checkout');
Route::get('/pesanan/{id}', [C_Belanja::class, 'showDetailPesanan'])->name('belanja.detailpesanan');

// ROUTE UBAH ALAMAT
Route::get('/alamat/edit', [C_Alamat::class, 'edit'])->name('alamat.edit');
Route::put('/alamat/update', [C_Alamat::class, 'update'])->name('alamat.update');
Route::post('/update-alamat', [C_Belanja::class, 'updateAlamat'])->name('belanja.updatealamat');

// ===========================
// ROUTE RIWAYAT BELANJA
// ===========================
Route::middleware('auth')->group(function () {
    Route::get('/riwayat', [C_Riwayat::class, 'index'])->name('riwayat');
    Route::get('/riwayat/detail/{id}', [C_Riwayat::class, 'show'])->name('riwayat.detail');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/riwayat-belanja', [C_Riwayat::class, 'index'])->name('admin.riwayat');

    Route::get('/admin/riwayat-belanja/{id}', [C_Riwayat::class, 'show'])
        ->name('admin.riwayat.detail');
});

// ===========================
// ROUTE Midtrans
// ===========================
Route::post('/midtrans/callback', [C_Belanja::class, 'midtransCallback'])->name('midtrans.callback');
Route::post('/pembayaran/berhasil', [C_Belanja::class, 'pembayaranBerhasil'])->name('pembayaran.berhasil');
Route::delete('/pesanan/{id}/batal', [C_Belanja::class, 'batalkanPesanan'])->name('pesanan.batal');

// ===========================
// ROUTE PROFIL (USER & ADMIN)
// ===========================
// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/profil', [C_Profil::class, 'profil'])->name('admin.profil');
    Route::get('/admin/profil/edit', [C_Profil::class, 'editProfil'])->name('admin.profil.edit');
    Route::post('/admin/profil/update', [C_Profil::class, 'updateProfilAdmin'])->name('admin.profil.update');
    Route::get('/admin/profilpelanggan', [C_Profil::class, 'profilPelanggan'])->name('admin.profilpelanggan');
    Route::get('/admin/pelanggan/{username}', [C_Profil::class, 'showDetailPelanggan'])->name('admin.detailPelanggan');
});

// Pelanggan
Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/pelanggan/profil', [C_Profil::class, 'profil'])->name('pelanggan.profil');
    Route::get('/pelanggan/profil/edit', [C_Profil::class, 'editProfilPelanggan'])->name('pelanggan.profil.edit');
    Route::post('/pelanggan/profil/update', [C_Profil::class, 'updateProfilPelanggan'])->name('pelanggan.profil.update');
});

// ===========================
// ROUTE LOGOUT
// ===========================
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('V_Landing');
})->name('logout');





