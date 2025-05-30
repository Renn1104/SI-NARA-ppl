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

    // Cek apakah user dengan username tersebut ada
    $user = User::where('username', $request->username)->first();

    if (!$user) {
        // Jika username tidak ditemukan
        return redirect()->route('V_Login')->with('failed', 'Username Anda salah!');
    }

    // Jika username ada, cek password
    if (!Hash::check($request->password, $user->password)) {
        return redirect()->route('V_Login')->with('failed', 'Password Anda  salah!');
    }

    // Autentikasi berhasil
    Auth::login($user);
    $request->session()->regenerate();
    session(['user' => $user]);

    // Flash message
    session()->flash('login_success', true);
    session()->flash('success', 'Selamat datang, ' . $user->username . '!');
    // session()->flash('success', 'Selamat datang, ' . $user->username . '!');

    // Redirect berdasarkan role
    return redirect()->route($user->role . '.beranda');
}

}
