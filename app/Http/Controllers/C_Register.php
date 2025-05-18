<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class C_Register extends Controller
{
    // Menampilkan form register
    public function register()
    {
        return view('auth.V_Register');
    }

    // Menangani proses registrasi
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'namalengkap' => 'required',
        ]);

        // Buat user dan simpan hasilnya di $user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'namalengkap' => $request->namalengkap,
            'role' => 'pelanggan',
        ]);

        // Langsung login user yang baru dibuat
        Auth::login($user);
        // Jika ingin menyimpan session custom, bisa dilakukan, tapi biasanya Auth sudah cukup
        // session(['user' => $user]);

        // Redirect ke halaman beranda sesuai role, misalnya route 'pelanggan.beranda'
        return redirect()->route($user->role . '.beranda')->with('success', 'Akun berhasil dibuat. Selamat datang!');
    }
}


