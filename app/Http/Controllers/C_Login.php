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

    $user = User::where('username', $request->username)->first();

    if (!$user) {
        return redirect()->route('V_Login')->with('failed', 'Username Anda salah!');
    }

    if (!Hash::check($request->password, $user->password)) {
        return redirect()->route('V_Login')->with('failed', 'Password Anda  salah!');
    }

    Auth::login($user);
    $request->session()->regenerate();
    session(['user' => $user]);

    session()->flash('login_success', true);
    session()->flash('success', 'Selamat datang, ' . $user->username . '!');
    // session()->flash('success', 'Selamat datang, ' . $user->username . '!');

    return redirect()->route($user->role . '.beranda');
}

}
