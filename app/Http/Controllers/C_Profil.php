<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class C_Profil extends Controller
{
    public function profil()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.V_profil', compact('user'));
        } elseif ($user->role === 'pelanggan') {
            return view('pelanggan.V_profil', compact('user'));
        }

        abort(403, 'Role tidak dikenali');
    }

    public function profilPelanggan()
    {
        $user = Auth::user();

        // Batasi hanya untuk admin
        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat melihat profil pelanggan.');
        }

        return view('admin.V_profilpelanggan', compact('user'));
    }
}
