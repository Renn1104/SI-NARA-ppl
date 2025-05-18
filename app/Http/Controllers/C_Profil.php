<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class C_Profil extends Controller
{
    // Menampilkan profil user sesuai role
    public function profil()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.V_Profil', compact('user'));
        } elseif ($user->role === 'pelanggan') {
            return view('pelanggan.V_Profil', compact('user'));
        }

        abort(403, 'Role tidak dikenali');
    }

    // Method edit profil (hanya contoh untuk admin)
    public function editProfil()
    {
        $user = Auth::user();

        // Kalau cuma admin yang boleh edit, cek role-nya
        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengedit profil.');
        }

        return view('admin.v_EditProfil', compact('user')); // Pastikan ini sesuai file view-nya
    }

    // Update data profil
    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengupdate profil.');
        }

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'postal_code' => 'nullable',
            'password' => 'nullable|min:6'
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('admin.V_EditProfil')->with('success', 'Profil berhasil diperbarui.');
    }

    // Menampilkan profil pelanggan, hanya bisa diakses admin
    public function profilPelanggan()
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat melihat profil pelanggan.');
        }

        return view('admin.V_profilpelanggan', compact('user'));
    }
}
