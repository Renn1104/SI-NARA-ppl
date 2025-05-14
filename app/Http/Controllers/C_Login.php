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
        $user = Auth::user();
        session(['user' => $user]);

        // Redirect berdasarkan role
        return redirect()->route($user->role . '.beranda');
    }

    return redirect()->route('V_Login')->with('failed', 'Username atau Password salah!');
    }

}
