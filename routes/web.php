<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_Landing;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_Register;
use App\Http\Controllers\C_Konten;
use App\Http\Controllers\C_KalenderEvent;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\C_Admin;
use App\Http\Controllers\C_Pelanggan;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.V_Landing');
})->name('landing');

// Route Landing
Route::get('/landing', [C_Landing::class, 'index'])->name('V_Landing');

// Route Register
Route::get('/register', [C_Register::class, 'register'])->name('V_Register');
Route::post('/register', [C_Register::class, 'store'])->name('register.store');

// Route Login
Route::get('/login', [C_Login::class, 'login'])->name('V_Login');
Route::post('/login', [C_Login::class, 'cekdata']);

// Route Admin dan Pelanggan 
Route::get('/pelanggan/beranda', [C_Pelanggan::class, 'beranda'])->name('pelanggan.beranda');
Route::get('/admin/beranda', [C_Admin::class, 'beranda'])->name('admin.beranda');

Route::get('/konten', [C_Konten::class, 'index'])->name('V_Konten');
Route::post('/konten', [C_Konten::class, 'store'])->name('konten.store');
Route::get('/admin/konten', [C_Konten::class, 'index'])->name('admin.konten.index');
Route::get('/konten/tambahkonten', [C_Konten::class, 'create'])->name('konten.create');


Route::get('/konten', function () {
    return '<h1>Halo ini ntar yaa masih ada kendala dimodel sama route/view nya </h1>';
})->name('V_Konten');


Route::get('/kalenderevent', [C_KalenderEvent::class, 'kalenderevent'])->name('V_KalenderEvent');
Route::post('/cekdata', [C_Login::class, 'cekdata'])->name('cekdata');



