<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class C_Register extends Controller
{

    public function register()
    {
        return view('auth.V_Register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'namalengkap' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'namalengkap' => $request->namalengkap,
            'role' => 'pelanggan',
        ]);

        Auth::login($user);
        // session(['user' => $user]);

        return redirect()->route($user->role . '.beranda')->with('success', 'Akun berhasil dibuat. Selamat datang!');
    }
}


