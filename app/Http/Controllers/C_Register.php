<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'namalengkap' => $request->namalengkap,
            'role' => 'pelanggan',
        ]);
    
        return redirect()->route('V_Landing')->with('success', 'Akun berhasil dibuat. Silakan login.');
    // dd($user);
    }
}    


