<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Landing extends Controller
{
    public function index()
    {
        return view('auth.V_Landing');
    }
}
