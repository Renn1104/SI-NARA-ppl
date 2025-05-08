<?php

// use App\Http\Controllers\HomeController;
// use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_Landing;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_Register;
use App\Http\Controllers\C_Konten;
use App\Http\Controllers\C_KalenderEvent;
use App\Http\Controllers\C_Admin;
use App\Http\Controllers\C_Pelanggan;
use App\Http\Controllers\C_Belanja;


Route::get('/', function () {
    return view('auth.V_Landing',[
        'role'=>session('role','guest')
    ]);
})->name('landing');

// Route Landing
Route::get('/landing', [C_Landing::class, 'index'])->name('V_Landing');

// Route Register
Route::get('/register', [C_Register::class, 'register'])->name('V_Register');
Route::post('/register', [C_Register::class, 'store'])->name('register.store');

// Route Login
Route::get('/login', [C_Login::class, 'login'])->name('V_Login');
Route::post('/login', [C_Login::class, 'cekdata']);

// Route Konten
Route::get('/konten', [C_Konten::class, 'index'])->name('konten');
Route::get('/konten/create', function (){
    return view('admin.V_Tambahkonten');
})->name('konten.store');

Route::get('/kalenderevent', [C_KalenderEvent::class, 'kalenderevent'])->name('kalenderevent');
Route::get('/kalenderevent', function(){
    return view('admin.V_KalenderEvent',[
        'role'=>session('role','guest')
    ]);
})->name('kalenderevent');

// Route Admin dan Pelanggan 
Route::get('/admin/beranda', function (){
    
    return view('admin.V_Beranda',[
        'role'=>session('role','guest')
    ]);
})->name('admin.beranda');
Route::get('/pelanggan/beranda', [C_Pelanggan::class, 'beranda'])->name('pelanggan.beranda');


Route::get('/konten/tambahkonten', function (){

    return view('admin.V_Tambahkonten');
}
)->name('konten.create');

Route::post('/konten', [C_Konten::class, 'store'])->name('konten.store');

Route::get('detailkonten/{judul}/{deskripsiKonten}/{fileKonten}/{id}', function($judul,$deskripsiKonten,$fileKonten,$id){
    return view('admin.V_DetailKonten', compact('judul','deskripsiKonten','fileKonten','id'));
})->name('detailkonten');
 

Route::get('/produk', [C_Belanja::class, 'belanja'])->name('produk');


Route::get('editKonten/{id}', [C_Konten::class, 'edit'])->name('editKonten');


Route::put('/konten/{id}', [C_Konten::class, 'update'])->name('konten.update');
