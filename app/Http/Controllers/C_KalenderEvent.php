<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_KalenderEvent extends Controller
{
    public function kalenderevent()
    {
        return view('admin.V_KalenderEvent');
    }
}
