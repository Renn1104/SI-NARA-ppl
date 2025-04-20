<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Admin extends Controller
{
    public function beranda()
    {
        return view('admin.V_beranda'); 
    }
}
