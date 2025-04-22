<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Pelanggan extends Controller
{
    public function beranda()
    {
        return view('pelanggan.V_beranda');
    }
}
