<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class C_Login extends Controller
{
    public function login()
    {
        return view('auth.V_Login');
    }

    public function cekdata(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ], [
        'username.required' => 'Username belum terisi!',
        'password.required' => 'Password belum terisi!',
    ]);

    $credentials = [
        'username' => $request->username,
        'password' => $request->password,
    ];
    
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Arahkan berdasarkan role
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.beranda');
        } elseif (Auth::user()->role === 'pelanggan') {
            return redirect()->route('pelanggan.beranda');
        }

        // Optional: default fallback
        return redirect()->route('V_Landing');
    }

    return redirect('/login')->with('failed', 'Username atau Password salah!');

    }
}
