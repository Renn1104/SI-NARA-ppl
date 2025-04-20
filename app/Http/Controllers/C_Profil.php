<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Profil extends Controller
{
    public function profil()
    {
        return view('auth.V_Landing');
    }
}
