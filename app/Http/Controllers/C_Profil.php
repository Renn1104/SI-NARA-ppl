<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class C_Profil extends Controller
{
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

    public function editProfil()
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hzanya admin yang dapat mengedit profil.');
        }

        return view('admin.V_EditProfil', compact('user'));
    }

    public function editProfilPelanggan()
    {
        $user = Auth::user();

        if ($user->role !== 'pelanggan') {
            abort(403, 'Akses ditolak. Hanya pelanggan yang dapat mengedit profil.');
        }

        return view('pelanggan.V_EditProfil', compact('user'));
    }

    public function updateProfilAdmin(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengupdate profil.');
        }

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'kodepos' => 'nullable|string|max:10',
            'password' => 'nullable|string|min:6'
        ]);

        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->alamat = $request->alamat;
        $user->kodepos = $request->kodepos;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updateProfilPelanggan(Request $request)
    {
    $user = Auth::user();

    if ($user->role !== 'pelanggan') {
        abort(403, 'Akses ditolak. Hanya pelanggan yang dapat mengupdate profil.');
    }

    $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'alamat' => 'nullable|string|max:255',
        'kodepos' => 'nullable|string|max:10',
        'kecamatan' => 'nullable|string|max:100',
        'kabupatenkota' => 'nullable|string|max:100',
        'provinsi' => 'nullable|string|max:100',
        'password' => 'nullable|string|min:6'
    ]);

    $user->username = $request->username;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->alamat = $request->alamat;
    $user->kodepos = $request->kodepos;
    $user->kecamatan = $request->kecamatan;
    $user->kabupatenkota = $request->kabupatenkota;
    $user->provinsi = $request->provinsi;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

        return redirect()->route('pelanggan.profil')->with('success', 'Profil berhasil diperbarui.');
    }


    public function profilPelanggan()
    {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat melihat profil pelanggan.');
        }

        $pelanggans = User::where('role', 'pelanggan')->get();

        return view('admin.V_ProfilPelanggan', compact('user', 'pelanggans'));
    }

    public function showDetailPelanggan($username)
    {
        $pelanggan = User::where('username', $username)->firstOrFail();
        return view('admin.V_DetailProfilPelanggan', compact('pelanggan'));
    }
}
